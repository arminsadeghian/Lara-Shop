@extends('front.layouts.front')

@section('title')
    صفحه سفارش
@endsection

@section('content')
    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="{{ route('home.index') }}">صفحه اصلی</a>
                    </li>
                    <li style="font-weight: bold"> سفارش</li>
                </ul>
            </div>
        </div>
    </div>


    <!-- compare main wrapper start -->
    <div class="checkout-main-area pt-70 pb-70 text-right" style="direction: rtl;">

        <div class="container">

            @include('errors.message')

            @if(!session()->has('coupon'))
                <div class="customer-zone mb-20">
                    <p class="cart-page-title">
                        کد تخفیف دارید؟
                        <a class="checkout-click3" href="#"> میتوانید با کلیک در این قسمت کد خود را اعمال کنید </a>
                    </p>
                    <div class="checkout-login-info3">
                        <form action="{{ route('home.coupons.check') }}" method="POST">
                            @csrf
                            <input type="text" name="code" placeholder="کد تخفیف">
                            <input type="submit" value="اعمال کد تخفیف">
                        </form>
                    </div>
                </div>
            @endif

            <div class="checkout-wrap pt-30">
                <div class="row">

                    <div class="col-lg-7">
                        <div class="billing-info-wrap mr-50">
                            <h3> آدرس تحویل سفارش </h3>

                            <div class="row">
                                <p>
                                    در چه آدرسی میخواهید سفارش خود را تحویل بگیرید؟ لطفا آدرس تحویل سفارش خود را انتخاب
                                    کنید.
                                </p>
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info tax-select mb-20">
                                        <label> انتخاب آدرس تحویل سفارش <abbr class="required"
                                                                              title="required">*</abbr></label>

                                        <select class="form-control email s-email s-wid">
                                            @foreach($addresses as $address)
                                                <option value="{{ $address->id }}">{{ $address->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="your-order-area">
                            <h3> سفارش شما </h3>
                            <div class="your-order-wrap gray-bg-4">
                                <div class="your-order-info-wrap">
                                    <div class="your-order-info">
                                        <ul>
                                            <li class="font-weight-bold"> محصول <span> جمع </span></li>
                                        </ul>
                                    </div>
                                    <div class="your-order-middle">
                                        <ul>

                                            @foreach(\Cart::getContent() as $item)
                                                <li>
                                                    {{ $item->name }}
                                                    -
                                                    {{ $item->quantity }}
                                                    <div style="direction: rtl;font-size: 12px;color: #7b7b7b">
                                                        {{ \App\Models\Attribute::find($item->attributes->attribute_id)->name }}
                                                        :
                                                        {{ $item->attributes->value }}
                                                    </div>
                                                    {{ number_format($item->price) }} تومان
                                                    @if($item->attributes->is_sale)
                                                        <p style="font-size: 12px;color: #7b7b7b">
                                                            {{ $item->attributes->persent_sale }}%
                                                            تخفیف
                                                        </p>
                                                    @endif
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                    <div class="your-order-info order-subtotal">
                                        <ul>
                                            <li>
                                                مبلغ تخفیف کالاها :
                                                <span style="color: #ff3535">
                                                    {{ number_format(cartTotalSaleAmount()) }}
                                                    تومان
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="your-order-info order-subtotal">
                                        <ul>
                                            <li>
                                                مبلغ کد تخفیف :
                                                <span style="color: #ff3535">
                                                    {{ number_format(session()->get('coupon.amount')) }}
                                                    تومان
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="your-order-info order-shipping">
                                        <ul>
                                            <li>
                                                هزینه ارسال :
                                                @if(cartTotalDeliveryAmount() == 0)
                                                    <span>رایگان</span>
                                                @else
                                                    <span>
                                                    {{ number_format(cartTotalDeliveryAmount()) }}
                                                    تومان
                                                </span>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="your-order-info order-total">
                                        <ul>
                                            <li>جمع کل
                                                <span>
                                                    {{ number_format(cartTotalAmount()) }}
                                                    تومان
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="payment-method">
                                    <div class="pay-top sin-payment">
                                        <input id="zarinpal" class="input-radio" type="radio" value="zarinpal"
                                               checked="checked" name="payment_method">
                                        <label for="zarinpal"> درگاه پرداخت زرین پال </label>
                                        <div class="payment-box payment_method_bacs">
                                            <p>
                                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده
                                                از طراحان گرافیک است.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="pay-top sin-payment">
                                        <input id="pay" class="input-radio" type="radio" value="pay"
                                               name="payment_method">
                                        <label for="pay">درگاه پرداخت پی</label>
                                        <div class="payment-box payment_method_bacs">
                                            <p>
                                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده
                                                از طراحان گرافیک است.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="Place-order mt-40">
                                <button type="submit">ثبت سفارش</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
@endsection
