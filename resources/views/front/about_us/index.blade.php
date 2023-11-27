@extends('front.layouts.front')

@section('title')
    درباره ما
@endsection

@section('content')
    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="{{ route('home.index') }}">صفحه اصلی</a>
                    </li>
                    <li class="font-weight-bold"> درباره ما</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="about-story-area pt-100 pb-100" style="direction: rtl;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="story-img">
                        <img src="{{ asset('static/files/about_us.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 text-right">
                    <div class="story-details pl-50">
                        <div class="story-details-top">
                            <h2> خوش آمدید به <span>فروشگاه اینترنتی با لاراول</span></h2>
                            <p>
                                سلام. این یک فروشگاه اینترنتی ساخته شده با فریمورک لاراول است.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="feature-area pt-50 pb-50" style="direction: rtl;">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="single-feature text-right mb-40">
                        <div class="feature-icon">
                            <img src="{{ asset('static/files/free-shipping.png') }}" alt=""/>
                        </div>
                        <div class="feature-content">
                            <h4>ارسال سریع</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="single-feature text-right mb-40 pl-50">
                        <div class="feature-icon">
                            <img src="{{ asset('static/files/support.png') }}" alt=""/>
                        </div>
                        <div class="feature-content">
                            <h4>پشتیبانی 24 ساعته</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="single-feature text-right mb-40">
                        <div class="feature-icon">
                            <img src="{{ asset('static/files/security.png') }}" alt=""/>
                        </div>
                        <div class="feature-content">
                            <h4>امنیت بالا</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
