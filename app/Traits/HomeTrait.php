<?php

namespace App\Traits;

use Domain\Site\Asset\Models\Asset;

trait HomeTrait
{
    public function getUrlMedia(string $name) : string {

        $asset = Asset::with('media')->get();
        $file = $asset->where('name', $name)->first();

        if ($file == null) {
            return '';
        } else {

            return $file->media->first()->getUrl();
        }
        
        
    }

    public function getUrlLink(string $name) : string {

        $asset = Asset::with('media')->get();
        $file = $asset->where('name', $name)->first();

        if ($file == null) {
            return '';
        } else {
            
            return $file->url;
        }
        
        
    }
  
}