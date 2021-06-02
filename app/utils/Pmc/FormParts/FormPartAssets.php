<?php


namespace App\utils\Pmc\FormParts;


use App\Models\CampaignInABox;
use App\Models\CustomCreative;
use App\utils\Pmc\Assets\HeadlineParser;
use App\utils\Pmc\AssetsManager;
use App\utils\Pmc\FormPartAbstract;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;

class FormPartAssets extends FormPartAbstract
{
    public function FillFromRequest(Request $request)
    {
//        parent::FillFromRequest($request);

        $upload = (new Cloudinary(config('constants.cloudinary_url')))->uploadApi();

        if($f = $request->file('logo')) {
            $this->uploadLogo($f, $upload);
        }

        if('cib' === $request->path) {
            $this->fillForCib($request, $upload);
        } else {
            $this->fillForCc($request, $upload);
        }

        $this->model->comments = $request->comments;
        if($request->launchDate) {
            try {
                if($request->launchTime) {
                    $d = new \DateTime("{$request->launchDate} {$request->launchTime}");
                } else {
                    $d = new \DateTime("{$request->launchDate}");
                }
                $this->model->launch_date_time = $d->format("Y-m-d H:i:s");
            } catch (\Exception $e) {
                $this->model->launch_date_time = null;
            }
        } else {
            $this->model->launch_date_time = null;
        }
    }

    private function fillForCib(Request $request, UploadApi $upload) {
//dump($request->file('profile'));
//dd($request->all());

        $this->cib->focus = $request->focus;
        if($f = $request->file('profile')) {
            $this->uploadProfile($f, $upload);
        }

        $_mapping = [
            'banner_body' => 'ads_headline',
            'banner_cta' => 'ads_cta',
            'sm_body' => 'sm_headline',
            'sm_cta' => 'sm_cta',

            'landing_subhead' => 'ld_headline',
            'landing_intro' => 'ld_intro',
            'landing_body' => 'ld_body',
            'landing_cta' => 'ld_cta',

            'email_intro' => 'email_intro',
            'email_body' => 'email_body',
            'email_cta' => 'email_cta',
        ];
        foreach([1, 2, 3, 4] as $i) {
            $rKey = "tp{$i}";
            if($request->{$rKey}) {
                foreach($_mapping as $k1 => $k2) {
                    if(isset($request->{$rKey}[$k1]) && is_array($request->{$rKey}[$k1])) {
                        $s = $request->{$rKey}[$k1];
                        $cKey = "tp{$i}_{$k2}_original";
                        $this->cib->{$cKey} = $s['original'];
                        $cKey = "tp{$i}_{$k2}_edited";
                        $this->cib->{$cKey} = $s['override'];
                    }
                }
            }
        }

        if($request->questions) {
            $idx = 1;
            foreach($request->questions as $cat => $catQuestions) {
                foreach($catQuestions as $q) {
                    $cKey = "question{$idx}";
                    $this->cib->{$cKey} = $q['question'];
                    $cKey = "answer{$idx}";
                    $this->cib->{$cKey} = $q['answer'];

                    $idx++;
                }
            }
        }

/*
"tp1" => array:4 [▼
    "banner_body" => array:2 [▼
      "original" => "Make every touchpoint a great customer experience."
      "override" => null
    ]
    "banner_cta" => array:2 [▶]
    "sm_body" => array:2 [▶]
    "sm_cta" => array:2 [▶]
  ]
  "tp2" => array:8 [▼
    "banner_body" => null
    "banner_cta" => null
    "sm_body" => null
    "sm_cta" => null
    "landing_subhead" => array:2 [▶]
    "landing_intro" => array:2 [▶]
    "landing_body" => array:2 [▶]
    "landing_cta" => array:2 [▶]
  ]
         */

        /*


                $table->text("question1")->nullable();
                $table->text("answer1")->nullable();
                $table->text("question2")->nullable();
                $table->text("answer2")->nullable();
                $table->text("question3")->nullable();
                $table->text("answer3")->nullable();
                $table->text("question4")->nullable();
                $table->text("answer4")->nullable();
                $table->text("question5")->nullable();
                $table->text("answer5")->nullable();
                $table->text("question6")->nullable();
                $table->text("answer6")->nullable();
                $table->text("question7")->nullable();
                $table->text("answer7")->nullable();
                $table->text("question8")->nullable();
                $table->text("answer8")->nullable();
                $table->text("question9")->nullable();
                $table->text("answer9")->nullable();
                $table->text("question10")->nullable();
                $table->text("answer10")->nullable();
                $table->text("question11")->nullable();
                $table->text("answer11")->nullable();
        */

        $this->cib->expert_name = $request->expertName;
        $this->cib->expert_title = $request->expertTitle;
    }

