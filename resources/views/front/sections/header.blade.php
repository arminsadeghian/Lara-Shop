<header class="header-area sticky-bar">
    <div class="main-header-wrap">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-2">
                    <div class="logo pt-40">
                        <a href="index.html">
                            <h3 class="font-weight-bold">WebProg.ir</h3>
                        </a>
                    </div>
                </div>

                <div class="col-xl-7 col-lg-7">
                    <div class="main-menu text-center">
                        <nav>
                            <ul>
                                <li class="angle-shape">
                                    <a href="about_us.html"> ارتباط با ما </a>
                                </li>

                                <li><a href="contact-us.html"> تماس با ما </a></li>

                                <li class="angle-shape">
                                    <a href="#"> فروشگاه </a>

                                    @php
                                        $parentCategories = App\Models\Category::where('parent_id', 0)->get();
                                    @endphp

                                    <ul class="mega-menu">
                                        @foreach($parentCategories as $parentCategory)
                                            <li>
                                                <a class="menu-title" href="#">{{ $parentCategory->name }}</a>

                                                @foreach($parentCategory->children as $category)
                                                    <ul>
                                                        <li>
                                                            <a href="{{ route('home.categories.show', $category->slug) }}">{{ $category->name }}</a>
                                                        </li>
                                                    </ul>
                                                @endforeach

                                            </li>
                                        @endforeach

                                    </ul>
                                </li>

                                <li class="angle-shape">
                                    <a href="index.html"> صفحه اصلی </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3">
                    <div class="header-right-wrap pt-40">
                        <div class="header-search">
                            <a class="search-active" href="#"><i class="sli sli-magnifier"></i></a>
                        </div>
                        <div class="cart-wrap">
                            <button class="icon-cart-active">
                                <span class="icon-cart">
                                    <i class="sli sli-bag"></i>
                                        @if(! \Cart::isEmpty())
                                        <span class="count-style">{{ count(\Cart::getContent()) }}</span>
                                    @else
                                        <span class="count-style">0</span>
                                    @endif
                                    </span>

                                @if(! \Cart::isEmpty())
                                    <span class="cart-price">{{ number_format(cartTotalAmount()) }}</span>
                                    <span>تومان</span>
                                @endif
                            </button>

                            @if(\Cart::isEmpty())
                                <div class="shopping-cart-content" style="text-align: center;height: 350px">
                                    <div class="shopping-cart-top">
                                        <a class="cart-close" href="#"><i class="sli sli-close"></i></a>
                                        <h4>سبد خرید</h4>
                                    </div>
                                    <img src="{{ asset('/static/files/empty-cart.svg') }}" alt="">
                                    <p class="font-weight-bold">سبد خرید شما خالی است</p>
                                </div>
                            @else
                                <div class="shopping-cart-content" style="width: 400px;">
                                    <div class="shopping-cart-top">
                                        <a class="cart-close" href="#"><i class="sli sli-close"></i></a>
                                        <h4>سبد خرید</h4>
                                    </div>
                                    <ul>
                                        @foreach(\Cart::getContent() as $item)
                                            <li class="single-shopping-cart"
                                                style="display: flex; flex-direction: row; flex-wrap: nowrap;">
                                                <div class="item-close">
                                                    <a href="{{ route('home.cart.remove', $item->id) }}">
                                                        <i class="sli sli-close"></i>
                                                    </a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h4><a href="#">{{ $item->name }}</a></h4>
                                                    <span>{{ $item->quantity }} X {{ number_format($item->price) }}</span>
                                                    <div style="direction: rtl;font-size: 12px">
                                                        {{ \App\Models\Attribute::find($item->attributes->attribute_id)->name }}
                                                        :
                                                        {{ $item->attributes->value }}
                                                    </div>
                                                    @if($item->attributes->is_sale)
                                                        <p style="font-size: 12px">
                                                            {{ $item->attributes->persent_sale }}%
                                                            تخفیف
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="shopping-cart-img">
                                                    <a href="{{ route('home.products.show', $item->associatedModel->slug) }}">
                                                        <img width="50px" alt="{{ $item->associatedModel->name }}"
                                                             src="{{ productImageUrl($item->associatedModel->primary_image) }}"/>
                                                    </a>
                                                </div>
                                            </li>
                                            <hr>
                                        @endforeach
                                    </ul>
                                    <div class="shopping-cart-bottom">
                                        <div
                                            class="shopping-cart-total d-flex justify-content-between align-items-center"
                                            style="direction: rtl;">
                                            <h4>
                                                مبلغ قابل پرداخت:
                                            </h4>
                                            <span class="shop-total">
                                            <span class="font-weight-bold"
                                                  style="font-size: 18px">{{ number_format(cartTotalAmount()) }}</span> تومان
                                        </span>
                                        </div>
                                        <div class="shopping-cart-btn btn-hover text-center">
                                            <a class="default-btn" href="{{ route('home.cart.index') }}">
                                                سبد خرید
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>

                        @if(auth()->check())
                            <div class="setting-wrap">
                                <a href="{{ route('home.user_profile.index') }}">
                                    <i style="font-size: 18px" class="sli sli-user"></i>
                                </a>
                            </div>
                        @else
                            <a class="ml-4" href="{{ route('user.login') }}">وارد شوید</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <!-- main-search start -->
        <div class="main-search-active">
            <div class="sidebar-search-icon">
                <button class="search-close">
                    <span class="sli sli-close"></span>
                </button>
            </div>
            <div class="sidebar-search-input">
                <form>
                    <div class="form-search">
                        <input id="search" class="input-text" value="" placeholder=" ...جستجو " type="search"/>
                        <button>
                            <i class="sli sli-magnifier"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="header-small-mobile">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="mobile-logo">
                        <a href="index.html">
                            <h4 class="font-weight-bold">WebProg.ir</h4>
                        </a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="header-right-wrap">
                        <div class="cart-wrap">
                            <button class="icon-cart-active">
                    <span class="icon-cart">
                      <i class="sli sli-bag"></i>
                      <span class="count-style">02</span>
                    </span>

                                <span class="cart-price">
                      500,000
                    </span>
                                <span>تومان</span>
                            </button>
                            <div class="shopping-cart-content">
                                <div class="shopping-cart-top">
                                    <a class="cart-close" href="#"><i class="sli sli-close"></i></a>
                                    <h4>سبد خرید</h4>
                                </div>
                                <ul style="height: 400px;">
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-title">
                                            <h4><a href="#"> لورم ایپسوم </a></h4>
                                            <span>1 x 90.00</span>
                                        </div>

                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="#"/></a>
                                            <div class="item-close">
                                                <a href="#"><i class="sli sli-close"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-title">
                                            <h4><a href="#"> لورم ایپسوم </a></h4>
                                            <span>1 x 9,000</span>
                                        </div>
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="#"/></a>
                                            <div class="item-close">
                                                <a href="#"><i class="sli sli-close"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="shopping-cart-bottom">
                                    <div
                                        class="shopping-cart-total d-flex justify-content-between align-items-center"
                                        style="direction: rtl;">
                                        <h4>
                                            جمع کل :
                                        </h4>
                                        <span class="shop-total">
                          25,000 تومان
                        </span>
                                    </div>
                                    <div class="shopping-cart-btn btn-hover text-center">
                                        <a class="default-btn" href="checkout.html">
                                            ثبت سفارش
                                        </a>
                                        <a class="default-btn" href="cart-page.html">
                                            سبد خرید
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mobile-off-canvas">
                            <a class="mobile-aside-button" href="#"><i class="sli sli-menu"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
