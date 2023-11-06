<?php

function productImageUrl($image)
{
    return url('/images/products/' . $image);
}

function convertShamsiToGregorianDate($date)
{
    if ($date == null) {
        return null;
    }

    $pattern = "/[-\s]/";
    $shamsiDateSplit = preg_split($pattern, $date);
    $gregorianData = verta()->jalaliToGregorian($shamsiDateSplit[0], $shamsiDateSplit[1], $shamsiDateSplit[2]);
    return implode("-", $gregorianData) . " " . $shamsiDateSplit[3];
}
