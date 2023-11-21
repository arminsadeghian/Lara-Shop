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
                    <li style="font-weight: bold">نظرات</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="my-account-wrapper pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row text-right" style="direction: rtl;">
                            <div class="col-lg-3 col-md-4">
                                @include('front.users_profile.sidebar')
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">
                                    <div class="myaccount-content">
                                        <h3> نظرات </h3>
                                        <div class="review-wrapper">

                                            @if($comments->isEmpty())
                                                <div class="alert alert-danger">
                                                    <p>هنوز کامنتی در سایت ثبت نکرده اید</p>
                                                </div>
                                            @else
                                                @foreach($comments as $comment)
                                                    <div class="single-review">
                                                        <div class="review-content w-100 text-right">
                                                            <p class="text-right">{{ $comment->text }}</p>
                                                            <div class="review-top-wrap">
                                                                <div class="review-name d-flex align-items-center">
                                                                    <h4>
                                                                        برای محصول :
                                                                    </h4>
                                                                    <a class="mr-1" target="_blank"
                                                                       href="{{ route('home.products.show', $comment->product->slug) }}"
                                                                       style="color:#ff3535;">
                                                                        {{ $comment->product->name }}
                                                                    </a>
                                                                </div>
                                                                <div>
                                                                    در تاریخ :
                                                                    {{ verta($comment->created_at)->format('Y/m/d H:i') }}
                                                                </div>
                                                                <div>
                                                                    وضعیت :
                                                                    {{ $comment->approved == 1 ? 'تایید شده' : 'در انتظار تایید' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

