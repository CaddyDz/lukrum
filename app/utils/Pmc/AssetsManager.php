<?php


namespace App\utils\Pmc;


use App\utils\Pmc\Contracts\AssetsStorageContract;
use Illuminate\Support\Collection;

class AssetsManager
{

    /**
     * @return Collection
     */
    public function ActiveListJson(): Collection {
        return $this->storage()->ActiveList()->map(function($input) {
            return $this->_convertToJson($input);
        });
    }

    public function GetById($id): ?\stdClass {
        if($a = $this->storage()->SearchById($id)) {
            return $this->_convertToJson($a);
        }
        return null;
    }

    private function _convertToJson($input): \stdClass {
        $output = new \stdClass();

        $output->id = $input->id;
        $output->title = $input->title;
        $output->url = $input->url;

        $size = new \stdClass();
        $size->w = $input->width;
        $size->h = $input->height;

        $output->size = $size;

        $logo = new \stdClass();
        $logo->w = $input->logo_width;
        $logo->h= $input->logo_height;
        $logo->x = $input->logo_x;
        $logo->y = $input->logo_y;

        $output->logo = $logo;

        $output->cloudinary_raw = json_decode($input->cloudinary_raw);

        $output->color = $input->color;

        return $output;
    }

    /**
     * @return AssetsStorageContract
     */
    private function storage():AssetsStorageContract {
        if(!$this->storage) {
            $this->storage = new AssetsStorageMockery();
        }
        return $this->storage;
    }

    /**
     * @var AssetsStorageContract
     */
    private $storage;


    /**
     * @return AssetsManager
     */
    public static function instance():AssetsManager {
        if(!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    private static $_instance;

}
