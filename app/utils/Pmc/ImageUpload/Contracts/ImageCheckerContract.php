<?php


namespace App\utils\Pmc\ImageUpload\Contracts;


interface ImageCheckerContract
{
    /**
     * @return bool
     * @throws \App\utils\Pmc\ImageUpload\Exceptions\ImageUploadException
     */
    public function Check(): bool;

}
