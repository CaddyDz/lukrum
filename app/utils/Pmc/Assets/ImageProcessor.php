<?php


namespace App\utils\Pmc\Assets;


use App\utils\Pmc\Assets\Contracts\AssetImageContract;
use App\utils\Pmc\Assets\Contracts\LayoutContract;
use App\utils\Pmc\PmcForm;
use Cloudinary\Asset\Image;
use Cloudinary\Cloudinary;
use Cloudinary\Transformation\Adjust;
use Cloudinary\Transformation\Argument\Color;
use Cloudinary\Transformation\Argument\Text\FontHinting;
use Cloudinary\Transformation\Argument\Text\FontWeight;
use Cloudinary\Transformation\Compass;
use Cloudinary\Transformation\Effect;
use Cloudinary\Transformation\Gravity;
use Cloudinary\Transformation\ImageTransformation;
use Cloudinary\Transformation\Overlay;
use Cloudinary\Transformation\Position;
use Cloudinary\Transformation\Resize;
use Cloudinary\Transformation\Source;
use Cloudinary\Transformation\TextStyle;
use Cloudinary\Transformation\Transformation;
use function GuzzleHttp\Psr7\str;

class ImageProcessor
{

    public function Process(PmcForm $pmc) {

//        $color = "#C9a750";
//        $cloud = "Analytics";
//        $cta = "Find Out How";
//        $headLine = "Complex Questions. [SECONDARY]Simple Answers.";
//        $bodyText = "We can help you use Salesforce to make the right decision every time.";

        $baseColor = $this->image->GetBaseColor();


        $model = $pmc->GetModel();
        $color = $model->asset_color;

        $source = $this->image->GetDataSource($pmc);
        $cta = $source->GetCta();
        $headLine = $source->GetHeadline();
        $bodyText = $source->GetBody();

        $logo = json_decode($model->logo_json);


        $img = $this->cld->image($this->image->GetEmptyPublicId())
            ->resize(Resize::scale()->width($this->params->size->w));

        if($this->layout->isColorChangeable() && $baseColor !== $color) {
            $img->adjust(Adjust::replaceColor($color)
                ->fromColor(Color::rgb($baseColor))
                ->tolerance(50));
        }

        if($this->layout->hasOverlay()) {
            $this->overlay($img, $pmc);
        }


        $bodyY = $this->headline($img, $headLine, $color);

        $img->effect(Effect::blur(10));

        $bodyWidth = $this->bodyText($img, $bodyText, $color, $bodyY);

        $this->cta($img, $cta, $color);

        $this->logo($img, $logo);

        $url = (string)$img->toUrl();
        $url = str_replace('e_blur:10/', "e_blur:10/c_fit,w_{$bodyWidth},", $url);
//dd($url);
        return $url;

    }

    protected function overlay(Image $img, PmcForm $pmc) {
        $params = $this->params;

        $model = $pmc->GetModel();

        if(!isset($params->overlay)) return;

        $publicId = $params->overlay->public_id;

        if($customRaw = $model->customCreative->overlay_json) {
            if($custom = json_decode($model->customCreative->overlay_json)) {
                $publicId = str_replace('/', ':', $custom->public_id);
            }
        }

        $overlay = Source::image($publicId)
            ->transformation((new Transformation())->resize(Resize::pad($params->overlay->w, $params->overlay->h)));

        if('Blue' === $this->layout->getCode()) {
            $overlay->effect(Effect::colorize(100, 'white'));
        }

        $img->overlay(
            Overlay::source(
                $overlay
            )->position((new Position())
                ->gravity(Gravity::compass(Compass::northWest()))
                ->offsetX($params->overlay->x)
                ->offsetY($params->overlay->y)
            )
        );

        if(isset($params->overlay->layer2)) {

            $overlayImg = Source::image($params->overlay->layer2->public_id);

            $baseColor = $this->image->GetBaseColor();
            $color = $model->asset_color;
            if($baseColor !== $color) {
                $overlayImg
                    ->adjust(Adjust::replaceColor(Color::rgb($color))
                        ->fromColor(Color::rgb($baseColor))
                        ->tolerance(80));
            }



            $img->overlay(
                Overlay::source(
                    $overlayImg
//                    ->transformation((new Transformation())->resize(Resize::pad($params->overlay->w, $params->overlay->h)))
                )->position((new Position())
                    ->gravity(Gravity::compass(Compass::northWest()))
                    ->offsetX($params->overlay->x)
                    ->offsetY($params->overlay->y)
                )
            );
        }
    }

