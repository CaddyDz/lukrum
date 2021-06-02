<?php


namespace App\utils\Pmc\ImageUpload;

use App\utils\Pmc\ImageUpload\Contracts\ImageDataAccessContract;
use App\utils\Pmc\ImageUpload\Exceptions\ImageUploadException;
use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\Storage;

class ImageUploader implements \App\utils\Pmc\ImageUpload\Contracts\ImageUploaderContract
{
    public function __construct(ImageDataAccessContract $dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    private $dataAccess;

    /**
     * @return bool
     * @throws Exceptions\ImageUploadException
     */
    public function Upload(): bool
    {
        if(false === (new ImageChecker($this->dataAccess))->Check()) {
            $this->doUpload();
        }
        return true;
    }

    /**
     * @throws ImageUploadException
     */
    private function doUpload()
    {
        $upload = (new Cloudinary())->uploadApi();
        $uploadOptions = ['timeout' => 120,];
        $json = $this->dataAccess->getJson();
        if(!$json) $json = new \stdClass();

        $json->status = 'processing';
        $json->last_touch = date('Y-m-d H:i:s');
        $this->dataAccess->updateJson($json);


        if(is_object($json) && isset($json->old_public_id) && $json->old_public_id) {
            $uploadOptions['public_id'] = $json->old_public_id;
        }

        if (!isset($uploadOptions['public_id'])) {
            $uploadOptions['folder'] = $this->dataAccess->getDefaultFolder();
        }

        $attempts = 0;
        $ok = false;
        $lastMessage = $lastException = null;

        $localPath = $this->dataAccess->getUrl();

        while(!$ok && 3 > $attempts) {
            try {
                $response = $upload->upload(Storage::path($localPath), $uploadOptions);

                $this->dataAccess->updateUrl($response->offsetGet('secure_url'));
                $this->dataAccess->updateJson($response);

                Storage::delete($localPath);

                $ok = true;
            } catch (\Exception $e) {
                $lastMessage = $e->getMessage();
                $lastException = json_encode(['file' => $localPath, 'exception' => $e->getTrace(),]);

                $json->last_touch = date('Y-m-d H:i:s');
                $this->dataAccess->updateJson($json);

                ++$attempts;
            }
        }

        if(!$ok) {
            throw new ImageUploadException("Failed To Upload After {$attempts} attempts. {$lastMessage}");
        }
    }
}
