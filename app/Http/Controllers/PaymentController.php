<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariation;
use App\Models\Transaction;
use App\Payment\Zarinpal;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $request->validate([
            'address_id' => 'required'
        ]);

        $checkCart = $this->checkCart();
        if (array_key_exists('error', $checkCart)) {
            return redirect()->back()->with('failed', $checkCart['error']);
        }

        $amounts = $this->getAmounts();
        if (array_key_exists('error', $amounts)) {
            return redirect()->back()->with('failed', $amounts['error']);
        }

        $zarinpal = new Zarinpal();
        $result = $zarinpal->request(
            env('ZARINPAL_MERCHANT_ID'),
            $amounts['paying_amount'],
            'Test',
            '',
            '',
            route('home.payment.verify'),
            env('ZARINPAL_IS_SANDBOX'),
            env('ZARINPAL_IS_ZARIN_GATE'),
        );

        if (isset($result["Status"]) && $result["Status"] == 100) {
            $this->createOrder($request->address_id, $amounts, $result['Authority']);
            $zarinpal->redirect($result["StartPay"]);
        }

    }

    public function verify()
    {
        $amounts = $this->getAmounts();
        $zarinpal = new Zarinpal();
        $result = $zarinpal->verify(
            env('ZARINPAL_MERCHANT_ID'),
            $amounts['paying_amount'],
            env('ZARINPAL_IS_SANDBOX'),
            env('ZARINPAL_IS_ZARIN_GATE'),
        );

        if (isset($result["Status"]) && $result["Status"] == 100) {

            $updateOrder = $this->updateOrder($result["Authority"], $result["RefID"]);
            if (array_key_exists('error', $updateOrder)) {
                return redirect()->route('home.cart.index')->with('failed', $updateOrder['error']);
            }

            \Cart::clear();
            session()->forget('coupon');
            return redirect()->route('home.cart.index')->with('success', $updateOrder['success']);
        } else {
            return redirect()->route('home.checkout.index')->with('failed', 'پرداخت با خطا مواجه شد.');
        }

    }

    private function checkCart()
    {
        if (Cart::isEmpty()) {
            return ['error' => 'سبد خرید شما خالی است.'];
        }

        foreach (Cart::getContent() as $item) {
            $variation = ProductVariation::find($item->attributes->id);

            $price = $variation->is_sale ? $variation->sale_price : $variation->price;

            // Price check
            if ($item->price != $price) {
                Cart::clear();
                return ['error' => " قیمت محصول $item->name تغییر پیدا کرده است. "];
            }

            // Quantity check
            if ($item->quantity > $variation->quantity) {
                Cart::clear();
                return ['error' => "تعداد محصول تغییر پیدا کرده است."];
            }
        }

        return ['success' => 'success!'];
    }

    private function getAmounts()
    {
        if (session()->has('coupon')) {
            $checkCoupon = checkCoupon(session()->get('coupon.code'));
            if (array_key_exists('error', $checkCoupon)) {
                return $checkCoupon;
            }
        }

        return [
            'total_amount' => (Cart::getTotal() + cartTotalSaleAmount()),
            'delivery_amount' => cartTotalDeliveryAmount(),
            'coupon_amount' => couponAmount(),
            'paying_amount' => cartTotalAmount(),
        ];
    }

    private function createOrder($addressId, $amount, $token, $gatewayName = 'Zarinpal')
    {
        try {
            DB::beginTransaction();

            // Store order in database
            $order = Order::create([
                'user_id' => auth()->id(),
                'address_id' => $addressId,
                'coupon_id' => getCouponId(),
                'total_amount' => $amount['total_amount'],
                'delivery_amount' => $amount['delivery_amount'],
                'coupon_amount' => $amount['coupon_amount'],
                'paying_amount' => $amount['paying_amount'],
            ]);

            // Store order items in database
            foreach (Cart::getContent() as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->associatedModel->id,
                    'product_variation_id' => $item->attributes->id,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'subtotal' => ($item->quantity * $item->price),
                ]);
            }

            // Store transaction in database
            Transaction::create([
                'user_id' => auth()->id(),
                'order_id' => $order->id,
                'amount' => $amount['paying_amount'],
                'token' => $token,
                'gateway_name' => $gatewayName,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return ['error' => $e->getMessage()];
        }

        return ['success' => 'success!'];
    }

    private function updateOrder($token, $refId)
    {
        try {
            DB::beginTransaction();

            // Update transaction in database
            $transaction = Transaction::where('token', $token)->firstOrFail();
            $transaction->update([
                'status' => 1,
                'ref_id' => $refId
            ]);

            // Update order in database
            $order = Order::findOrFail($transaction->order_id);
            $order->update([
                'status' => 1,
                'payment_status' => 1
            ]);

            // Update product quantity in database
            foreach (Cart::getContent() as $item) {
                $variation = ProductVariation::find($item->attributes->id);
                $variation->update([
                    'quantity' => $variation->quantity - $item->quantity
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return ['error' => $e->getMessage()];
        }

        return ['success' => 'سفارش شما با موفقیت ثبت شد.'];
    }

}
