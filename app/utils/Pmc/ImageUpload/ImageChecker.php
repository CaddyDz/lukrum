<?php


namespace App\utils\Pmc\ImageUpload;


use App\utils\Pmc\ImageUpload\Contracts\ImageDataAccessContract;
use App\utils\Pmc\ImageUpload\Exceptions\DataCorruptedException;
use App\utils\Pmc\ImageUpload\Exceptions\EmptyUrlException;
use App\utils\Pmc\ImageUpload\Exceptions\NoLocalFileException;
use App\utils\Pmc\ImageUpload\Exceptions\UploadInProgressException;
use Illuminate\Support\Facades\Storage;

class ImageChecker implements Contracts\ImageCheckerContract
{
    const ABANDONED_THRESHOLD = '-4 minutes';

    /**
     * @return bool
     * @throws \App\utils\Pmc\ImageUpload\Exceptions\ImageUploadException
     */
    public function Check(): bool
    {
        $url = $this->dataAccess->getUrl();
        if(!$url) throw new EmptyUrlException();

        $json = $this->dataAccess->getJson();

        if('https://' === substr(strtolower($url), 0, 8)) { // Is URL
            if(!$json) throw new DataCorruptedException("URL starts with https://, but JSON is empty");
            if(!isset($json->public_id)) throw new DataCorruptedException("JSON doesn't have public_id field");
            if(!isset($json->secure_url)) throw new DataCorruptedException("JSON doesn't have secure_url field");
            if($url !== $json->secure_url) throw new DataCorruptedException("JSON secure_url doesn't match URL");
            return true;
        } else {
            if(!Storage::exists($url)) throw new NoLocalFileException("Local File Not Found : {$url}");

            if(!$json) {
                $this->setDefaultJson();
                return false;
            }

            if(!isset($json->status)) {
                $this->setDefaultJson();
                return false;
            }

            if('pending' === $json->status) {
                return false;
            }

            if('processing' === $json->status) {
                if(!isset($json->last_touch)) {
                    $this->setDefaultJson();
                    return false;
                }
                $threshold = new \DateTime(self::ABANDONED_THRESHOLD);
                try {
                    $lastTouch = new \DateTime($json->last_touch);
                } catch (\Exception $e) {
                    $this->setDefaultJson();
                    return false;
                }
                if($threshold < $lastTouch) {
                    $this->setDefaultJson();
                    return false;
                }

                throw new UploadInProgressException($lastTouch->format("Y-m-d H:i:s"));
            }
        }
    }

    private function setDefaultJson() {
        $this->dataAccess->updateJson([
            'status' => 'pending',
            'last_touch' => date('Y-m-d H:i:s'),
        ]);
    }

    public function __construct(ImageDataAccessContract $dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    private $dataAccess;
}

/*
{
    "asset_id":"a1070afd69b49e5e731ed05988049e3e",
    "public_id":"pmc\/logos\/uc7txtstxuutwth6b447",
    "version":1617634341,
    "version_id":"8cc252e3bd071e8f7be1dd82349e29cc",
    "signature":"fefbf62ff290e0857394c33dd6402fc3ae77adce",
    "width":188,
    "height":268,
    "format":"jpg",
    "resource_type":"image",
    "created_at":"2021-04-05T14:52:21Z",
    "tags":[],
    "bytes":6279,
    "type":"upload",
    "etag":"2293f6704f825847ad7ce70c846d1067",
    "placeholder":false,
    "url":"http:\/\/res.cloudinary.com\/pierry\/image\/upload\/v1617634341\/pmc\/logos\/uc7txtstxuutwth6b447.jpg",
    "secure_url":"https:\/\/res.cloudinary.com\/pierry\/image\/upload\/v1617634341\/pmc\/logos\/uc7txtstxuutwth6b447.jpg",
    "original_filename":"phpMos38f"
}
*/
