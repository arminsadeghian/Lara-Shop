<?php

function productImageUrl($image)
{
    return url('/images/products/' . $image);
}

function bannerImageUrl($image)
{
    return url('/images/banners/' . $image);
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

function fileNameToHash($name): string
{
    $explodedFileName = explode('.', $name);
    $fileExtension = strtolower(end($explodedFileName));
    return sha1(time() . rand(1111, 9999)) . '.' . $fileExtension;
}

function cartTotalSaleAmount(): int
{
    $cartTotalSaleAmount = 0;
    foreach (\Cart::getContent() as $item) {
        if ($item->attributes->is_sale) {
            $cartTotalSaleAmount += $item->quantity * ($item->attributes->price - $item->attributes->sale_price);
        }
    }

    return $cartTotalSaleAmount;
}

function cartTotalDeliveryAmount(): int
{
    $cartTotalDeliveryAmount = 0;
    foreach (\Cart::getContent() as $item) {
        $cartTotalDeliveryAmount += $item->associatedModel->delivery_amount;
    }

    return $cartTotalDeliveryAmount;
}
