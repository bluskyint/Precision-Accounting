<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StoreContentTrait
{
    public function storeImage($file, string $directoryPath, string|null $folderName = null): string
    {
        $fileName = $file['src']->getClientOriginalName();
        $imgSrc = $folderName ? "$folderName/$fileName" : $fileName;

        $file['src']->storeAs($folderName ? "$directoryPath/$folderName" : $directoryPath, $fileName, 'public');

        // return images src
        return $imgSrc;
    }

    public function moveContentImages(string $content, string $directoryPath): string
    {
        $pattern = "/[\w\-]+\.(jpg|png|gif|jpeg|webp)/i";
        preg_match_all($pattern, $content, $images);
        foreach ($images[0] as $image) {
            Storage::disk('public')->move("tempContentImages/$image", "$directoryPath/$image");
        }

        // return new content
        return Str::replace('/tempContentImages/', "/$directoryPath/", $content);
    }
}
