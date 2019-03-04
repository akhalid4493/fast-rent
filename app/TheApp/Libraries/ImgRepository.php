<?php
namespace App\TheApp\Libraries;

use Image;

class ImgRepository
{

    static public function uploadImage($imgUrl , $highet=null , $width=null, $path = null)
    {
        // Get new name of image Url & Path of folder to save in it
        $fname = 'uploads/'. md5(rand() * time()) . '.' . $imgUrl->getClientOriginalExtension();
        $img = Image::make($imgUrl->getRealPath());

        // Resize image 
        if ($highet && $width != null)
            $img->resize($highet,$width);

        // End of this proccess
        $img->save($fname);

        // Remove the old path in update method
        if ($path != null){
            if(file_exists($path))
                unlink($path);
        }

        
        return $fname;
    }

    static public function mulitUploads($imgUrl , $highet=null , $width=null, $counter=null)
    {
        $file  = $imgUrl;
        $fname = 'uploads/'. md5(rand() * time()) .'.' . $file->getClientOriginalExtension();
        $img = Image::make($file->getRealPath());
        
        // Resize image 
        if ($highet && $width != null)
            $img->resize($highet,$width);

        // End of this proccess
        $img->save($fname);

        return $fname;
    }

    static public function deleteImagePath($path)
    {
        if(file_exists($path))
            unlink($path);

        return true;
    }

    static public function uploadApiFile($file)
    {
        $file_name = substr(md5(time()), 0, 15);

        if (is_string($file)) {
            $extension = "jpg";
            $fileName = $file_name . "." . $extension;
            $binary = base64_decode($file);
            header('Content-Type: bitmap; charset=utf-8');
            $file = fopen('uploads/'. $fileName, 'wb');
            fwrite($file, $binary);
            fclose($file);
        }

        return $fileName;
    }

}