<?php


namespace App\utils\Pmc\Instances;


class DefaultManifest
{
    public static function GetData(): array {
        return self::$data;
    }
    static private $data = [
        'logo_url' => '/img/salesforce-logo.png',
        'logo_url_full_page' => null,
        'header_html' => 'Welcome to Salesforce <br/>Digital Marketing <br/>Services Campaign <br/>Builder.',
        'sub_header_html' => 'POWERED BY WUNDERMAN THOMPSON',
        'footer_html' => '© 2021 Pierry Inc. All rights reserved.<br />For help, email <a href="mailto:help@lukrum.com">help@lukrum.com</a>. &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp; <a target="_blank" href="/static/DMS.Partners-Ts&Cs.pdf">Terms and Conditions</a>',
        'elements' => [
            'language' => true,
            'comments' => true,
            'launch_date' => true,
        ],
        'has_payment' => true,
        'has_calendly' => true,
        'css_url' => null,
        'password_protected' => false,
        'text_body' => [
            'email_left' => "<div>This website will show you how to build valuable assets for your marketing campaign. <b>Before you begin, please be sure to review the <a href=\"#\">Partner Welcome Guide</a></b> so you have all the required information to build the best campaign.</div>",
            'contact_left' => "<div>First, <b>tell us about your company</b>. The name you use in the Company field to the right will appear in some of the copy options presented to you on the next pages.<br /><br />" .
                "One of the two contact email addresses you provided on your original application will be required to access the Campaign Builder as permissions have been granted to these contacts only. Please ensure one of those email addresses is used in order to access Campaign Builder.<br /><br />" .
                "PLEASE NOTE: Because we are using your email address to authorize access, we are not storing any information on our servers. This means that if you allow your computer to idle/sign out, you will have to start the campaign creation process over, so <b>please have all of the information requested in the Partner Welcome Guide prepared before you begin</b>.\n" .
                "</div>",

            'thank_you' => "Thank you for using Campaign Builder. We're sending your assets off to the appropriate teams to finalize them, and we look forward to meeting with you soon.",
        ],
        'code' => 'default',
        's3_folder' => 'dms',
    ];

}
