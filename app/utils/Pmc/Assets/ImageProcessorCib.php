<?php


namespace App\utils\Pmc\Assets;


use App\utils\Pmc\Assets\Contracts\AssetImageContract;
use App\utils\Pmc\Assets\Contracts\LayoutContract;
use App\utils\Pmc\PmcForm;
use Cloudinary\Asset\Image;
use Cloudinary\Cloudinary;
use Cloudinary\Transformation\Adjust;
use Cloudinary\Transformation\Argument\Color;
use Cloudinary\Transformation\Argument\Text\FontHinting;
use Cloudinary\Transformation\Argument\Text\FontWeight;
use Cloudinary\Transformation\BaseAction;
use Cloudinary\Transformation\CommonTransformation;
use Cloudinary\Transformation\Compass;
use Cloudinary\Transformation\Effect;
use Cloudinary\Transformation\Gravity;
use Cloudinary\Transformation\ImageTransformation;
use Cloudinary\Transformation\Overlay;
use Cloudinary\Transformation\Position;
use Cloudinary\Transformation\Resize;
use Cloudinary\Transformation\Source;
use Cloudinary\Transformation\TextStyle;
use Cloudinary\Transformation\Transformation;

class ImageProcessorCib extends ImageProcessor
{

    public function Process(PmcForm $pmc) {
        $baseColor = $this->image->GetBaseColor();


        $color = "#C9a750";
/*
        $cta = "Find Out How";
//        $headLine = "Complex Questions. [SECONDARY]Simple Answers.";
        $headLine = "Dirty data? [SECONDARY]We help you clean and connect it.";
        $bodyText = "We can help you use Salesforce to make the right decision every time.";
        $logoId = "pmc:logos:kwulj3yo6nrz5xqcxigj";
*/
        $model = $pmc->GetModel();

        $source = $this->image->GetDataSource($pmc);
//dd($source);
        $cta = $source->GetCta();
        $bodyText = $source->GetHeadline();

        $logo = json_decode($model->logo_json);
        $logoId = str_replace('/', ':', $logo->public_id);


        $img = $this->cld->image($this->image->GetEmptyPublicId())
            ->resize(Resize::scale()->width($this->params->size->w));


//        $bodyY = $this->headline($img, $headLine, $color);

        $img->effect(Effect::blur(10));

        $bodyWidth = $this->bodyText($img, $bodyText, $color, $this->params->headline->y + $this->params->bodyText->p);

        $ctaWidth = $this->cta($img, $cta, $color);

        $this->logo($img, $logo);
        if(isset($this->params->logo2)) {
            $this->logo2($img, $logo);
        }

        $url = (string)$img->toUrl();
        $url = str_replace('e_blur:10/', "e_blur:10/c_fit,w_{$bodyWidth},", $url);

        if(isset($this->params->cta->ml)) {
//dump("Ivan");
            if($this->params->cta->ml) {
                $theX = $this->params->bodyText->l;
                $theY = 2 * $this->params->bodyText->p + $this->params->headline->y;
//dump($theX);
//dump($theY);
                $url = str_replace("x_{$theX},y_{$theY}/", "x_{$theX},y_{$theY}/c_fit,w_{$ctaWidth},", $url);
            }
        }
//dd($url);
        return $url;

    }

    protected function cta(Image $img, $cta, $color) {
        $params = $this->params;

        $fontSize = 19;
        if(isset($params->cta->s)) {
            $fontSize *= $params->cta->s;
        }

        $len = strlen($cta);
        if($len > 22) {
            $fontSize *= 0.7;
        } else if($len > 18) {
            $fontSize *= 0.8;
        }


        $textColor = $params->cta->c;
        if('asset' === $textColor) {
            $textColor = $color;
        }
        $areaWidth = $params->size->w - $params->cta->l - $params->cta->r;

        $offsetX = (int)(($params->cta->l + ($params->size->w - $params->cta->r - $params->cta->l) / 2) - ($params->size->w / 2));
//dd($offsetX);
        $img->overlay(
            Overlay::source(
                Source::text(strtoupper($cta), (new TextStyle('Arial', round($fontSize, 2)))->textAlignment('center'))
                    ->textColor($textColor)
//                    ->textAlignment('center')
//                    ->transformation((new ImageTransformation())
//                        ->resize(Resize::fit()->width(400))
//                    )
            )->position((new Position())
                ->gravity(Gravity::compass(Compass::north()))
                ->offsetX($offsetX)
                ->offsetY($params->cta->y)
            )
        );

        return $areaWidth;
    }

    protected function logo(Image $img, \stdClass $logo) {

        $logoId = str_replace('/', ':', $logo->public_id);

        $params = $this->params;

//
        $w = $logo->width * ($params->logo->h / $logo->height);
        if($w > $params->logo->w) $w = $params->logo->w;

        $logo = Source::image($logoId)->transformation((new Transformation())->resize(Resize::pad((int)round($w), $params->logo->h)));
        $logo->effect(Effect::colorize(100, 'white'));

        $img->overlay(
            Overlay::source(
                $logo
            )->position((new Position())
                ->gravity(Gravity::compass(Compass::northWest()))
                ->offsetX($params->logo->x)
                ->offsetY($params->logo->y)
            )
        );
    }

    protected function logo2(Image $img, \stdClass $logo) {

        $logoId = str_replace('/', ':', $logo->public_id);

        $params = $this->params;

//
        $w = $params->logo2->w;

        $logo = Source::image($logoId)->transformation((new Transformation())->resize(Resize::pad((int)round($w), $params->logo2->h)));
//        if('Blue' === $this->layout->getCode()) {
//            $logo->effect(Effect::colorize(100, 'white'));
//        }

        $img->overlay(
            Overlay::source(
                $logo
            )->position((new Position())
                ->gravity(Gravity::compass(Compass::northWest()))
                ->offsetX($params->logo2->x)
                ->offsetY($params->logo2->y)
            )
        );
    }

}
