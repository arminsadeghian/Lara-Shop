<?php

namespace App\Utils;

final class ProductImageUploader
{
    private const IMAGE_STORAGE_PATH = '\images\products';

    public static function upload($image): string
    {
        $imageFileName = fileNameToHash($image->getClientOriginalName());
        $image->move(public_path(self::IMAGE_STORAGE_PATH), $imageFileName);

        return $imageFileName;
    }
}
