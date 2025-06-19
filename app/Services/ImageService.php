<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageService
{

    public static function resizeImageSize($image, $size, $quantity = 100,$format = null)
    {

        $image = rawurldecode($image);

        $other_services = [
            'width' => 335,
            'height' => 225,
        ];

        $thumbnail = [
            'width' => 228,
            'height' => 153,
        ];

        $medium = [
            'width' => 355,
            'height' => 222,
        ];

        $large = [
            'width' => 724,
            'height' => 300,
        ];


        if (file_exists(public_path() . $image)) {


            $removeStrogaName = Str::after($image, '/storage/');
            $pathName = pathinfo($removeStrogaName, PATHINFO_DIRNAME);
            $otherServicesPathName = public_path('storage/cache-image/other_services/') . $pathName;
            $thumbnailPathName = public_path('storage/cache-image/thumbnail/') . $pathName;
            $mediumPathName = public_path('storage/cache-image/medium/') . $pathName;
            $largePathName = public_path('storage/cache-image/large/') . $pathName;


            if (!file_exists($otherServicesPathName)) {
                mkdir($otherServicesPathName, 0777, true);
            }

            if (!file_exists($thumbnailPathName)) {
                mkdir($thumbnailPathName, 0777, true);
            }

            if (!file_exists($mediumPathName)) {
                mkdir($mediumPathName, 0777, true);
            }

            if (!file_exists($largePathName)) {
                mkdir($largePathName, 0777, true);
            }

            if ($size == 'other_services') {

                $fileExtension = pathinfo($removeStrogaName, PATHINFO_EXTENSION);
                $fileName = pathinfo($removeStrogaName, PATHINFO_FILENAME);
                $newFileName = $fileName . '-' . $other_services['width'] . 'x' . $other_services['height'] . '.' . $fileExtension;
                $lastFileName = '/storage/cache-image/other_services/' . $pathName . '/' . $newFileName;

                if (file_exists(public_path() . $lastFileName)) {
                    return $lastFileName;
                }

                $img = Image::make(public_path($image));
//                $img->crop($other_services['width'], $other_services['height']);
                $img->fit($other_services['width'], $other_services['height'], function ($constraint) {
//                    $constraint->upsize();
                });


                $img->save($otherServicesPathName . '/' . $newFileName, $quantity,$format);


                return $lastFileName;

            }


            if ($size == 'thumbnail') {

                $fileExtension = pathinfo($removeStrogaName, PATHINFO_EXTENSION);
                $fileName = pathinfo($removeStrogaName, PATHINFO_FILENAME);
                $newFileName = $fileName . '-' . $thumbnail['width'] . 'x' . $thumbnail['height'] . '.' . $fileExtension;
                $lastFileName = '/storage/cache-image/thumbnail/' . $pathName . '/' . $newFileName;

                if (file_exists(public_path() . $lastFileName)) {
                    return $lastFileName;
                }

                $img = Image::make(public_path($image));
//                $img->crop($thumbnail['width'], $thumbnail['height']);
                $img->fit($thumbnail['width'], $thumbnail['height'], function ($constraint) {
//                    $constraint->upsize();
                });


                $img->save($thumbnailPathName . '/' . $newFileName, $quantity,$format);


                return $lastFileName;

            }


            if ($size == 'medium') {

                $fileExtension = pathinfo($removeStrogaName, PATHINFO_EXTENSION);
                $fileName = pathinfo($removeStrogaName, PATHINFO_FILENAME);
                $newFileName = $fileName . '-' . $medium['width'] . 'x' . $medium['height'] . '.' . $fileExtension;
                $lastFileName = '/storage/cache-image/medium/' . $pathName . '/' . $newFileName;

                if (file_exists(public_path() . $lastFileName)) {
                    return $lastFileName;
                }

                $img = Image::make(public_path($image));
//                $img->crop($medium['width'], $medium['height']);
                $img->fit($medium['width'], $medium['height'], function ($constraint) {
//                    $constraint->upsize();
                });
                $img->save($mediumPathName . '/' . $newFileName, $quantity,$format);


                return $lastFileName;

            }


            if ($size == 'large') {

                $fileExtension = pathinfo($removeStrogaName, PATHINFO_EXTENSION);
                $fileName = pathinfo($removeStrogaName, PATHINFO_FILENAME);
                $newFileName = $fileName . '-' . $large['width'] . 'x' . $large['height'] . '.' . $fileExtension;
                $lastFileName = '/storage/cache-image/large/' . $pathName . '/' . $newFileName;

                if (file_exists(public_path() . $lastFileName)) {
                    return $lastFileName;
                }

                $img = Image::make(public_path($image));
//                $img->crop($large['width'], $large['height']);
                $img->fit($large['width'], $large['height'], function ($constraint) {
//                    $constraint->upsize();
                });
                $img->save($largePathName . '/' . $newFileName, $quantity,$format);

                return $lastFileName;
            }
        } //file_exists()


        return $image;


    }

    public static function customImageReSize($image, $width, $height, $quantity = 100,$format = null)
    {


        if(!empty($image)){
            $image = rawurldecode(str_replace(env('APP_URL'), '', $image));
        }else{
            $image = str_replace(env('APP_URL'), '',asset('assets/images/no-image.png'));
        }





//        $image = rawurldecode(str_replace(env('APP_URL'), '', $image));

        if (file_exists(public_path('/') . $image)) {


            $removeStrogaName = Str::after($image, '/storage/');
            $pathName = pathinfo($removeStrogaName, PATHINFO_DIRNAME);
            $thumbnailPathName = public_path('storage/cache-image/custom/') . $pathName;


            if (!file_exists($thumbnailPathName)) {
                mkdir($thumbnailPathName, 0755, true);
            }


            $fileExtension = pathinfo($removeStrogaName, PATHINFO_EXTENSION);
            $fileName = pathinfo($removeStrogaName, PATHINFO_FILENAME);

            if(!empty($format)){
                $newFileName = Str::slug($fileName, '-') . '-' . $width . 'x' . $height . '.' . $format;
            }else{
                $newFileName = Str::slug($fileName, '-') . '-' . $width . 'x' . $height . '.' . $fileExtension;
            }
            $lastFileName = '/storage/cache-image/custom/' . $pathName . '/' . $newFileName;

            if (file_exists(public_path() . $lastFileName)) {
                return $lastFileName;
            }

            $img = Image::make(public_path($image));


            if($width == null && $height == null){
                $img->save($thumbnailPathName . '/' . $newFileName, $quantity,$format);
            }else{
                if($width == null || $height == null){
                    $img->resize($width, $height, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                }else{


                    $img->fit($width, $height, function ($constraint) {
//                    $constraint->upsize();
                    });



                }
            }



            $img->save($thumbnailPathName . '/' . $newFileName, $quantity,$format);


            return $lastFileName;


        }else{
            return null;
        } //file_exists()


        return $image;


    }

    public static function customSaveUrlImage($url,$folderName)
    {

        $path = public_path('storage/'.$folderName.'/');

        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }


        $filename = basename($url);

        $file = $path . $filename;

        if(!file_exists($file)){
            $img = Image::make($url)->save($path . $filename);

            if($img){
                return str_replace( public_path(),'',$file);
            }else{
                return  str_replace(env('APP_URL'), '',asset('assets/images/no-image.png'));
            }


        }

      return str_replace( public_path(),'',$file);


    }


    public static function removeFiles()
    {
        Storage::deleteDirectory('public/cache-image');

    }

}
