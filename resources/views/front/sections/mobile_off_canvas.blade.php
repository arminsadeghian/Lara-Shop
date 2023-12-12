<div class="mobile-off-canvas-active">
    <a class="mobile-aside-close">
        <i class="sli sli-close"></i>
    </a>

    <div class="header-mobile-aside-wrap">
        <div class="mobile-search">
            <form class="search-form" action="#">
                <input type="text" placeholder=" ... جستجو "/>
                <button class="button-search">
                    <i class="sli sli-magnifier"></i>
                </button>
            </form>
        </div>

        <div class="mobile-menu-wrap">
            <!-- mobile menu start -->
            <div class="mobile-navigation">
                <!-- mobile menu navigation start -->
                <nav>
                    <ul class="mobile-menu text-right">
                        <li class="menu-item-has-children">
                            <a href="{{ route('home.index') }}"> صفحه ای اصلی </a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">فروشگاه</a>

                            @php
                                $parentCategories = App\Models\Category::where('parent_id', 0)->get();
                            @endphp

                            <ul class="dropdown">

                                @foreach($parentCategories as $parentCategory)
                                    <li class="menu-item-has-children">
                                        <a href="#">{{ $parentCategory->name }}</a>

                                        @foreach($parentCategory->activeCategories()->get() as $category)
                                            <ul class="dropdown">
                                                <li>
                                                    <a href="{{ route('home.categories.show', $category->slug) }}">{{ $category->name }}</a>
                                                </li>
                                            </ul>
                                        @endforeach

                                    </li>
                                @endforeach

                            </ul>
                        </li>

                        <li><a href="{{ route('contact.index') }}">تماس با ما</a></li>

                        <li><a href="{{ route('about.index') }}"> در باره ما</a></li>
                    </ul>
                </nav>
                <!-- mobile menu navigation end -->
            </div>
            <!-- mobile menu end -->
        </div>

        <div class="mobile-curr-lang-wrap">
            <div class="single-mobile-curr-lang">
                @if(auth()->check())
                    <div class="setting-wrap">
                        <a href="{{ route('home.user_profile.index') }}">
                            <i style="font-size: 18px;" class="sli sli-user"></i>
                        </a>
                    </div>
                @else
                    <a class="ml-4" href="{{ route('user.login') }}">وارد شوید</a>
                @endif
            </div>
        </div>

        <div class="mobile-social-wrap text-center">
            <a class="facebook" href="#"><i class="sli sli-social-facebook"></i></a>
            <a class="twitter" href="#"><i class="sli sli-social-twitter"></i></a>
            <a class="pinterest" href="#"><i class="sli sli-social-pinterest"></i></a>
            <a class="instagram" href="#"><i class="sli sli-social-instagram"></i></a>
            <a class="google" href="#"><i class="sli sli-social-google"></i></a>
        </div>
    </div>
</div>
