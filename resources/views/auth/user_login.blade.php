@extends('front.layouts.front')

@section('title')
    ورود یا ثبت‌نام | فروشگاه اینترنتی لباس
@endsection

@section('scripts')
    <script>

        $('#checkOtpForm').hide();
        $('#resendOTPButton').hide();

        let loginToken;

        $('#loginForm').submit(function (event) {
            event.preventDefault();
            let cellphone = $('#cellphoneInput').val();

            $.ajax({
                type: "POST",
                url: "{{ route('user.login') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'cellphone': cellphone,
                },
                success: function (response, status) {
                    loginToken = response.login_token;
                    if (status == 'success') {
                        $('#loginForm').fadeOut();
                        $('#checkOtpForm').fadeIn();
                        $('#cellphone').html(response.cellphone);

                        timer();
                    }
                },
                error: function (response) {
                    // console.log(response.responseJSON);
                    let errorMessage = response.responseJSON.errors.cellphone[0];
                    $('#cellphoneInput').addClass('mb-2');
                    $('#cellphoneInputError').fadeIn();
                    $('#cellphoneInputErrorText').html(errorMessage);
                }
            });

        });

        $('#checkOtpForm').submit(function (event) {
            event.preventDefault();
            let otp = $('#checkOtpInput').val();

            $.ajax({
                type: "POST",
                url: "{{ route('user.check_otp') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'otp': otp,
                    'login_token': loginToken,
                },
                success: function (response, status) {
                    // console.log(status);
                    window.location.replace("{{ route('home.index') }}");
                },
                error: function (response) {
                    // console.log(response.responseJSON.errors.otp[0]);
                    let errorMessage = response.responseJSON.errors.otp[0];
                    $('#checkOtpInput').addClass('mb-2');
                    $('#checkOtpInputError').fadeIn();
                    $('#checkOtpInputErrorText').html(errorMessage);
                }
            });

        });

        $('#resendOTPButton').click(function (event) {
            event.preventDefault();

            $.ajax({
                type: "POST",
                url: "{{ route('user.resend_otp') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'login_token': loginToken
                },
                success: function (response, status) {
                    loginToken = response.login_token;

                    $('#resendOTPButton').fadeOut();
                    timer();
                    $('#resendOTPTime').fadeIn();
                },
                error: function (response) {
                    // console.log(response);
                }
            });

        });

        function timer() {
            let time = "1:01";
            let interval = setInterval(function () {
                let countdown = time.split(':');
                let minutes = parseInt(countdown[0], 10);
                let seconds = parseInt(countdown[1], 10);
                --seconds;
                minutes = (seconds < 0) ? --minutes : minutes;
                if (minutes < 0) {
                    clearInterval(interval);
                    $('#resendOTPTime').hide();
                    $('#resendOTPButton').fadeIn();
                }
                seconds = (seconds < 0) ? 59 : seconds;
                seconds = (seconds < 10) ? '0' + seconds : seconds;
                //minutes = (minutes < 10) ?  minutes : minutes;
                $('#resendOTPTime').html(minutes + ':' + seconds);
                time = minutes + ':' + seconds;
            }, 1000);
        }
    </script>
@endsection

@section('content')

    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="{{ route('home.index') }}">صفحه اصلی</a>
                    </li>
                    <li style="font-weight: bold">ورود | ثبت‌نام</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="login-register-area pt-100 pb-100" style="direction: rtl;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                            <a style="pointer-events: none; cursor: default;" class="active" data-toggle="tab" href="#">
                                <h4>ورود | ثبت نام</h4>
                            </a>
                        </div>
                        <div class="tab-content">

                            <div id="lg1" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form id="loginForm">
                                            <p style="text-align: right">سلام!</p>
                                            <p style="text-align: right">لطفا شماره موبایل خود را وارد کنید</p>

                                            <input id="cellphoneInput" placeholder="شماره موبایل" type="text"
                                                   autocomplete="off">

                                            <div id="cellphoneInputError" class="input-error-validation">
                                                <strong id="cellphoneInputErrorText"></strong>
                                            </div>

                                            <div class="button-box d-flex justify-content-between">
                                                <button id="sendCellphoneBtn" type="submit">ارسال</button>
                                            </div>
                                        </form>
                                        <form id="checkOtpForm">
                                            <p style="text-align: right">
                                                کد تایید 6 رقمی برای شماره
                                                <span style="font-weight: bold" id="cellphone"></span>
                                                ارسال گردید
                                            </p>

                                            <input id="checkOtpInput" placeholder="رمز یکبار مصرف" type="text"
                                                   autocomplete="off">

                                            <div id="checkOtpInputError" class="input-error-validation">
                                                <strong id="checkOtpInputErrorText"></strong>
                                            </div>

                                            <div class="button-box d-flex justify-content-between">
                                                <button id="loginBtn" type="submit">ورود</button>
                                                <div>
                                                    <button id="resendOTPButton" type="submit">ارسال مجدد</button>
                                                    <span id="resendOTPTime"></span>
                                                </div>
                                            </div>
                                        </form>
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
