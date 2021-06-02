<?php


namespace App\utils\Pmc;


use App\utils\Pmc\Contracts\AssetsStorageContract;
use Illuminate\Support\Collection;

class AssetsStorageMockery implements AssetsStorageContract
{
    public function ActiveList(): Collection
    {
        $output = collect();

        $output->push($this->_mock1());
        $output->push($this->_mock2());
        $output->push($this->_mock3());
        $output->push($this->_mock4());
        $output->push($this->_mock5());

        return $output;
    }

    public function SearchById($id)
    {
        return $this->ActiveList()->first(function($x) use ($id) {
            return $x->id == $id;
        });
    }

    private function _mock1() {
        $x = new \stdClass();
        $x->id = 'mock1';
        $x->title = 'Color 1';
        $x->url = $this->color1Raw['secure_url'];
        $x->width = $this->color1Raw['width'];
        $x->height = $this->color1Raw['height'];

        $x->logo_width = 100;
        $x->logo_height = 40;
        $x->logo_x = 33;
        $x->logo_y = 14;

        $x->cloudinary_public_id = $this->color1Raw['public_id'];
        $x->cloudinary_raw = json_encode($this->color1Raw);

//        $x->color = '#7BA7D8';
        $x->color = '#84A6D4';
        return $x;
    }

    private function _mock2() {
        $x = new \stdClass();
        $x->id = 'mock2';
        $x->title = 'Color 2';
        $x->url = $this->color2Raw['secure_url'];
        $x->width = $this->color2Raw['width'];
        $x->height = $this->color2Raw['height'];

        $x->logo_width = 100;
        $x->logo_height = 40;
        $x->logo_x = 33;
        $x->logo_y = 14;

        $x->cloudinary_public_id = $this->color2Raw['public_id'];
        $x->cloudinary_raw = json_encode($this->color2Raw);

//        $x->color = '#A6C4E8';
        $x->color = '#ABC4E5';
        return $x;
    }

    private function _mock3() {
        $x = new \stdClass();
        $x->id = 'mock3';
        $x->title = 'Color 3';
        $x->url = $this->color3Raw['secure_url'];
        $x->width = $this->color3Raw['width'];
        $x->height = $this->color3Raw['height'];

        $x->logo_width = 100;
        $x->logo_height = 40;
        $x->logo_x = 33;
        $x->logo_y = 14;

        $x->cloudinary_public_id = $this->color3Raw['public_id'];
        $x->cloudinary_raw = json_encode($this->color3Raw);

//        $x->color = '#9BC386';
        $x->color = '#ACC18C';
        return $x;
    }

    private function _mock4() {
        $x = new \stdClass();
        $x->id = 'mock4';
        $x->title = 'Color 4';
        $x->url = $this->color4Raw['secure_url'];
        $x->width = $this->color4Raw['width'];
        $x->height = $this->color4Raw['height'];

        $x->logo_width = 100;
        $x->logo_height = 40;
        $x->logo_x = 33;
        $x->logo_y = 14;

        $x->cloudinary_public_id = $this->color4Raw['public_id'];
        $x->cloudinary_raw = json_encode($this->color4Raw);

//        $x->color = '#F8E5A3';
        $x->color = '#E6D18C';
        return $x;
    }

    private function _mock5() {
        $x = new \stdClass();
        $x->id = 'mock5';
        $x->title = 'Color 5';
        $x->url = $this->color5Raw['secure_url'];
        $x->width = $this->color5Raw['width'];
        $x->height = $this->color5Raw['height'];

        $x->logo_width = 100;
        $x->logo_height = 40;
        $x->logo_x = 33;
        $x->logo_y = 14;

        $x->cloudinary_public_id = $this->color5Raw['public_id'];
        $x->cloudinary_raw = json_encode($this->color5Raw);

//        $x->color = '#F8F8FF';
//        $x->color = '#C95750';
        $x->color = '#D94E4A';
        return $x;
    }

    private $cRaw1 = [
        "asset_id" => "e55fd0d276ffd67c95bb989496a4aa06",
        "public_id" => "pmc/assets/gufyiev6zbvea6pxviqz",
        "version" => 1614451259,
        "version_id" => "9d7f7055595de2669e8043e567468184",
        "signature" => "b3405ba3c6cc5e05dfda7ff843452a683c43c7eb",
        "width" => 300,
        "height" => 250,
        "format" => "png",
        "resource_type" => "image",
        "created_at" => "2021-02-27T18:40:59Z",
        "tags" => [],
        "bytes" => 20645,
        "type" => "upload",
        "etag" => "c34e29ca68933d45978ef23a7c827dbb",
        "placeholder" => false,
        "url" => "http://res.cloudinary.com/pierry/image/upload/v1614451259/pmc/assets/gufyiev6zbvea6pxviqz.png",
        "secure_url" => "https://res.cloudinary.com/pierry/image/upload/v1614451259/pmc/assets/gufyiev6zbvea6pxviqz.png",
        "original_filename" => "asset1",
    ];


