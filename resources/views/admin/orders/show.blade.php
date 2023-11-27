@extends('admin.layouts.admin')

@section('title')
    نمایش سفارش {{ $order->reference_code }}
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">نمایش سفارش {{ $order->reference_code }}</h5>
            </div>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>کاربر</label>
                    <input class="form-control" value="{{ $order->user->cellphone }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>آدرس گیرنده</label>
                    <input class="form-control" value="{{ $order->address->title }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>کد تخفیف</label>
                    <input class="form-control" value="{{ $order->coupon->code ?? 'ندارد' }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>وضعیت</label>
                    <input class="form-control" value="{{ $order->payment_status == 1 ? 'پرداخت شده' : 'پرداخت نشده' }}"
                           disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>کد پیگیری</label>
                    <input class="form-control" value="{{ $order->reference_code }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>مبلغ قابل پرداخت</label>
                    <input class="form-control" value="{{ number_format($order->paying_amount) }}" disabled>
                </div>
            </div>

            <table class="table table-bordered table-striped text-center my-5">
                <thead>
                <tr>
                    <th>تصویر محصول</th>
                    <th>نام محصول</th>
                    <th>فی</th>
                    <th>تعداد</th>
                    <th>متغیر</th>
                    <th>قیمت کل</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td class="product-thumbnail">
                            <img height="70px"
                                 src="{{ productImageUrl($item->product->primary_image) }}"
                                 alt="">
                        </td>
                        <td class="product-name">
                            <a target="_blank"
                               href="{{ route('home.products.show', $item->product->slug) }}">
                                {{ $item->product->name }}
                            </a>
                        </td>
                        <td class="product-price-cart">
                              <span class="amount">
                                   {{ number_format($item->price) }}
                                   تومان
                             </span>
                        </td>
                        <td class="product-quantity">
                            {{ $item->quantity }}
                        </td>
                        <td class="product-subtotal">
                            {{ \App\Models\ProductVariation::find($item->product_variation_id)->value }}
                        </td>
                        <td class="product-subtotal">
                            {{ number_format($item->subtotal) }}
                            تومان
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <a href="{{ route('admin.orders.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
        </div>
    </div>

@endsection
