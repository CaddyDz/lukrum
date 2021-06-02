<?php


namespace App\utils\Pmc\Instances\DefaultOne;


use App\utils\Pmc\Instances\Contracts\InstanceCibContract;

class InstanceDefault extends \App\utils\Pmc\Instances\InstanceHardcodedAbstract implements \App\utils\Pmc\Instances\Contracts\InstanceContract
{
    protected $arrayDescriptor = [
        'logo_url' => '/img/salesforce-logo.png',
        'header_html' => 'Welcome to Salesforce <br/>Digital Marketing <br/>Services Campaign <br/>Builder.',
        'sub_header_html' => 'POWERED BY WUNDERMAN THOMPSON',
        'footer_html' => '© 2021 Pierry Inc. All rights reserved.<br />For help, email <a href="mailto:help@lukrum.com">help@lukrum.com</a>. &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp; <a target="_blank" href="/static/DMS.Partners-Ts&Cs.pdf">Terms and Conditions</a>',
        'elements' => [
            'language' => true,
        ],
        'has_payment' => true,
        'has_calendly' => true,

        'code' => 'default',
        's3_folder' => 'dms',
    ];

    public function Cib(): InstanceCibContract
    {
        return new InstanceCibDefault();
    }

    public function LayoutsManager(): string
    {
        return \App\utils\Pmc\Assets\LayoutsManager::class;
    }

    public function Favicon()
    {
        return file_get_contents(__DIR__."/salesforce-favicon.ico");
    }
}
