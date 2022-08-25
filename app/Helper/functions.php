<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

function uploadFile($file, $path){
    $fullName = $file->getClientOriginalName();
    $extension = $file->getClientOriginalExtension();
    $fileName   = time() . '_' . Str::slug((explode('.',$fullName)[0]), '_') . '.' . $extension;
    Storage::disk('public')->put($path . $fileName, File::get($file));
    $filePath   = 'storage/'.$path . $fileName;
    return $filePath;
}

function deleteFile($path){
    Storage::disk('public')->delete($path);
}