    private function fillForCc(Request $request, UploadApi $upload) {
        $this->model->asset_color = $request->color;
        $this->cc->layout_code = $request->layout;
        $this->cc->cloud = $request->cloud;

        if($f = $request->file('overlay')) {
            $this->uploadOverlay($f, $upload);
        }

        if($request->banner) {
            $this->cc->ads_cta_original = $request->banner['cta']['original'];
            $this->cc->ads_body_original = $request->banner['bodyText']['original'];
            $this->cc->ads_headline_original = $request->banner['headline']['original']['raw'];

            $this->cc->ads_cta_edited = $request->banner['cta']['override'];
            $this->cc->ads_body_edited = $request->banner['bodyText']['override'];
            $this->cc->ads_headline_edited = $request->banner['headline']['override'];
        }

        if($request->sm) {
            $this->cc->sm_cta_original = $request->sm['cta']['original'];
            $this->cc->sm_body_original = $request->sm['bodyText']['original'];
            $this->cc->sm_headline_original = $request->sm['headline']['original']['raw'];

            $this->cc->sm_cta_edited = $request->sm['cta']['override'];
            $this->cc->sm_body_edited = $request->sm['bodyText']['override'];
            $this->cc->sm_headline_edited = $request->sm['headline']['override'];
        }

        if($request->landing) {
            $this->cc->ld_cta_original = $request->landing['cta']['original'];
            $this->cc->ld_body_original = $request->landing['bodyText']['original'];
            $this->cc->ld_headline_original = $request->landing['headline']['original']['raw'];
            $this->cc->ld_subhead_original = $request->landing['subhead']['original'];

            $this->cc->ld_cta_edited = $request->landing['cta']['override'];
            $this->cc->ld_body_edited = $request->landing['bodyText']['override'];
            $this->cc->ld_headline_edited = $request->landing['headline']['override'];
            $this->cc->ld_subhead_edited = $request->landing['subhead']['override'];
        }

        if($request->op) {
            $this->cc->op_cta_original = $request->op['cta']['original'];
            $this->cc->op_body_original = $request->op['bodyText']['original'];
            $this->cc->op_headline_original = $request->op['headline']['original'];
            $this->cc->op_subhead_original = $request->op['subhead']['original'];

            $this->cc->op_cta_edited = $request->op['cta']['override'];
            $this->cc->op_body_edited = $request->op['bodyText']['override'];
            $this->cc->op_headline_edited = $request->op['headline']['override'];
            $this->cc->op_subhead_edited = $request->op['subhead']['override'];

            $this->cc->op_professionals = $request->op['professionals'];
            $this->cc->op_projects = $request->op['projects'];
        }

    }

    private function uploadLogo(\Illuminate\Http\UploadedFile $f, UploadApi $upload) {
        $uploadOptions = ['timeout' => 120, ];
        if($this->model->logo_url && $this->model->logo_json && $raw = json_decode($this->model->logo_json)) {
            if (isset($raw->public_id) && $raw->public_id) {
                $uploadOptions['public_id'] = $raw->public_id;
            }
        }

        if(!isset($uploadOptions['public_id'])) {
            $env = env('APP_ENV', 'default');
            $uploadOptions['folder'] = "{$env}/pmc/logos";
        }

        try {
            $response = $upload->upload($f->getPathname(), $uploadOptions);
            $this->model->logo_url = $response->offsetGet('secure_url');
            $this->model->logo_json = json_encode($response);
        } catch (\Exception $e) {
            $this->model->logo_url = $e->getMessage();
            $this->model->logo_json = json_encode(['file' => $f, 'fileError' => $f->getErrorMessage(), 'exception' => $e->getTrace(),]);
            // Ignore For Now
        }
/*
  `logo_url` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `logo_json` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
 */
    }

