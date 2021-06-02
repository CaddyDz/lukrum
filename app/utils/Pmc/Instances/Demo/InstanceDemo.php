<?php


namespace App\utils\Pmc\Instances\Demo;


use App\utils\Pmc\Instances\Contracts\InstanceCibContract;

class InstanceDemo extends \App\utils\Pmc\Instances\InstanceHardcodedAbstract implements \App\utils\Pmc\Instances\Contracts\InstanceContract
{
    protected $arrayDescriptor = [
        'logo_url' => '/img/lukrum_logo.png',
        'logo_url_full_page' => '/img/lukrum-logo-dark.png',
        'header_html' => 'Welcome to Lukrum <br />Digital Marketing<br />Services Campaign<br />Builder',
        'sub_header_html' => '',
        'footer_html' => 'Lorem Ipsum? Lorem ipsum <a href="mailto:help@emailus.com">help@emailus.com</a><br />© Ipsum 2021 domain.com, inc. Lorem Ipsum',
        'elements' => [
            'language' => false,
            'comments' => false,
            'launch_date' => false,
        ],

        'css_url' => '/css/custom/demo.css',
        'has_payment' => false,
        'has_calendly' => false,
        'password_protected' => true,

        'text_body' => [
            'email_left' => "<div>This website will show you how to build valuable assets for your marketing campaign.</div>",
            'contact_left' => "<div>First, <b>tell us about your company</b>. The name you use in the Company field to the right will appear in some of the copy options presented to you on the next pages.</div>",
            'thank_you' => "We’re working hard making all of your custom assets. You should receive your final files in a few minutes.",
        ],

        'code' => 'demo',
        's3_folder' => 'lukrum',
    ];

    public function Cib(): InstanceCibContract
    {
        return new InstanceCibDemo();
    }

    public function LayoutsManager(): string
    {
        return LayoutsManagerDemo::class;
    }

    public function Favicon()
    {
        return file_get_contents(__DIR__."/lukrum-favicon.ico");
    }

}
