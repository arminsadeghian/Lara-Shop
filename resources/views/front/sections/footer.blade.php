<footer class="footer-area bg-paleturquoise" style="direction: rtl;">
    <div class="container">
        <div class="footer-top text-center pt-45 pb-45">
            <nav>
                <ul>
                    <li><a href="{{ route('home.index') }}">صفحه اصلی </a></li>
                    <li><a href="#">فروشگاه </a></li>
                    <li><a href="{{ route('contact.index') }}">تماس با ما </a></li>
                    <li><a href="{{ route('about.index') }}">ارتباط با ما </a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="footer-bottom border-top-1 pt-20">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-5 col-12">
                    <div class="footer-social pb-20">
                        <a href="#">اینستاگرام</a>
                        <a href="#">تویتر</a>
                        <a href="#">فیسبوک</a>
                        <a href="#">لینکدین</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">

                </div>
                <div class="col-lg-4 col-md-3 col-12">
                    <div class="payment-mathod pb-20">
                        <img src="{{ asset('/static/files/payment.png') }}" alt=""/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
