@extends('front.layouts.front')

@section('title')
    سبد خرید | فروشگاه اینترنتی لباس
@endsection

@section('content')
    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="{{ route('home.index') }}"> صفحه اصلی </a>
                    </li>
                    <li class="font-weight-bold">سبد خرید</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="cart-main-area pt-95 pb-100 text-right" style="direction: rtl;">

        @if(\Cart::isEmpty())
            <div class="container cart-empty-content">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <img src="{{ asset('/static/files/empty-cart.svg') }}" alt="">
                        <h4 class="font-weight-bold my-4">سبد خرید شما خالی است.</h4>
                        <a href="{{ route('home.index') }}">بازگشت به فروشگاه</a>
                    </div>
                </div>
            </div>
        @else
            <div class="container">
                @include('errors.message')
                <h3 class="cart-page-title font-weight-bold"> سبد خرید شما </h3>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                        <form action="{{ route('home.cart.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="table-content table-responsive cart-table-content">
                                <table>
                                    <thead>
                                    <tr>
                                        <th> تصویر محصول</th>
                                        <th> نام محصول</th>
                                        <th> فی</th>
                                        <th> تعداد</th>
                                        <th> قیمت</th>
                                        <th> عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach(\Cart::getContent() as $item)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <img width="100px"
                                                     src="{{ productImageUrl($item->associatedModel->primary_image) }}"
                                                     alt="{{ $item->name }}">
                                            </td>
                                            <td class="product-name">
                                                <a target="_blank"
                                                   href="{{ route('home.products.show', $item->associatedModel->slug) }}">{{ $item->name }}</a>
                                                <div style="direction: rtl;font-size: 12px;color: #7b7b7b">
                                                    {{ \App\Models\Attribute::find($item->attributes->attribute_id)->name }}
                                                    :
                                                    {{ $item->attributes->value }}
                                                </div>
                                            </td>
                                            <td class="product-price-cart">
                                                <span class="amount">
                                                    {{ $item->attributes->is_sale ? number_format($item->attributes->sale_price) : number_format($item->attributes->price) }}
                                                    تومان
                                                </span>
                                                @if($item->attributes->is_sale)
                                                    <p style="font-size: 12px;color: #7b7b7b">
                                                        {{ $item->attributes->persent_sale }}%
                                                        تخفیف
                                                    </p>
                                                @endif
                                            </td>
                                            <td class="product-quantity">
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" type="text"
                                                           name="qtybutton[{{ $item->id }}]"
                                                           value="{{ $item->quantity }}"
                                                           data-max="{{ $item->attributes->quantity }}">
                                                </div>
                                            </td>
                                            <td class="product-subtotal">
                                                {{ number_format($item->price * $item->quantity) }}
                                                تومان
                                            </td>
                                            <td class="product-remove">
                                                <a href="{{ route('home.cart.remove', $item->id) }}">
                                                    <i class="sli sli-close"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cart-shiping-update-wrapper">
                                        <div class="cart-clear">
                                            <button type="submit"> به روز رسانی سبد خرید</button>
                                            <a href="{{ route('home.cart.clear') }}"> پاک کردن سبد خرید </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="row justify-content-between">

                            <div class="col-lg-4 col-md-6">
                                <div class="discount-code-wrapper">
                                    <div class="title-wrap">
                                        <h4 class="cart-bottom-title section-bg-gray"> کد تخفیف </h4>
                                    </div>
                                    <div class="discount-code">
                                        <p>کد تخفیف دارید؟</p>
                                        <form action="{{ route('home.coupons.check') }}" method="POST">
                                            @csrf
                                            <input type="text" name="code" placeholder="کد تخفیف">
                                            <button class="cart-btn-2" type="submit"> ثبت</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-12">
                                <div class="grand-totall">
                                    <div class="title-wrap">
                                        <h4 class="cart-bottom-title section-bg-gary-cart"> مجموع سفارش </h4>
                                    </div>
                                    <h5>
                                        مبلغ سفارش :
                                        <span>
                                            {{ number_format(\Cart::getTotal() + cartTotalSaleAmount()) }}
                                            تومان
                                        </span>
                                    </h5>

                                    @if(cartTotalSaleAmount() > 0)
                                        <h5>
                                            مبلغ تخفیف کالاها :
                                            <span style="color: #ff3535">
                                                {{ number_format(cartTotalSaleAmount()) }}
                                                تومان
                                            </span>
                                        </h5>
                                    @endif

                                    @if(session()->has('coupon'))
                                        <h5>
                                            مبلغ کد تخفیف :
                                            <span style="color: #ff3535">
                                                {{ number_format(session()->get('coupon.amount')) }}
                                                تومان
                                            </span>
                                        </h5>
                                    @endif

                                    <div class="total-shipping">
                                        <h5>
                                            هزینه ارسال :
                                            @if(cartTotalDeliveryAmount() == 0)
                                                <span>رایگان</span>
                                            @else
                                                <span>
                                                    {{ number_format(cartTotalDeliveryAmount()) }}
                                                    تومان
                                                </span>
                                            @endif
                                        </h5>
                                    </div>
                                    <h4 class="grand-totall-title">
                                        جمع کل:
                                        <span>
                                            {{ number_format(cartTotalAmount()) }}
                                            تومان
                                        </span>
                                    </h4>
                                    <a href="#"> ادامه فرآیند خرید </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endif

    </div>

@endsection
