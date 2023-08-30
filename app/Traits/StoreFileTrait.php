<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait StoreFileTrait
{
    public function storeImage(string $filePath, $file): string
    {
        $file_name = Str::slug($fileNameRef) . '.' . $file['src']->getClientOriginalExtension();
        $file['src']->storeAs($filePath, $file_name, 'public');

        return $file_name;
    }
}
