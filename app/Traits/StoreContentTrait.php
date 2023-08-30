<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StoreContentTrait
{
    public function storeImage(string $directoryPath, string $folderNameRef, $file): string
    {
        $fileName = $file['src']->getClientOriginalName();
        $folderName = Str::slug($folderNameRef);
        $imgSrc = "$folderName/$fileName";

        $file['src']->storeAs("$directoryPath/$folderName", $fileName, 'public');

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
