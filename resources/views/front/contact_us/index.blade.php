@extends('front.layouts.front')

@section('title')
    تماس با ما
@endsection

@section('content')
    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="{{ route('home.index') }}">صفحه ای اصلی</a>
                    </li>
                    <li class="font-weight-bold">تماس با ما</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="contact-area pt-100 pb-100">
        <div class="container">

            @include('errors.message')

            <div class="row text-right" style="direction: rtl;">
                <div class="col-lg-5 col-md-6">
                    <div class="contact-info-area">
                        <h2>تماس با ما</h2>
                        <p>برای تماس با ما میتوانید سوال و یا پیام خود را با فرم روبرو برای ما ارسال کنید.</p>
                        <div class="contact-info-wrap">
                            <div class="single-contact-info">
                                <div class="contact-info-icon">
                                    <i class="sli sli-location-pin"></i>
                                </div>
                                <div class="contact-info-content">
                                    <p>تهران</p>
                                </div>
                            </div>
                            <div class="single-contact-info">
                                <div class="contact-info-icon">
                                    <i class="sli sli-envelope"></i>
                                </div>
                                <div class="contact-info-content">
                                    <p><a href="#">info@example.com</a> / <a href="#">info@example.com</a></p>
                                </div>
                            </div>
                            <div class="single-contact-info">
                                <div class="contact-info-icon">
                                    <i class="sli sli-screen-smartphone"></i>
                                </div>
                                <div class="contact-info-content">
                                    <p style="direction: ltr;"> 0910 000 0000 / 0910 000 0000 </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <div class="contact-from contact-shadow">
                        <form id="contact-form" action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <input class="form-control" name="name" type="text" placeholder="نام شما"
                                   value="{{ old('name') }}">
                            <p class="input-error-validation">
                                @error('name')
                                <strong>{{ $message }}</strong>
                                @enderror
                            </p>
                            <input class="form-control" name="email" type="email" placeholder="ایمیل شما"
                                   value="{{ old('email') }}">
                            <p class="input-error-validation">
                                @error('email')
                                <strong>{{ $message }}</strong>
                                @enderror
                            </p>
                            <input class="form-control" name="subject" type="text" placeholder="موضوع پیام"
                                   value="{{ old('subject') }}">
                            <p class="input-error-validation">
                                @error('subject')
                                <strong>{{ $message }}</strong>
                                @enderror
                            </p>
                            <textarea class="form-control" name="message"
                                      placeholder="متن پیام">{{ old('message') }}</textarea>
                            <p class="input-error-validation">
                                @error('message')
                                <strong>{{ $message }}</strong>
                                @enderror
                            </p>
                            <button class="submit" type="submit"> ارسال پیام</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
