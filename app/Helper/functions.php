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
    if(preg_match('|^storage/.*$|', $path)){
        $path = substr($path, 8);
    }
    Storage::disk('public')->delete($path);
}

function successResponse($code = 200, $data, $message = null)
{
    return response()->json([
        'status'=> 'Success',
        'message' => $message,
        'data' => $data
    ], $code);
}
function errorResponse($code, $data = null, $message = null)
{
    return response()->json([
        'status'=>'Error',
        'message' => $message,
        'data' => $data
    ], $code);
}
