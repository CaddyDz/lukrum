<?php


namespace App\utils\Pmc\Assets\Simple;


use App\utils\Pmc\Assets\Contracts\FeaturedImageContract;
use App\utils\Pmc\Assets\FeaturedImageSimple;

class LayoutSimple extends \App\utils\Pmc\Assets\LayoutAbstract implements \App\utils\Pmc\Assets\Contracts\LayoutContract
{

    public function getCode(): string
    {
        return 'Simple';
    }

    public function getFeaturedImage(): FeaturedImageContract
    {
        return new FeaturedImageSimple('https://res.cloudinary.com/pierry/image/upload/v1619701828/pmc/assets/vfmr6kcar5q0k4mfkscj.png');
    }

    protected $images = [
        'large_rectangle' => SimpleImageLargeRectangle::class,
        'sky_scrapper' => SimpleImageSkyScrapper::class,
        'medium_rectangle' => SimpleImageMediumRectangle::class,
        'mobile' => SimpleImageMobile::class,
        'leader_board' => SimpleImageLeaderBoard::class,

        'facebook' => SimpleImageFacebook::class,
        'twitter' => SimpleImageTwitter::class,
        'instagram' => SimpleImageInstagram::class,
        'linkedin' => SimpleImageLinkedIn::class,

        'landing' => SimpleImageLanding::class,
        'one_page' => SimpleImageOnePage::class,
    ];

    protected $templates = [
        'landing' => SimpleTemplateLanding::class,
        'one_pager' => SimpleTemplateOnePager::class,
    ];

}
