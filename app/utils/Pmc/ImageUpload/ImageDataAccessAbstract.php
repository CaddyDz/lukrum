<?php


namespace App\utils\Pmc\ImageUpload;


use App\utils\Pmc\PmcForm;

abstract class ImageDataAccessAbstract implements Contracts\ImageDataAccessContract
{
    /**
     * @param PmcForm $pmc
     * @param string $imageType
     * @return Contracts\ImageDataAccessContract
     * @throws \Exception
     */
    public static function Create(PmcForm $pmc, string $imageType): Contracts\ImageDataAccessContract {
        switch($imageType) {
            case 'logo':
                return new ImageDataAccessLogo($pmc);
                break;

            case 'overlay':
                return new ImageDataAccessOverlay($pmc);
                break;

            case 'profile':
                return new ImageDataAccessProfile($pmc);
                break;

            default:
                throw new \Exception("Unknown Image Type : {$imageType}");
                break;
        }
    }

    public function __construct(PmcForm $pmc)
    {
        $this->pmc = $pmc;
    }

    protected $pmc;

    protected function getJsonString($json): ?string {
        $string = null;
        if(is_string($json) && strlen($string) > 0) { // Assuming Correct Json has come
            $string = $json;
        } elseif (is_array($json) || is_object($json)) {
            $string = json_encode($json);
        }
        return $string;
    }
}
