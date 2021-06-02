<?php


namespace App\utils\Pmc\Assets\Girl;


use App\utils\Pmc\Assets\Contracts\FeaturedImageContract;
use App\utils\Pmc\Assets\FeaturedImageSimple;

class LayoutGirl extends \App\utils\Pmc\Assets\LayoutAbstract implements \App\utils\Pmc\Assets\Contracts\LayoutContract
{

    public function getCode(): string
    {
        return 'Girl';
    }

    public function getFeaturedImage(): FeaturedImageContract
    {
        return new FeaturedImageSimple('https://res.cloudinary.com/pierry/image/upload/v1616230529/pmc/assets/acnl8lynerqv7uihvbk8.png');
    }

    public function hasOverlay(): bool
    {
        return true;
    }

    protected $images = [
        'large_rectangle' => GirlImageLargeRectangle::class,
        'sky_scrapper' => GirlImageSkyScrapper::class,
        'medium_rectangle' => GirlImageMediumRectangle::class,
        'mobile' => GirlImageMobile::class,
        'leader_board' => GirlImageLeaderBoard::class,

        'facebook' => GirlImageFacebook::class,
        'twitter' => GirlImageTwitter::class,
        'instagram' => GirlImageInstagram::class,
        'linkedin' => GirlImageLinkedIn::class,

        'landing' => GirlImageLanding::class,
        'one_page' => GirlImageOnePage::class,
    ];

    protected $templates = [
        'landing' => GirlTemplateLanding::class,
        'one_pager' => GirlTemplateOnePager::class,
    ];
}
