<?php


namespace App\Traits;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * Class UploadTrait
 * @package App\Traits
 */
trait UploadTrait
{
    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 's3', $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);

        return $uploadedFile->storeAs($folder, $name . '.' . $uploadedFile->getClientOriginalExtension(), $disk);
    }
}
