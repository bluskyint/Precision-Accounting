<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CKEditorUploadImageController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = $file->getClientOriginalName();
            $path = $file->storeAs('tempContentImages', $fileName, 'public');
            return response()->json([
                'fileName' => $fileName,
                'uploaded' => 1,
                'url' => asset("storage/$path"),
            ]);
        }
    }
}