    protected function logo(Image $img, \stdClass $logo) {

        $logoId = str_replace('/', ':', $logo->public_id);

        $params = $this->params;

//

        $logo = Source::image($logoId)->transformation((new Transformation())->resize(Resize::pad($params->logo->w, $params->logo->h)));
        if('Blue' === $this->layout->getCode()) {
            $logo->effect(Effect::colorize(100, 'white'));
        }

        $img->overlay(
            Overlay::source(
                $logo
            )->position((new Position())
                ->gravity(Gravity::compass(Compass::northWest()))
                ->offsetX($params->logo->x)
                ->offsetY($params->logo->y)
            )
        );
    }

    protected function bodyText(Image $img, $bodyText, $color, $bodyY)
    {
        $fontSize = 28;
        $params = $this->params;

        if(isset($params->bodyText->s)) {
            $fontSize *= $params->bodyText->s;
        }

        $len = strlen($bodyText);
        if($len > 63) {
            $fontSize *= 0.7;
        } else if($len > 58) {
            $fontSize *= 0.8;
        } else if($len > 53) {
            $fontSize *= 0.85;
        } else if($len > 48) {
            $fontSize *= 0.9;
        }


        $textColor = $params->bodyText->c;
        if('asset' === $textColor) {
            $textColor = $color;
        }

        $areaWidth = $params->size->w - $params->bodyText->l - $params->bodyText->r;

        if('none' === $params->bodyText->position) return $areaWidth;

        $fontFamily = 'Times New Roman';
        if(isset($params->bodyText->ff)) {
            if('sans-serif' == $params->bodyText->ff) {
                $fontFamily = 'PT Sans';
            }
            if('arial' == $params->bodyText->ff) {
                $fontFamily = 'Arial';
            }
        }
//dump($fontSize);
        $img->overlay(
            Overlay::source(
                Source::text($bodyText, (new TextStyle($fontFamily, round($fontSize, 2)))->textAlignment('left'))
                    ->textColor($textColor)
//                    ->transformation((new ImageTransformation())
//                        ->resize(Resize::fit()->width(400))
//                    )
            )->position((new Position())
                ->gravity(Gravity::compass(Compass::northWest()))
                ->offsetX($params->bodyText->l)
                ->offsetY($params->bodyText->p + $bodyY)
            )
        );

        return $areaWidth;
    }

