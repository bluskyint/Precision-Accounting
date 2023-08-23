<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait StoreFileTrait
{
    public function storeFile(string $filePath, string $fileNameRef, $file)
    {
        $file_name = Str::slug($fileNameRef) . '.' . $file->getClientOriginalExtension();
        $file->storeAs($filePath, $file_name, 'public');

        return $file_name;
    }
}
