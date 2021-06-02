<?php


namespace App\utils\Pmc\Assets\Slope;


use App\utils\Pmc\Assets\Contracts\FeaturedImageContract;
use App\utils\Pmc\Assets\FeaturedImageSimple;

class LayoutSlope extends \App\utils\Pmc\Assets\LayoutAbstract implements \App\utils\Pmc\Assets\Contracts\LayoutContract
{

    public function getCode(): string
    {
        return 'Slope';
    }

    public function getFeaturedImage(): FeaturedImageContract
    {
        return new FeaturedImageSimple('https://res.cloudinary.com/pierry/image/upload/v1616230101/pmc/assets/epiwvatfcdk2cbl0c9zi.png');
    }

    protected $images = [
        'large_rectangle' => SlopeImageLargeRectangle::class,
        'sky_scrapper' => SlopeImageSkyScrapper::class,
        'medium_rectangle' => SlopeImageMediumRectangle::class,
        'mobile' => SlopeImageMobile::class,
        'leader_board' => SlopeImageLeaderBoard::class,

        'facebook' => SlopeImageFacebook::class,
        'twitter' => SlopeImageTwitter::class,
        'instagram' => SlopeImageInstagram::class,
        'linkedin' => SlopeImageLinkedIn::class,

        'landing' => SlopeImageLanding::class,
        'one_page' => SlopeImageOnePage::class,
    ];

    protected $templates = [
        'landing' => SlopeTemplateLanding::class,
        'one_pager' => SlopeTemplateOnePager::class,
    ];
}