    private function uploadOverlay(\Illuminate\Http\UploadedFile $f, UploadApi $upload) {
        $uploadOptions = ['timeout' => 120, ];
        if($this->cc->overlay_url && $this->cc->overlay_json && $raw = json_decode($this->cc->overlay_json)) {
            if (isset($raw->public_id) && $raw->public_id) {
                $uploadOptions['public_id'] = $raw->public_id;
            }
        }

        if(!isset($uploadOptions['public_id'])) {
            $env = env('APP_ENV', 'default');
            $uploadOptions['folder'] = "{$env}/pmc/overlays";
        }

        try {
            $response = $upload->upload($f->getPathname(), $uploadOptions);
            $this->cc->overlay_url = $response->offsetGet('secure_url');
            $this->cc->overlay_json = json_encode($response);
        } catch (\Exception $e) {
            $this->cc->overlay_url = $e->getMessage();
            $this->cc->overlay_json = json_encode(['file' => $f, 'fileError' => $f->getErrorMessage(), 'exception' => $e->getTrace(),]);
            // Ignore For Now
        }
    }

    private function uploadProfile(\Illuminate\Http\UploadedFile $f, UploadApi $upload) {
        $uploadOptions = ['timeout' => 120, ];
        if($this->cib->profile_url && $this->cib->profile_json && $raw = json_decode($this->cib->profile_json)) {
            if (isset($raw->public_id) && $raw->public_id) {
                $uploadOptions['public_id'] = $raw->public_id;
            }
        }

        if(!isset($uploadOptions['public_id'])) {
            $env = env('APP_ENV', 'default');
            $uploadOptions['folder'] = "{$env}/pmc/profiles";
        }

        try {
            $response = $upload->upload($f->getPathname(), $uploadOptions);
            $this->cib->profile_url = $response->offsetGet('secure_url');
            $this->cib->profile_json = json_encode($response);
        } catch (\Exception $e) {
            $this->cib->profile_url = $e->getMessage();
            $this->cib->profile_json = json_encode(['file' => $f, 'fileError' => $f->getErrorMessage(), 'exception' => $e->getTrace(),]);
            // Ignore For Now
        }
    }

    private function _deleteExistingLogo(UploadApi $upload) {
        if($this->model->logo_url && $this->model->logo_json && $raw = json_decode($this->model->logo_json)) {
            if(isset($raw->public_id)) {
                try {
                    $upload->destroy($raw->public_id);
                } catch (\Exception $e) {
                    //Ignore for now
                }
            }
        }
    }


    public function toJson()
    {
        $output = parent::toJson();

        $output->path = $this->model->path;
        $output->logo_url = $this->model->logo_url;
        $output->color = $this->model->asset_color;

        $output->comments = $this->model->comments;
        if($this->model->launch_date_time) {
            try {
                $d = new \DateTime($this->model->launch_date_time);
                $output->launchDate = $d->format('Y-m-d');
            } catch (\Exception $e) {
                // Ignore
            }
        }

        if('cib' === $output->path) {
            $this->prepareForCib($output);
        } else {
            $this->prepareForCc($output);
        }

        return $output;
    }

    protected function prepareForCib($output) {
//        dd($this->cib);
        $output->focus = $this->cib->focus;
        $output->expertName = $this->cib->expert_name;
        $output->expertTitle = $this->cib->expert_title;
        $output->profile_url = $this->cib->profile_url;

        for($tpNumber = 1; $tpNumber <= 4; $tpNumber++) {
            $tpCode = "tp{$tpNumber}";
            $output->{$tpCode} = [
                'banner_body' => [
                    'original' => $this->cib->{"{$tpCode}_ads_headline_original"},
                    'override' => $this->cib->{"{$tpCode}_ads_headline_edited"},
                ],
                'banner_cta' => [
                    'original' => $this->cib->{"{$tpCode}_ads_cta_original"},
                    'override' => $this->cib->{"{$tpCode}_ads_cta_edited"},
                ],

                'sm_body' => [
                    'original' => $this->cib->{"{$tpCode}_sm_headline_original"},
                    'override' => $this->cib->{"{$tpCode}_sm_headline_edited"},
                ],
                'sm_cta' => [
                    'original' => $this->cib->{"{$tpCode}_sm_cta_original"},
                    'override' => $this->cib->{"{$tpCode}_sm_cta_edited"},
                ],

                'email_intro' => [
                    'original' => $this->cib->{"{$tpCode}_email_intro_original"},
                    'override' => $this->cib->{"{$tpCode}_email_intro_edited"},
                ],
                'email_body' => [
                    'original' => $this->cib->{"{$tpCode}_email_body_original"},
                    'override' => $this->cib->{"{$tpCode}_email_body_edited"},
                ],
                'email_cta' => [
                    'original' => $this->cib->{"{$tpCode}_email_cta_original"},
                    'override' => $this->cib->{"{$tpCode}_email_cta_edited"},
                ],
            ];

            if($tpNumber > 1) {
                $output->{$tpCode} = array_merge($output->{$tpCode}, [
                    'landing_subhead' => [
                        'original' => $this->cib->{"{$tpCode}_ld_headline_original"},
                        'override' => $this->cib->{"{$tpCode}_ld_headline_edited"},
                    ],

                    'landing_intro' => [
                        'original' => $this->cib->{"{$tpCode}_ld_intro_original"},
                        'override' => $this->cib->{"{$tpCode}_ld_intro_edited"},
                    ],
                    'landing_body' => [
                        'original' => $this->cib->{"{$tpCode}_ld_body_original"},
                        'override' => $this->cib->{"{$tpCode}_ld_body_edited"},
                    ],
                    'landing_cta' => [
                        'original' => $this->cib->{"{$tpCode}_ld_cta_original"},
                        'override' => $this->cib->{"{$tpCode}_ld_cta_edited"},
                    ],

                ]);
            }
        }

        $output->questions = [
            'customer_success' => array_map(function($n) {return $this->cib->{"answer{$n}"};}, range(1, 6)),
            'ask_the_expert' => array_map(function($n) {return $this->cib->{"answer{$n}"};}, range(7, 11)),
        ];
//dd($output);
/*
            } else if(ps && ps.questions && ps.questions[this.section] && ps.questions[this.section][i + shift]) {
                this.answers[i] = ps.questions[this.section][i + shift];
            }

 */
    }

