<?php


namespace App\utils\Pmc\Assets\Cib;


use App\utils\Pmc\Assets\Contracts\FeaturedImageContract;
use App\utils\Pmc\Assets\FeaturedImageSimple;

class LayoutCib extends \App\utils\Pmc\Assets\LayoutAbstract implements \App\utils\Pmc\Assets\Contracts\LayoutContract
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
        'large_rectangle' => CibImageLargeRectangle::class,
        'medium_rectangle' => CibImageMediumRectangle::class,
        'leader_board' => CibImageLeaderBoard::class,
        'sky_scrapper' => CibImageSkyScrapper::class,
        'mobile' => CibImageMobile::class,

        'facebook' => CibImageFacebook::class,
        'instagram' => CibImageInstagram::class,
        'twitter' => CibImageTwitter::class,
        'linkedin' => CibImageLinkedIn::class,

        'landing' => CibImageLanding::class,

        'email' => CibImageEmail::class,
    ];

    protected $templates = [
        'landing' => CibTemplateLanding::class,
        'email' => CibTemplateEmail::class,
        'email_text' => CibTemplateEmailText::class,
    ];

}
