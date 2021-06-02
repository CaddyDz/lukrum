<?php


namespace App\utils\Pmc\Assets\Blue;


use App\utils\Pmc\Assets\Contracts\FeaturedImageContract;
use App\utils\Pmc\Assets\FeaturedImageSimple;

class LayoutBlue extends \App\utils\Pmc\Assets\LayoutAbstract implements \App\utils\Pmc\Assets\Contracts\LayoutContract
{

    public function getCode(): string
    {
        return 'Blue';
    }

    public function getFeaturedImage(): FeaturedImageContract
    {
        return new FeaturedImageSimple('https://res.cloudinary.com/pierry/image/upload/v1619699329/pmc/assets/mi6a4hncq74xbwqktfvg.png');
    }

    public function getDefaultColor(): string
    {
        return "#459CD5";
    }

    public function isColorChangeable(): bool
    {
        return false;
    }

    public function hasOverlay(): bool
    {
        return true;
    }

    protected $images = [
        'large_rectangle' => BlueImageLargeRectangle::class,
        'sky_scrapper' => BlueImageSkyScrapper::class,
        'medium_rectangle' => BlueImageMediumRectangle::class,
        'mobile' => BlueImageMobile::class,
        'leader_board' => BlueImageLeaderBoard::class,

        'facebook' => BlueImageFacebook::class,
        'twitter' => BlueImageTwitter::class,
        'instagram' => BlueImageInstagram::class,
        'linkedin' => BlueImageLinkedIn::class,

        'landing' => BlueImageLanding::class,
        'one_page' => BlueImageOnePage::class,
    ];

    protected $templates = [
        'landing' => BlueTemplateLanding::class,
        'one_pager' => BlueTemplateOnePager::class,
    ];
}