    protected function prepareForCc($output) {
        $output->layoutCode = $this->cc->layout_code;
        $output->overlay_url = $this->cc->overlay_url;
        $output->cloud = $this->cc->cloud;
        $output->banner = [
            'headline' => [
                'original' => HeadlineParser::Parse($this->cc->ads_headline_original),
                'override' => $this->cc->ads_headline_edited,
            ],

            'bodyText' => [
                'original' => $this->cc->ads_body_original,
                'override' => $this->cc->ads_body_edited,
            ],

            'cta' => [
                'original' => $this->cc->ads_cta_original,
                'override' => $this->cc->ads_cta_edited,
            ],
        ];
        $output->sm = [
            'headline' => [
                'original' => HeadlineParser::Parse($this->cc->sm_headline_original),
                'override' => $this->cc->sm_headline_edited,
            ],

            'bodyText' => [
                'original' => $this->cc->sm_body_original,
                'override' => $this->cc->sm_body_edited,
            ],

            'cta' => [
                'original' => $this->cc->sm_cta_original,
                'override' => $this->cc->sm_cta_edited,
            ],
        ];
        $output->landing = [
            'headline' => [
                'original' => HeadlineParser::Parse($this->cc->ld_headline_original),
                'override' => $this->cc->ld_headline_edited,
            ],

            'subhead' => [
                'original' => $this->cc->ld_subhead_original,
                'override' => $this->cc->ld_subhead_edited,
            ],

            'bodyText' => [
                'original' => $this->cc->ld_body_original,
                'override' => $this->cc->ld_body_edited,
            ],

            'cta' => [
                'original' => $this->cc->ld_cta_original,
                'override' => $this->cc->ld_cta_edited,
            ],
        ];
        $output->op = [
            'headline' => [
                'original' => $this->cc->op_headline_original,
                'override' => $this->cc->op_headline_edited,
            ],

            'subhead' => [
                'original' => $this->cc->op_subhead_original,
                'override' => $this->cc->op_subhead_edited,
            ],

            'bodyText' => [
                'original' => $this->cc->op_body_original,
                'override' => $this->cc->op_body_edited,
            ],

            'cta' => [
                'original' => $this->cc->op_cta_original,
                'override' => $this->cc->op_cta_edited,
            ],

            'professionals' => $this->cc->op_professionals,
            'projects' => $this->cc->op_projects,
        ];
    }


    protected function init()
    {
        parent::init();
        if('cib' === $this->model->path) {
            $cib = $this->model->cib;

            if(!$cib) {
                $cib = new CampaignInABox();
                $cib->form_id = $this->model->id;
            }
            $this->cib = $cib;

        } else {
            $cc = $this->model->customCreative;
            if(!$cc) {
                $cc = new CustomCreative();
                $cc->form_id = $this->model->id;
            }
            $this->cc = $cc;
        }
    }

    public $cc;
    public $cib;

//    protected $fields = ['asset_id', ];
}