    private $color1Raw = [
        "asset_id" => "340d81bb6cf986e697e97ab3678aea5c",
        "public_id" => "pmc/assets/g1jpnurovaaj63hq57m7",
        "version" => 1616051421,
        "version_id" => "601948f46559c64748753eb6e5abca55",
        "signature" => "fe4356b1061b2c4ce9594fd9c3dcd725833c008c",
        "width" => 300,
        "height" => 250,
        "format" => "png",
        "resource_type" => "image",
        "created_at" => "2021-03-18T07:10:21Z",
        "tags" => [],
        "bytes" => 15544,
        "type" => "upload",
        "etag" => "d2645218dad669ab8e74e81eed8d9ad0",
        "placeholder" => false,
        "url" => "http://res.cloudinary.com/pierry/image/upload/v1616051421/pmc/assets/g1jpnurovaaj63hq57m7.png",
        "secure_url" => "https://res.cloudinary.com/pierry/image/upload/v1616051421/pmc/assets/g1jpnurovaaj63hq57m7.png",
        "original_filename" => "color1",
    ];

    private $color2Raw = [
        "asset_id" => "0d4788c27c180c4d48d649f9e2c6a69a",
        "public_id" => "pmc/assets/amgvpamfytcfvlrziojv",
        "version" => 1616051539,
        "version_id" => "6b252f2fa7678dc4cb08601a164c732e",
        "signature" => "3394e3395cb0d6fb64f840032d708a099851ac46",
        "width" => 300,
        "height" => 250,
        "format" => "png",
        "resource_type" => "image",
        "created_at" => "2021-03-18T07:12:19Z",
        "tags" => [],
        "bytes" => 14248,
        "type" => "upload",
        "etag" => "5ef8e09b145759dc4cf03b56412ac2ea",
        "placeholder" => false,
        "url" => "http://res.cloudinary.com/pierry/image/upload/v1616051539/pmc/assets/amgvpamfytcfvlrziojv.png",
        "secure_url" => "https://res.cloudinary.com/pierry/image/upload/v1616051539/pmc/assets/amgvpamfytcfvlrziojv.png",
        "original_filename" => "color2",
    ];

    private $color3Raw = [
        "asset_id" => "6b0de79a8f159300ba9661c3b16021b4",
        "public_id" => "pmc/assets/nhbnnih5ph7atogdfxwn",
        "version" => 1616051587,
        "version_id" => "547057a52ae2d62aee3ef6d8f1036f05",
        "signature" => "c5663bb547ba59ac05ff61645f8b28bb3511901c",
        "width" => 300,
        "height" => 250,
        "format" => "png",
        "resource_type" => "image",
        "created_at" => "2021-03-18T07:13:07Z",
        "tags" => [],
        "bytes" => 15334,
        "type" => "upload",
        "etag" => "110754872c98457f06cc6439821c1b64",
        "placeholder" => false,
        "url" => "http://res.cloudinary.com/pierry/image/upload/v1616051587/pmc/assets/nhbnnih5ph7atogdfxwn.png",
        "secure_url" => "https://res.cloudinary.com/pierry/image/upload/v1616051587/pmc/assets/nhbnnih5ph7atogdfxwn.png",
        "original_filename" => "color3",
    ];

    private $color4Raw = [
        "asset_id" => "5bbbaa162a16eae68c9ef9bcf7138e35",
        "public_id" => "pmc/assets/wqqrvvoxs59xwop34c6x",
        "version" => 1616051634,
        "version_id" => "67fba4416d809592e885ac71b959d63d",
        "signature" => "c48496689c6cb066c24e0382640dddc1cee49f12",
        "width" => 300,
        "height" => 250,
        "format" => "png",
        "resource_type" => "image",
        "created_at" => "2021-03-18T07:13:54Z",
        "tags" => [],
        "bytes" => 14863,
        "type" => "upload",
        "etag" => "4fccbca94aad03556bf421cb17969f24",
        "placeholder" => false,
        "url" => "http://res.cloudinary.com/pierry/image/upload/v1616051634/pmc/assets/wqqrvvoxs59xwop34c6x.png",
        "secure_url" => "https://res.cloudinary.com/pierry/image/upload/v1616051634/pmc/assets/wqqrvvoxs59xwop34c6x.png",
        "original_filename" => "color4",
    ];

    private $color5Raw = [
        "asset_id" => "971b349178a19d94a6b998b83ceae622",
        "public_id" => "pmc/assets/uiimfodxepnvb8crzk8f",
        "version" => 1616051672,
        "version_id" => "b88968e4ad3c950f3050d8c2ca325826",
        "signature" => "d338daa8a1fbe2f5aa3c737fbe60d64fe3b40587",
        "width" => 300,
        "height" => 250,
        "format" => "png",
        "resource_type" => "image",
        "created_at" => "2021-03-18T07:14:32Z",
        "tags" => [],
        "bytes" => 16855,
        "type" => "upload",
        "etag" => "adedacede0bfd1388fecbbbfa6dc948d",
        "placeholder" => false,
        "url" => "http://res.cloudinary.com/pierry/image/upload/v1616051672/pmc/assets/uiimfodxepnvb8crzk8f.png",
        "secure_url" => "https://res.cloudinary.com/pierry/image/upload/v1616051672/pmc/assets/uiimfodxepnvb8crzk8f.png",
        "original_filename" => "color5",
    ];

}
