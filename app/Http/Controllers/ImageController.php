<?php

namespace App\Http\Controllers;

use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
  //
	public static function simpleUploadImage64($img64, $path="/storage/images/upload/", $quality=90)
	{
		// TODO:: check if path exists , if not, create it
		$img = Image::make($img64);
    $extension = substr($img64, 11, strpos($img64, ";base64")-11);
    $filename = preg_replace('/\./', '-', microtime(true)).'-forum.'.$extension;

    $img->save(public_path($path)."/$filename", $quality);

    return $path.$filename;
	}

	public static function deleteImage($name)
	{
	    if ($name !== '/storage/images/default.jpg'){
	        $target = preg_replace('/\/storage/', 'public', $name);
	        if (!Storage::exists($target)){
	            return true;
	        }
	        return Storage::delete($target);
	    }
	    return true;
	}
}
