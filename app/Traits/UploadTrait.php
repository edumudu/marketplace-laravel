<?php

namespace App\Traits;

trait UploadTrait {
  private function imageUpload($images, $imageColumn = null)
    {
      $uploadedImages = [];

      if (!is_array($images)) {
        return $uploadedImages = $images->store('logos', 'public');
      }

      foreach($images as $image){
        $uploadedImages[] = [$imageColumn => $image->store('products', 'public')];
      }

      return $uploadedImages;
    }
} 
