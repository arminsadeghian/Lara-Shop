<?php

use App\Models\Coupon;
use App\Models\Order;
use Carbon\Carbon;

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

function cartTotalAmount()
{
    if (!session()->has('coupon')) {
        return \Cart::getTotal() + cartTotalDeliveryAmount();
    } else {
        if (session()->get('coupon.amount') > (\Cart::getTotal() + cartTotalDeliveryAmount())) {
            return 0;
        } else {
            return (\Cart::getTotal() + cartTotalDeliveryAmount()) - session()->get('coupon.amount');
        }
    }
}

function checkCoupon(string $code)
{
    $coupon = isCouponExists($code);

    if ($coupon == null) {
        return ['error' => 'کد تخفیف اشتباه است'];
    }

    if (isCouponUsed($coupon->id)) {
        return ['error' => 'شما قبلا کد تخفیف استفاده کرده اید'];
    }

    if ($coupon->type == 'amount') {
        session()->put('coupon', [
            'code' => $coupon->code,
            'amount' => $coupon->amount,
        ]);
    } else {

        $cartTotalAmount = \Cart::getTotal();
        $couponAmount = ($cartTotalAmount * $coupon->percentage) / 100;
        $amount = ($couponAmount > $coupon->max_percentage_amount) ? $coupon->max_percentage_amount : $couponAmount;

        session()->put('coupon', [
            'code' => $coupon->code,
            'amount' => $amount,
        ]);
    }

    return ['success' => 'کد تخفیف برای شما ثبت شد'];
}

function isCouponExists(string $code)
{
    $coupon = Coupon::where('code', $code)
        ->where('expired_at', '>', Carbon::now())
        ->first();

    return $coupon ?? null;
}

function isCouponUsed(int $couponId)
{
    return Order::where('user_id', auth()->id())
        ->where('coupon_id', $couponId)
        ->where('payment_status', 1)->exists();
}

function couponAmount()
{
    return session()->has('coupon') ? session()->get('coupon.amount') : null;
}

function getCouponId()
{
    return session()->has('coupon')
        ? Coupon::where('code', session()->get('coupon.code'))->first()->id
        : null;
}
