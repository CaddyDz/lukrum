<?php


namespace App\utils\Pmc;

use App\Mail\PmcCcManagerMail;
use App\Mail\PmcCibManagerMail;
use App\Models\PmcForm as Model;
use App\utils\Pmc\Assets\Cib\LayoutCib;
use App\utils\Pmc\Assets\Contracts\AssetImageCibContract;
use App\utils\Pmc\Assets\Contracts\AssetImageContract;
use App\utils\Pmc\Assets\Contracts\LayoutContract;
use App\utils\Pmc\Assets\Contracts\TemplateCibContract;
use App\utils\Pmc\Assets\ImageProcessor;
use App\utils\Pmc\Assets\ImageProcessorCib;
use App\utils\Pmc\Assets\LayoutsManager;
use Cloudinary\Cloudinary;
use Cloudinary\Tag\ImageTag;
use Cloudinary\Transformation\Compass;
use Cloudinary\Transformation\Gravity;
use Cloudinary\Transformation\ImageTransformation;
use Cloudinary\Transformation\Overlay;
use Cloudinary\Transformation\Position;
use Cloudinary\Transformation\Resize;
use Cloudinary\Transformation\Source;
use Cloudinary\Transformation\TextStyle;
use Cloudinary\Transformation\Transformation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AssetsProcessor
{
    public function ProcessForm(Model $form): string {
        // results as image tag for now, not sure what it's gonna be
        // the main initial goal is make correct logo->asset placement

        if(!$form->asset_raw) throw new \Exception('No Asset Json');
        if(!$form->logo_json) throw new \Exception('No Logo Json');

        $asset = json_decode($form->asset_raw);
        $cAsset = $asset->cloudinary_raw;

        $logo = json_decode($form->logo_json);

        $assetIdentifier = "{$cAsset->public_id}.{$cAsset->format}";

        $logoIdentifier = join(':', explode('/', "{$logo->public_id}.{$logo->format}"));

        $cld = new Cloudinary();

//        return (new ImageTag($assetIdentifier))
        return (string)$cld->image($assetIdentifier)
            ->overlay(
                Overlay::source(Source::image($logoIdentifier)
                    ->transformation((new Transformation())->resize(Resize::pad($asset->logo->w, $asset->logo->h)))
                )->position((new Position())
                    ->gravity(Gravity::compass(Compass::northWest()))
                    ->offsetX($asset->logo->x)
                    ->offsetY($asset->logo->y)
                )
            )->toUrl();
    }


    public function SendAssetsEmail(PmcForm $pmc): string {
        $m = $pmc->GetModel();
        $manager = (new ManagerManager\ManagerManager())->GetByCode($m->campaign_manager);

        switch($m->path) {
            case 'cib':
                $filesToSend = $this->CreateCibAssets($pmc)->map([$this, '_s3UploadMap']);
                $mail = new PmcCibManagerMail($m, $filesToSend);
                break;

            default:
                $filesToSend = $this->CreateCustomCreativeAssets($pmc)->map([$this, '_s3UploadMap']);
                $mail = new PmcCcManagerMail($m, $filesToSend);
                break;
        }

        try {
            Mail::to([['email' => $manager['email'], 'name' => $manager['name'], ], ])
                ->send($mail);

            $m->confirmation_email_sent_at = date('Y-m-d H:i:s');
            $m->prepared_asset_url = ($filesToSend->first())['s3_url'];
        } catch (\Exception $e) {
            //Ignore
            dump($e);
        }

        $m->save();

        $filesToSend->each(function($f) {
            Storage::delete($f['storage_path']);
        });


        return ($filesToSend->first())['s3_url'];
    }


    public function _s3UploadMap(array $localFile): array {
        $s3 = Storage::disk('s3');

        $s3Url = env("AWS_S3_ACCESS_URL", "https://".env('AWS_BUCKET', 'unknown').".s3.".(env('AWS_DEFAULT_REGION', 'unknown')).".amazonaws.com");
        $s3Url = rtrim($s3Url, ' /');

        $s3Folder = instance()->S3Folder();
        $s3Path = "{$s3Folder}/{$localFile['file_name']}";
        $s3->put($s3Path, Storage::get($localFile['storage_path']), 'public');
        $localFile['s3_path'] = $s3Path;
        $localFile['s3_url'] = "{$s3Url}/{$s3Folder}/".urlencode($localFile['file_name']);
        return $localFile;
    }

    private function normalizeCompany(string $input): string {
        $badSymbols = ['~', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '`', ';', '<', '>', '?', ',', '[', ']', '{', '}', "'", '"', '|', '/', '\\', ];
        $noBadSymbols = strtolower(str_replace($badSymbols, '', trim($input)));
        $noSpaces = str_replace(' ', '_', $noBadSymbols);
        $exploded = explode('_', $noSpaces);
        $noEmptyPartsArray = array_filter($exploded, function($x) {return strlen($x);});
        return implode('_', $noEmptyPartsArray);
    }

    /**
     * @param $url
     * @return false|string|null
     * @throws \Exception
     */
    private function getRemoteContent($url) {
        $maxTries = 10;
        $attempt = 0;
        $c = null;
        $ok = false;
        do {
            try {
                $c = file_get_contents($url);
                $ok = true;
            } catch (\Exception $e) {
                ++$attempt;
                sleep($attempt * 3);
            }
        } while (!$ok && $attempt < $maxTries);

        if(!$ok) {
            throw new \Exception("Failed To Get Remote Content After {$attempt} Attempts. {$url}");
        }
        return $c;
    }

    private function fetchCompanyName(Model $m): string {
        $companyName = $m->company;

        if(!$companyName) {
            $companyName = "Lukrum{$m->id}";
        }

        return $companyName;
    }

    public function CreateCibAssets(PmcForm $pmc): Collection {
        $m = $pmc->GetModel();

        $company = $this->normalizeCompany($this->fetchCompanyName($m));

        $storagePath = "app/{$pmc->Hash()}.zip";

        $zip = new \ZipArchive();
        $zip->open(storage_path($storagePath), \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $folder = "{$company}_branding";

        if($m->logo_url) {
            $exploded = explode('.', $m->logo_url);
            $extension = array_pop($exploded);
            $zip->addFromString("{$folder}/logo.{$extension}", $this->getRemoteContent($m->logo_url));
        }

        if($cib = $m->cib) {

            if($cib->profile_url) {
                $exploded = explode('.', $cib->profile_url);
                $extension = array_pop($exploded);
                $zip->addFromString("{$folder}/profile.{$extension}", $this->getRemoteContent($cib->profile_url));
            }


            $layout = LayoutsManager::instance()->getLayout(LayoutsManager::CIB_LAYOUT_CODE);
//dd($layout);
            $touchPoints = [
                'tp1' => [],
                'tp2' => [],
                'tp3' => [],
                'tp4' => [],
            ];

            ['setup' => $setup, 'common' => $common,] = instance($m->instance)->Cib()->Copies();

            foreach($touchPoints as $tpCode => $info) {
                if(!$common[$tpCode]['enabled']) {
                    unset($touchPoints[$tpCode]);
                } else {
                    $touchPoints[$tpCode]['name'] = strtolower($common[$tpCode]['short_title']);
                    $touchPoints[$tpCode]['steps'] = $common[$tpCode]['pages'];
                }
            }

            $bannerCodes = [
                'medium_rectangle' => 'medium_rectangle_300x250',
                'leader_board' => 'leaderboard_728x90',
                'sky_scrapper' => 'skyscrapper_120x600',
                'large_rectangle' => 'large_rectangle_300x600',
                'mobile' => 'mobile_320x50',
            ];

            $smCodes = [
                'facebook' => 'facebook_1200x630',
                'twitter' => 'twitter_900x450',
                'linkedin' => 'linkedin_1584x768',
                'instagram' => 'instagram_1080x1080',
            ];

            foreach($touchPoints as $touchPointCode => $info) {
                $parentFolder = "{$company}_{$info['name']}_touchpoint";

                if(in_array('banner', $info['steps'])) {
                    $folder = "{$parentFolder}/{$company}_banner_images";
                    foreach($bannerCodes as $imageCode => $title) {
                        $image = $layout->image($imageCode);
                        /**
                         * @var AssetImageCibContract $image
                         */
                        $url = $this->ProcessImage($layout, $image->SetTouchPoint($touchPointCode), $pmc);
                        $zip->addFromString("{$folder}/{$title}.png", $this->getRemoteContent($url));
                    }
                }

                if(in_array('sm', $info['steps'])) {
                    $folder = "{$parentFolder}/{$company}_social_images";
                    foreach($smCodes as $imageCode => $title) {
                        $image = $layout->image($imageCode);
                        /**
                         * @var AssetImageCibContract $image
                         */
                        $url = $this->ProcessImage($layout, $image->SetTouchPoint($touchPointCode), $pmc);
                        $zip->addFromString("{$folder}/{$title}.png", $this->getRemoteContent($url));
                    }
                }


                if(in_array('landing', $info['steps'])) {
                    $folder = "{$parentFolder}/{$company}_landing";
                    $template = $layout->template('landing');
                    /**
                     * @var TemplateCibContract $template
                     */
                    $template->SetTouchPoint($touchPointCode);

                    $zip->addFromString("{$folder}/index.html", $template->getRenderedHtml($pmc));
                    foreach($template->getPageFilesList() as $pFile) {
                        $zip->addFile($pFile->localPath, "{$folder}/{$pFile->zipPath}");
                    }

                    if($m->logo_url) {
                        $exploded = explode('.', $m->logo_url);
                        $extension = array_pop($exploded);
                        $zip->addFromString("{$folder}/img/logo.{$extension}", $this->getRemoteContent($m->logo_url));
                    }

                }

                if(in_array('email', $info['steps'])) {
                    $folder = "{$parentFolder}/{$company}_email";
                    $template = $layout->template('email');
                    /**
                     * @var TemplateCibContract $template
                     */
                    $template->SetTouchPoint($touchPointCode);

                    $zip->addFromString("{$folder}/index.html", $template->getRenderedHtml($pmc));

                    foreach($template->getPageFilesList() as $pFile) {
                        $zip->addFile($pFile->localPath, "{$folder}/{$pFile->zipPath}");
                    }

                    if($m->logo_url) {
                        $exploded = explode('.', $m->logo_url);
                        $extension = array_pop($exploded);
                        $zip->addFromString("{$folder}/img/logo.{$extension}", $this->getRemoteContent($m->logo_url));
                    }

                    if($template = $layout->template('email_text')) {
                        /**
                         * @var TemplateCibContract $template
                         */
                        $template->SetTouchPoint($touchPointCode);

                        $zip->addFromString("{$folder}/email.txt", $template->getRenderedHtml($pmc));
                    }
                }
            }


/*


            $folder = "{$company} 1-Pager";
            if($m->logo_url) {
                $exploded = explode('.', $m->logo_url);
                $extension = array_pop($exploded);
                $zip->addFromString("{$folder}/img/logo.{$extension}", $this->getRemoteContent($m->logo_url));
            }

            $template = $layout->template('one_pager');
            $zip->addFromString("{$folder}/index.html", $template->getRenderedHtml($pmc));
            foreach($template->getPageFilesList() as $pFile) {
                $zip->addFile($pFile->localPath, "{$folder}/{$pFile->zipPath}");
            }
*/
        }

        $zip->addFromString('info.txt', $this->_cibEmailText($m));

        $zip->close();

        return collect([
            [
                'file_name' => "{$company}_campaign_in_a_box.zip",
                'storage_path' => substr($storagePath, 4),
            ]
        ]);
    }

    public function CreateCustomCreativeAssets(PmcForm $pmc): Collection {

        $m = $pmc->GetModel();
        $company = $this->normalizeCompany($this->fetchCompanyName($m));

        $storagePath = "app/{$pmc->Hash()}.zip";

        $zip = new \ZipArchive();
        $zip->open(storage_path($storagePath), \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $folder = "{$company}_branding";

        if($m->logo_url) {
            $exploded = explode('.', $m->logo_url);
            $extension = array_pop($exploded);
            $zip->addFromString("{$folder}/logo.{$extension}", $this->getRemoteContent($m->logo_url));
        }

        if($cc = $m->customCreative) {

            if($cc->overlay_url) {
                $exploded = explode('.', $cc->overlay_url);
                $extension = array_pop($exploded);
                $zip->addFromString("{$folder}/image.{$extension}", $this->getRemoteContent($cc->overlay_url));
            }


            $layout = LayoutsManager::instance()->getLayout($cc->layout_code);

            $codes = [
                'medium_rectangle' => 'medium_rectangle_300x250',
                'leader_board' => 'leaderboard_728x90',
                'sky_scrapper' => 'skyscrapper_120x600',
                'large_rectangle' => 'large_rectangle_300x600',
                'mobile' => 'mobile_320x50',
            ];

            $folder = "{$company}_banner";
            foreach($codes as $imageCode => $title) {
                $url = $this->ProcessImage($layout, $layout->image($imageCode), $pmc);
                $zip->addFromString("{$folder}/{$title}.png", $this->getRemoteContent($url));
            }

            $codes = [
                'facebook' => 'facebook_1200x630',
                'twitter' => 'twitter_900x450',
                'linkedin' => 'linkedin_1584x768',
                'instagram' => 'instagram_1080x1080',
            ];

            $folder = "{$company}_social_media";
            foreach($codes as $imageCode => $title) {
                $url = $this->ProcessImage($layout, $layout->image($imageCode), $pmc);
                $zip->addFromString("{$folder}/{$title}.png", $this->getRemoteContent($url));
            }


            $folder = "{$company}_landing_page";
            if($m->logo_url) {
                $exploded = explode('.', $m->logo_url);
                $extension = array_pop($exploded);
                $zip->addFromString("{$folder}/img/logo.{$extension}", $this->getRemoteContent($m->logo_url));
            }

            if($layout->hasOverlay()) {
                if($cc->overlay_url) {
                    $exploded = explode('.', $cc->overlay_url);
                    $extension = array_pop($exploded);
                    $zip->addFromString("{$folder}/img/image.{$extension}", $this->getRemoteContent($cc->overlay_url));
                }
            }

            $template = $layout->template('landing');
            $zip->addFromString("{$folder}/index.html", $template->getRenderedHtml($pmc));
            foreach($template->getPageFilesList() as $pFile) {
                $zip->addFile($pFile->localPath, "{$folder}/{$pFile->zipPath}");
            }

            $folder = "{$company}_one_pager";
            if($m->logo_url) {
                $exploded = explode('.', $m->logo_url);
                $extension = array_pop($exploded);
                $zip->addFromString("{$folder}/img/logo.{$extension}", $this->getRemoteContent($m->logo_url));
            }

            if($layout->hasOverlay()) {
                if($cc->overlay_url) {
                    $exploded = explode('.', $cc->overlay_url);
                    $extension = array_pop($exploded);
                    $zip->addFromString("{$folder}/img/image.{$extension}", $this->getRemoteContent($cc->overlay_url));
                }
            }

            $template = $layout->template('one_pager');
            $zip->addFromString("{$folder}/index.html", $template->getRenderedHtml($pmc));
            foreach($template->getPageFilesList() as $pFile) {
                $zip->addFile($pFile->localPath, "{$folder}/{$pFile->zipPath}");
            }
        }

        $zip->addFromString('info.txt', $this->_ccEmailText($m));

        $zip->close();

        return collect([
            [
                'file_name' => "{$company}_custom_creative.zip",
                'storage_path' => substr($storagePath, 4),
            ]
        ]);
    }


    private function _ccEmailText(Model $m): string {
        $m = clone $m;
        $cc = $m->customCreative;

        $m->program = 'Custom Creative';

        $options = [
            'Slope' => 1,
            'Simple' => 2,
            'Watch' => 3,
            'Girl' => 4,
            'Blue' => 5,
        ];

        $m->design_option_number = ($options[$cc->layout_code] ?? 'Unknown')." ({$cc->layout_code})";
        $m->launch_date = $m->launch_date_time ? (new \DateTime($m->launch_date_time))->format('m/d/Y') : '';
        $m->submission_date = (new \DateTime($m->created_at))->format('m/d/Y');

        $bannerHeadline = $cc->ads_headline_edited ? $cc->ads_headline_edited : $cc->ads_headline_original;
        $bannerBody = $cc->ads_body_edited ? $cc->ads_body_edited : $cc->ads_body_original;
        $bannerCta = $cc->ads_cta_edited ? $cc->ads_cta_edited : $cc->ads_cta_original;

        $smHeadline = $cc->sm_headline_edited ? $cc->sm_headline_edited : $cc->sm_headline_original;
        $smBody = $cc->sm_body_edited ? $cc->sm_body_edited : $cc->sm_body_original;
        $smCta = $cc->sm_cta_edited ? $cc->sm_cta_edited : $cc->sm_cta_original;

        $ldHeadline = $cc->ld_headline_edited ? $cc->ld_headline_edited : $cc->ld_headline_original;
        $ldSubhead = $cc->ld_subhead_edited ? $cc->ld_subhead_edited : $cc->ld_subhead_original;
        $ldBody = $cc->ld_body_edited ? $cc->ld_body_edited : $cc->ld_body_original;
        $ldCta = $cc->ld_cta_edited ? $cc->ld_cta_edited : $cc->ld_cta_original;

        $opHeadline = $cc->op_headline_edited ? $cc->op_headline_edited : $cc->op_headline_original;
        $opSubhead = $cc->op_subhead_edited ? $cc->op_subhead_edited : $cc->op_subhead_original;
        $opBody = $cc->op_body_edited ? $cc->op_body_edited : $cc->op_body_original;
        $opCta = $cc->op_cta_edited ? $cc->op_cta_edited : $cc->op_cta_original;

        return <<<LONGTEXT
First Name : {$m->first_name}
Last Name : {$m->last_name}
Company : {$m->company}
Title : {$m->job_title}
Email address : {$m->email}
Phone Number : {$m->phone}
Country : {$m->country}
City : {$m->city}
State/Province : {$m->state}
Zip/Postal Code : {$m->zip_code}
Mailing Address : {$m->address}
Company URL : {$m->company_url}
Program : {$m->program}
Navigator Level : {$m->navigation_level}
Design Option Chosen : {$m->design_option_number}
Primary Color : {$m->asset_color}
Cloud Selected : {$cc->cloud}
Additional Comments : {$m->comments}
Launch Date : {$m->launch_date}
Submission Date : {$m->submission_date}


Banner Copy
    Headline : {$bannerHeadline}
    Body : {$bannerBody}
    Call to Action : {$bannerCta}


Social Media Copy
    Headline : {$smHeadline}
    Body : {$smBody}
    Call to Action : {$smCta}


Landing Page Copy
    Headline : {$ldHeadline}
    Subheading : {$ldSubhead}
    Body : {$ldBody}
    Call to Action : {$ldCta}


1-Pager Copy
    Headline : {$opHeadline}
    Subheading : {$opSubhead}
    Body : {$opBody}
    Call to Action : {$opCta}
    # of Certified Professionals : {$cc->op_professionals}
    # of Project Successes : {$cc->op_projects}

LONGTEXT;
    }

    private function _cibEmailText(Model $m): string {
        $m = clone $m;
        $cib = $m->cib;

        $m->program = 'Campaign-in-a-Box';

        $m->launch_date = $m->launch_date_time ? (new \DateTime($m->launch_date_time))->format('m/d/Y') : '';
        $m->submission_date = (new \DateTime($m->created_at))->format('m/d/Y');

$content = <<<LONGTEXT
First Name : {$m->first_name}
Last Name : {$m->last_name}
Company : {$m->company}
Title : {$m->job_title}
Email address : {$m->email}
Phone Number : {$m->phone}
Country : {$m->country}
City : {$m->city}
State/Province : {$m->state}
Zip/Postal Code : {$m->zip_code}
Mailing Address : {$m->address}
Company URL : {$m->company_url}
Program : {$m->program}
Navigator Level : {$m->navigation_level}
Campaign Focus : {$cib->focus}
Additional Comments : {$m->comments}
Launch Date : {$m->launch_date}
Submission Date : {$m->submission_date}


LONGTEXT;

        ['setup' => $setup, 'common' => $common, 'questions' => $questions] = instance($m->instance)->Cib()->Copies();

        $touchPoints = [
            'tp1' => ['title' => 'INTRO'],
            'tp2' => ['title' => 'WHY'],
            'tp3' => ['title' => 'HOW'],
            'tp4' => ['title' => 'CONSULT'],
        ];
        foreach($touchPoints as $tpCode => $info) {
            if(!$common[$tpCode]['enabled']) {
                unset($touchPoints[$tpCode]);
            } else {
                $touchPoints[$tpCode]['steps'] = $common[$tpCode]['pages'];
                $touchPoints[$tpCode]['title'] = strtoupper($common[$tpCode]['short_title']);
            }
        }


        foreach($touchPoints as $tpCode => $tpInfo) {
            $content .= "{$tpInfo['title']} Touchpoint\r\n";
            if(in_array('banner', $tpInfo['steps'])) {
                $content .= "\tBanner Copy\r\n";
                $edited = "{$tpCode}_ads_headline_edited"; $original = "{$tpCode}_ads_headline_original";
                $content .= "\t\tSubheading : ".($cib->{$edited} ? $cib->{$edited} : $cib->{$original})."\r\n";
                $edited = "{$tpCode}_ads_cta_edited"; $original = "{$tpCode}_ads_cta_original";
                $content .= "\t\tCall to Action : ".($cib->{$edited} ? $cib->{$edited} : $cib->{$original})."\r\n";
                $content .= "\r\n";
            }

            if(in_array('sm', $tpInfo['steps'])) {
                $content .= "\tSocial Copy\r\n";
                $edited = "{$tpCode}_sm_headline_edited"; $original = "{$tpCode}_sm_headline_original";
                $content .= "\t\tSubheading : ".($cib->{$edited} ? $cib->{$edited} : $cib->{$original})."\r\n";
                $edited = "{$tpCode}_sm_cta_edited"; $original = "{$tpCode}_sm_cta_original";
                $content .= "\t\tCall to Action : ".($cib->{$edited} ? $cib->{$edited} : $cib->{$original})."\r\n";
                $content .= "\r\n";
            }

            if(in_array('landing', $tpInfo['steps'])) {
                $content .= "\tLanding Page Copy\r\n";

                $edited = "{$tpCode}_ld_headline_edited"; $original = "{$tpCode}_ld_headline_original";
                $content .= "\t\tSubheading : ".($cib->{$edited} ? $cib->{$edited} : $cib->{$original})."\r\n";
                $edited = "{$tpCode}_ld_intro_edited"; $original = "{$tpCode}_ld_intro_original";
                $content .= "\t\tIntro : ".($cib->{$edited} ? $cib->{$edited} : $cib->{$original})."\r\n";
                $edited = "{$tpCode}_ld_body_edited"; $original = "{$tpCode}_ld_body_original";
                $content .= "\t\tBody : ".($cib->{$edited} ? $cib->{$edited} : $cib->{$original})."\r\n";
                $edited = "{$tpCode}_ld_cta_edited"; $original = "{$tpCode}_ld_cta_original";
                $content .= "\t\tCall to Action : ".($cib->{$edited} ? $cib->{$edited} : $cib->{$original})."\r\n";
                $content .= "\r\n";
            }


            if(in_array('email', $tpInfo['steps'])) {
                $content .= "\tEmail Copy\r\n";
                $edited = "{$tpCode}_email_intro_edited"; $original = "{$tpCode}_email_intro_original";
                $content .= "\t\tSubheading : ".($cib->{$edited} ? $cib->{$edited} : $cib->{$original})."\r\n";
                $edited = "{$tpCode}_email_body_edited"; $original = "{$tpCode}_email_body_original";
                $content .= "\t\tBody : ".($cib->{$edited} ? $cib->{$edited} : $cib->{$original})."\r\n";
                $edited = "{$tpCode}_email_cta_edited"; $original = "{$tpCode}_email_cta_original";
                $content .= "\t\tCall to Action : ".($cib->{$edited} ? $cib->{$edited} : $cib->{$original})."\r\n";
                $content .= "\r\n";
            }
        }

        $content .= "\r\n";
        if($questions['enabled']) {
            $content .= "\r\n";
            $content .= "Customer Success Story\r\n";
            foreach(range(1, 6) as $idx) {
                $question = "question{$idx}"; $answer = "answer{$idx}";
                $content .= "\t{$cib->{$question}}\r\n";
                $content .= "\t\t{$cib->{$answer}}\r\n\r\n";
            }
            $content .= "\r\n\r\n";
            $content .= "Ask the Expert\r\n";
            foreach(range(7, 11) as $idx) {
                $question = "question{$idx}"; $answer = "answer{$idx}";
                $content .= "\t{$cib->{$question}}\r\n";
                $content .= "\t\t{$cib->{$answer}}\r\n\r\n";
            }
            $content .= "\r\n";
        }

        return $content;
    }


/*

Folder Name: [Company] Landing Page

Output HTML & Image components


Folder Name: [Company] 1-Pager

Output HTML & Image components
 */



    public function ProcessImage(LayoutContract $layout, AssetImageContract $image, PmcForm $pmc) {
//        $color = "#C9a750";
//        $cloud = "Analytics";
//        $cta = "Find Out How";
//        $headLine = "Complex Questions. [SECONDARY]Simple Answers.";
//        $bodyText = "We can help you use Salesforce to make the right decision every time.";

        if($layout->getCode() === LayoutsManager::CIB_LAYOUT_CODE) {
            return (new ImageProcessorCib($layout, $image))->Process($pmc);
        } else {
            return (new ImageProcessor($layout, $image))->Process($pmc);
        }

    }

}