    protected function headline(Image $img, $headline, $color) {
        $parsed = HeadlineParser::Parse($headline);

        $params = $this->params;

        $fontSize = 50;// * 0.8;
//dump($this->image);
//dump($params);
        $fontSize = round($fontSize * $params->headline->s, 2);

        $len = strlen($parsed['strip']);
        if($len > 50) {
            $fontSize *= 0.8;
        } else if($len > 40) {
            $fontSize *= 0.85;
        } else if ($len > 30) {
            $fontSize *= 0.9;
        }

        $spaceWidth = (int)floor($fontSize / 3.125);


        $primaryColor = $params->headline->c;
        if('asset' === $primaryColor) {
            $primaryColor = $color;
        }

        $secondaryColor = $params->headline->sc;
        if('asset' === $secondaryColor) {
            $secondaryColor = $color;
        }

        $words = array_reduce(array_map(function($part) use ($fontSize, $primaryColor, $secondaryColor) {
            return array_map(function($word) use ($part, $fontSize, $primaryColor, $secondaryColor) {
                return [
                    'word' => trim($word),
                    'size' => $fontSize,
                    'color' => 'secondary' === $part['color'] ? $secondaryColor : $primaryColor,
                ];
            }, array_filter(explode(' ', $part['body']), function($x) {return trim($x); }));

        }, $parsed['parts']), function($c, $x) {
            return array_merge($c, $x);
        }, []);

        $lineHeight = (int)round($fontSize * 1.05);

        $images = array_map(function($w) use ($lineHeight) {
            $url = (string)$this->cld->image("pmc/assets/zdmoy2ms4kko4h5xbuff")
                ->resize(Resize::fill()->width(10)->height($lineHeight))
                ->overlay(
                    Overlay::source(
                        Source::text($w['word'].' bj', (new TextStyle('Times New Roman', $w['size'])))->textColor($w['color'])//->fontHinting(FontHinting::full())
                    )
//                    ->position((new Position())
//                        ->gravity(Gravity::compass(Compass::northWest())
//                            ->offsetX(0)
//                            ->offsetY(0)
//                        )
//                    )
                )
                ->adjust(Adjust::sharpen(30))
                ->toUrl();
//dump($url);
            $color = str_replace('#', '', $w['color']);

            return $this->cld->uploadApi()->upload($url, [
                'folder' => $this->tmpFolder,
                'public_id' => "times_{$w['size']}_{$color}_".md5($w['word']),
                'overwrite' => true,
                'timeout' => 120,
            ]);

            /*
array:18 [▼
      "asset_id" => "f6e68f28130154c4885ee2713e2fc3fb"
      "public_id" => "pmc/tmp_words/times_40_white_10b4eb76294b70d7fd6df997ff06edb1"
      "version" => 1616508146
      "version_id" => "40679aaf9f8d3992b1c3484e7040a6e3"
      "signature" => "9f689893e27873b8c7a1633edf373e8673efc811"
      "width" => 146
      "height" => 38
      "format" => "png"
      "resource_type" => "image"
      "created_at" => "2021-03-23T14:02:26Z"
      "tags" => []
      "bytes" => 1238
      "type" => "upload"
      "etag" => "be67118166bfc50fcf8753ade63f9533"
      "placeholder" => false
      "url" => "http://res.cloudinary.com/pierry/image/upload/v1616508146/pmc/tmp_words/times_40_white_10b4eb76294b70d7fd6df997ff06edb1.png"
      "secure_url" => "https://res.cloudinary.com/pierry/image/upload/v1616508146/pmc/tmp_words/times_40_white_10b4eb76294b70d7fd6df997ff06edb1.png"
      "original_filename" => "zdmoy2ms4kko4h5xbuff"
    ]             * */


        }, $words);

        $areaWidth = $params->size->w - $params->headline->l - $params->headline->r;

        $xOrig = $params->headline->l;
        $xShift = 0;
        $y = $params->headline->y;

        $cropWidth = (int)round($fontSize * 0.95);

//dump($spaceWidth);
        foreach($images as $image) {
            $id = str_replace('/', ':', $image['public_id']);

            $iWidth = $image['width'] - $cropWidth;
            $wordWidth = $iWidth;
            if(0 !== $xShift) {
                $wordEnd = $xShift + $wordWidth;
                if($wordEnd > $areaWidth) {
                    $xShift = 0;
                    $y += $lineHeight;
                }
            }

            $x = $xOrig + $xShift;
//dump("x={$x} y={$y} w={$wordWidth}");
            $img->addTransformation((new ImageTransformation())->overlay(
                Overlay::source(Source::image($id)->crop($iWidth, $image['height'], Gravity::west()))
                    ->position((new Position())
                        ->gravity(Gravity::compass(Compass::northWest()))
                        ->offsetX($x)
                        ->offsetY($y)
                )
            ));

            $xShift += $wordWidth + $spaceWidth;
        }

//die();
        return $y + $lineHeight;
    }

    protected function cta(Image $img, $cta, $color) {
        $params = $this->params;

        $fontSize = 19;
        if(isset($params->cta->s)) {
            $fontSize *= $params->cta->s;
        }

        $len = strlen($cta);
        if($len > 22) {
            $fontSize *= 0.8;
        } else if($len > 18) {
            $fontSize *= 0.9;
        }


        $textColor = $params->cta->c;
        if('asset' === $textColor) {
            $textColor = $color;
        }
        $areaWidth = $params->size->w - $params->cta->l - $params->cta->r;

        $offsetX = (int)(($params->cta->l + ($params->size->w - $params->cta->r - $params->cta->l) / 2) - ($params->size->w / 2));
//dd($offsetX);
        $img->overlay(
            Overlay::source(
                Source::text(strtoupper($cta), (new TextStyle('Arial', round($fontSize, 2)))->textAlignment('center'))
                    ->textColor($textColor)
//                    ->textAlignment('center')
//                    ->transformation((new ImageTransformation())
//                        ->resize(Resize::fit()->width(400))
//                    )
            )->position((new Position())
                ->gravity(Gravity::compass(Compass::north()))
                ->offsetX($offsetX)
                ->offsetY($params->cta->y)
            )
        );

        return $areaWidth;
    }


    public function __construct(LayoutContract $layout, AssetImageContract $image) {
        $this->layout = $layout;
        $this->image = $image;

        $this->params = json_decode(json_encode($image->params()));

        $this->cld = new Cloudinary();

        $env = env('APP_ENV', 'default');
        $this->tmpFolder = "{$env}/pmc/tmp_words";
    }

    protected $cld;

    protected $params;

    protected $layout;
    protected $image;
    protected $tmpFolder;
}
