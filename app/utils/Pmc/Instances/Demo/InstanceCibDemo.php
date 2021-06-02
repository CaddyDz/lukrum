<?php


namespace App\utils\Pmc\Instances\Demo;




class InstanceCibDemo extends \App\utils\Pmc\Instances\InstanceCibHardcodedAbstract implements \App\utils\Pmc\Instances\Contracts\InstanceCibContract
{
    protected static $copies = [
        'setup' => [
            'copies_overview' => false,
            'profile' => false,
        ],

        'common' => [
            'tp1' => [
                'enabled' => true,
                'title' => 'Demo',
                'short_title' => 'Demo',
                'long_title' => '"Demo" Touchpoint',
                'pages' => ['banner', 'sm', 'landing', 'email', ],
                'banner_cta' => [
                    'Lorem ipsum',
                ],

                'sm_cta' => [
                    'Lorem ipsum',
                ],

                'email_intro' => [
                    'Lorem ipsum dolor sit amet, consectetur adipiscing',
                ],
                'email_body' => [
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
                ],
                'email_cta' => [
                    'Lorem ipsum dolor sit amet',
                ],
                'landing_subhead' => [
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, ',
                ],
                'landing_intro' => [
                    'Lorem ipsum dolor sit amet, consectetur',
                ],
                'landing_body' => [
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                ],
                'landing_cta' => [
                    'Lorem ipsum dolor sit amet.',
                    'Lorem ipsum',
                ],
            ],

            'tp2' => [
                'enabled' => false,
                'title' => '',
                'short_title' => '',
                'long_title' => '',
                'pages' => [],
                'banner_cta' => [],
                'sm_cta' => [],
                'landing_subhead' => [],
                'landing_intro' => [],
                'landing_body' => [],
                'landing_cta' => [],
                'email_intro' => [],
                'email_body' => [],
                'email_cta' => [],
            ],
            'tp3' => [
                'enabled' => false,
                'title' => '',
                'short_title' => '',
                'long_title' => '',
                'pages' => [],
                'banner_cta' => [],
                'sm_cta' => [],
                'landing_subhead' => [],
                'landing_intro' => [],
                'landing_body' => [],
                'landing_cta' => [],
                'email_intro' => [],
                'email_body' => [],
                'email_cta' => [],
            ],

            'tp4' => [
                'enabled' => false,
                'title' => '',
                'short_title' => '',
                'long_title' => '',
                'pages' => [],
                'banner_cta' => [],
                'sm_cta' => [],
                'landing_subhead' => [],
                'landing_intro' => [],
                'landing_body' => [],
                'landing_cta' => [],
                'email_intro' => [],
                'email_body' => [],
                'email_cta' => [],
            ],
        ],

        'clouds' => [
            'connect' => [
                'title' => 'Connect',
                'description' => 'Focus on ways your company can help customers connect with their clients.',
                'tp1' => [
                    'banner_subhead' => [
                        'Lorem ipsum dolor sit amet, consectetur',
                    ],
                    'sm_subhead' => [
                        'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    ],
                ],
            ],
        ],


        'questions' => [
            'enabled' => false,
            'categories' => [
                'customer_success' => [],
                'ask_the_expert' => [],
            ],
        ],

    ];
}
