<?php


namespace App\Traits;

trait UploadTraits
{
    public function imageUpload($images, $dir){

        $uploadImages = $images->store($dir, 'public');

        return $uploadImages;
    }
    public function imagesUpload($images, $dir, $imageColumn = null){
        foreach ($images as $image) {
            $uploadImages[] = [$imageColumn => $image->store($dir, 'public')];
        }
        return $uploadImages;
    }
}
