<?php


namespace App\utils\Pmc\Instances\Demo\Layouts\CibDemo;


use App\utils\Pmc\Assets\Cib\CibTemplateEmailText;
use App\utils\Pmc\Assets\Contracts\FeaturedImageContract;
use App\utils\Pmc\Assets\FeaturedImageSimple;

class LayoutCibDemo extends \App\utils\Pmc\Assets\LayoutAbstract implements \App\utils\Pmc\Assets\Contracts\LayoutContract
{

    public function getCode(): string
    {
        return 'Cib';
    }

    public function getFeaturedImage(): FeaturedImageContract
    {
        return new FeaturedImageSimple('https://res.cloudinary.com/pierry/image/upload/v1616230342/pmc/assets/gcppzyfykfrlhmoogstk.png');
    }

    protected $images = [
        'large_rectangle' => CibDemoImageLargeRectangle::class,
        'medium_rectangle' => CibDemoImageMediumRectangle::class,
        'leader_board' => CibDemoImageLeaderBoard::class,
        'sky_scrapper' => CibDemoImageSkyScrapper::class,
        'mobile' => CibDemoImageMobile::class,

        'facebook' => CibDemoImageFacebook::class,
        'instagram' => CibDemoImageInstagram::class,
        'twitter' => CibDemoImageTwitter::class,
        'linkedin' => CibDemoImageLinkedIn::class,

        'landing' => CibDemoImageLanding::class,

        'email' => CibDemoImageEmail::class,
    ];

    protected $templates = [
        'landing' => CibDemoTemplateLanding::class,
        'email' => CibDemoTemplateEmail::class,
        'email_text' => CibTemplateEmailText::class,
    ];

}
