@extends('front.layouts.front')

@section('title')
    فروشگاه اینترنتی لباس
@endsection

@section('content')
    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="{{ route('home.index') }}">صفحه اصلی</a>
                    </li>
                    <li style="font-weight: bold">سفارشات من</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="my-account-wrapper pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="myaccount-page-wrapper">
                        @include('errors.message')
                        <div class="row text-right" style="direction: rtl;">
                            <div class="col-lg-3 col-md-4">
                                @include('front.users_profile.sidebar')
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <div class="myaccount-content address-content">
                                    <h3> سفارشات من </h3>

                                    @if(!\App\Models\Order::exists())
                                        <div style="text-align: center">
                                            <img src="{{ asset('/static/files/empty-cart.svg') }}" alt="">
                                            <p class="font-weight-bold">هنوز هیچ سفارشی ثبت نکردید.</p>
                                        </div>
                                    @else
                                        <div class="myaccount-table table-responsive text-center">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>کد پیگیری</th>
                                                    <th>تاریخ</th>
                                                    <th>آدرس گیرنده</th>
                                                    <th>وضعیت</th>
                                                    <th>هزینه ارسال</th>
                                                    <th>کد تخفیف</th>
                                                    <th>جمع کل</th>
                                                    <th>عملیات</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($orders as $order)
                                                    <tr>
                                                        <td>{{ $order->reference_code }}</td>
                                                        <td>
                                                            {{ verta($order->created_at)->format('%d %B %Y | H:i') }}
                                                        </td>
                                                        <td>
                                                            {{ $order->address->title }}
                                                        </td>
                                                        <td>
                                                        <span
                                                            class="{{ $order->payment_status == 1 ? 'text-success' : 'text-danger'}}">
                                                            {{ $order->payment_status == 1 ? 'پرداخت شده' : 'پرداخت نشده' }}
                                                        </span>
                                                        </td>
                                                        <td>
                                                            {{ $order->delivery_amount == 0 ? 'رایگان' : number_format($order->delivery_amount) }}
                                                        </td>
                                                        <td>
                                                            {{ $order->coupon->code ?? 'ندارد' }}
                                                        </td>
                                                        <td>
                                                            {{ number_format($order->paying_amount) }}
                                                            تومان
                                                        </td>
                                                        <td><a href="#" data-toggle="modal"
                                                               data-target="#ordersDetails-{{ $order->id }}"
                                                               class="check-btn sqr-btn "> نمایش جزئیات </a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($orders as $order)
        <div class="modal fade" id="ordersDetails-{{ $order->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12" style="direction: rtl;">
                                <form action="#">
                                    <div class="table-content table-responsive cart-table-content">
                                        <table>
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
                                                        <img width="100px"
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
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
