<?php


namespace App\utils\Pmc\Assets\Watch;


use App\utils\Pmc\Assets\Contracts\FeaturedImageContract;
use App\utils\Pmc\Assets\FeaturedImageSimple;

class LayoutWatch extends \App\utils\Pmc\Assets\LayoutAbstract implements \App\utils\Pmc\Assets\Contracts\LayoutContract
{

    public function getCode(): string
    {
        return 'Watch';
    }

    public function hasOverlay(): bool {
        return true;
    }


    public function getFeaturedImage(): FeaturedImageContract
    {
        return new FeaturedImageSimple('https://res.cloudinary.com/pierry/image/upload/v1616230428/pmc/assets/wy7wstkrpulfrjnvxqpz.png');
    }

    protected $images = [
        'large_rectangle' => WatchImageLargeRectangle::class,
        'sky_scrapper' => WatchImageSkyScrapper::class,
        'medium_rectangle' => WatchImageMediumRectangle::class,
        'mobile' => WatchImageMobile::class,
        'leader_board' => WatchImageLeaderBoard::class,

        'facebook' => WatchImageFacebook::class,
        'twitter' => WatchImageTwitter::class,
        'instagram' => WatchImageInstagram::class,
        'linkedin' => WatchImageLinkedIn::class,

        'landing' => WatchImageLanding::class,
        'one_page' => WatchImageOnePage::class,
    ];

    protected $templates = [
        'landing' => WatchTemplateLanding::class,
        'one_pager' => WatchTemplateOnePager::class,
    ];
}
