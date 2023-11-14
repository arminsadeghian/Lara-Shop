@extends('front.layouts.front')

@section('title')
    {{ $product->name }}
@endsection

@section('scripts')
    <script>
        $('.variation-select').on('change', function () {
            let variation = JSON.parse(this.value);
            let variationPriceDiv = $('.variation-price');
            variationPriceDiv.empty();

            if (variation.is_sale == 1) {
                let spanSale = $('<span/>', {
                    class: 'new',
                    text: toPersianNum(number_format(variation.sale_price)) + ' تومان '
                });
                let spanPrice = $('<span/>', {
                    class: 'old',
                    text: toPersianNum(number_format(variation.price)) + ' تومان '
                });

                variationPriceDiv.append(spanSale);
                variationPriceDiv.append(spanPrice);

            } else {
                let spanPrice = $('<span/>', {
                    class: 'new',
                    text: toPersianNum(number_format(variation.price)) + ' تومان '
                });

                variationPriceDiv.append(spanPrice);
            }

            $('.quantity-input').attr('data-max', variation.quantity);
            $('.quantity-input').val(1);

        });
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
                    <li>
                        <a href="{{ route('home.categories.show', $product->category->parent->slug) }}">{{ $product->category->parent->name }}</a>
                    </li>
                    <li>
                        <a href="{{ route('home.categories.show', $product->category->slug) }}">{{ $product->category->name }}</a>
                    </li>
                    <li style="font-weight: bold">
                        <a href="{{ route('home.products.show', $product->slug) }}">{{ $product->name }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="product-details-area pt-100 pb-95">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-md-6 order-2 order-sm-2 order-md-1" style="direction: rtl;">
                    <div class="product-details-content ml-30">
                        <h2 class="text-right"> {{ $product->name }} </h2>
                        <div class="product-details-price variation-price">
                            @if($product->quantity_check)
                                @if($product->sale_check)
                                    <span class="new">
                                          {{ number_format($product->sale_check->sale_price) }}
                                          تومان
                                    </span>
                                    <span class="old">
                                         {{ number_format($product->sale_check->price) }}
                                         تومان
                                    </span>
                                @else
                                    <span class="new">
                                          {{ number_format($product->price_check->price) }}
                                          تومان
                                    </span>
                                @endif
                            @else
                                <p class="font-weight-bold">ناموجود</p>
                            @endif
                        </div>
                        <div class="pro-details-rating-wrap">
                            <div data-rating-stars="5"
                                 data-rating-readonly="true"
                                 data-rating-value="{{ ceil($product->rates->avg('rate')) }}">
                            </div>
                            <span style="margin: 0 10px">|</span>
                            <span>3 دیدگاه</span>
                        </div>
                        <p class="text-right">{{ $product->description }}</p>
                        <div class="pro-details-list text-right">
                            <ul class="text-right">
                                @foreach($product->attributes()->with('attribute')->get() as $attribute)
                                    <li>-
                                        {{ $attribute->attribute->name }}
                                        :
                                        {{ $attribute->value }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        @if($product->quantity_check)
                            @php
                                if ($product->sale_check){
                                    $productVariationSelected = $product->sale_check;
                                }else{
                                    $productVariationSelected = $product->price_check;
                                }
                            @endphp
                            <div class="pro-details-size-color text-right">
                                <div class="pro-details-size w-25">
                                    <span>{{ App\Models\Attribute::find($product->variations->first()->attribute_id)->name }}</span>
                                    <div class="pro-details-size-content">
                                        <select class="form-control variation-select">
                                            @foreach($product->variations()->where('quantity', '>', 0)->get() as $variation)
                                                <option
                                                    value="{{ json_encode($variation->only(['id','quantity','is_sale','sale_price','price'])) }}"
                                                    {{ $productVariationSelected->id == $variation->id ? 'selected' : '' }}
                                                >{{ $variation->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="pro-details-quality">
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box quantity-input" type="text" name="qtybutton" value="1"
                                       data-max="5">
                            </div>
                            <div class="pro-details-cart btn-hover">
                                <a href="#"> افزودن به سبد خرید </a>
                            </div>
                            <div class="pro-details-wishlist">
                                <a title="Add To Wishlist" href="#"><i class="sli sli-heart"></i></a>
                            </div>
                            <div class="pro-details-compare">
                                <a title="Add To Compare" href="#"><i class="sli sli-refresh"></i></a>
                            </div>
                        </div>
                        <div class="pro-details-meta">
                            <span>دسته بندی :</span>
                            <ul>
                                <li><a href="#">{{ $product->category->parent->name }},</a></li>
                                <li><a href="#">{{ $product->category->name }}</a></li>
                            </ul>
                        </div>
                        <div class="pro-details-meta">
                            <span>تگ ها :</span>
                            <ul>
                                @foreach($product->tags as $tag)
                                    <li><a href="#">{{ $tag->name }}{{ $loop->last ? '' : '،' }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 order-1 order-sm-1 order-md-2">
                    <div class="product-details-img">
                        <div class="zoompro-border zoompro-span">
                            <img class="zoompro" src="{{ productImageUrl($product->primary_image) }}"
                                 data-zoom-image="{{ productImageUrl($product->primary_image) }}"
                                 alt="{{ $product->name }}"/>

                        </div>
                        <div id="gallery" class="mt-20 product-dec-slider">
                            <a data-image="{{ productImageUrl($product->primary_image) }}"
                               data-zoom-image="{{ productImageUrl($product->primary_image) }}">
                                <img width="100px" src="{{ productImageUrl($product->primary_image) }}"
                                     alt="{{ $product->name }}">
                            </a>

                            @foreach($product->images as $image)
                                <a data-image="{{ productImageUrl($image->image) }}"
                                   data-zoom-image="{{ productImageUrl($image->image) }}">
                                    <img width="100px" src="{{ productImageUrl($image->image) }}"
                                         alt="{{ $product->name }}">
                                </a>
                            @endforeach

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="description-review-area pb-95">
        <div class="container">
            <div class="row" style="direction: rtl;">
                <div class="col-lg-8 col-md-8">
                    <div class="description-review-wrapper">
                        <div class="description-review-topbar nav">
                            <a class="active" data-toggle="tab" href="#des-details1"> توضیحات </a>
                            <a data-toggle="tab" href="#des-details3"> اطلاعات بیشتر </a>
                            <a data-toggle="tab" href="#des-details2">
                                دیدگاه
                                (3)
                            </a>
                        </div>
                        <div class="tab-content description-review-bottom">
                            <div id="des-details1" class="tab-pane active">
                                <div class="product-description-wrapper">
                                    <p class="text-justify">{{ $product->description }}</p>
                                </div>
                            </div>
                            <div id="des-details3" class="tab-pane">
                                <div class="product-anotherinfo-wrapper text-right">
                                    <ul class="text-right">
                                        @foreach($product->attributes()->with('attribute')->get() as $attribute)
                                            <li>-
                                                {{ $attribute->attribute->name }}
                                                :
                                                {{ $attribute->value }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div id="des-details2" class="tab-pane">

                                <div class="review-wrapper">
                                    <div class="single-review">
                                        <div class="review-img">
                                            <img src="assets/img/product-details/client-1.jpg" alt="">
                                        </div>
                                        <div class="review-content text-right">
                                            <p class="text-right">
                                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                                                استفاده از طراحان گرافیک است.
                                            </p>
                                            <div class="review-top-wrap">
                                                <div class="review-name">
                                                    <h4> علی شیخ </h4>
                                                </div>
                                                <div class="review-rating">
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-review">
                                        <div class="review-img">
                                            <img src="assets/img/product-details/client-2.jpg" alt="">
                                        </div>
                                        <div class="review-content">
                                            <p class="text-right">
                                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                                                استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در
                                                ستون و سطرآنچنان که لازم است
                                            </p>
                                            <div class="review-top-wrap text-right">
                                                <div class="review-name">
                                                    <h4> علی شیخ </h4>
                                                </div>
                                                <div class="review-rating">
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-review">
                                        <div class="review-img">
                                            <img src="assets/img/product-details/client-3.jpg" alt="">
                                        </div>
                                        <div class="review-content text-right">
                                            <p class="text-right">
                                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                                                استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در
                                                ستون و سطرآنچنان که لازم است
                                            </p>
                                            <div class="review-top-wrap">
                                                <div class="review-name">
                                                    <h4> علی شیخ </h4>
                                                </div>
                                                <div class="review-rating">
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="ratting-form-wrapper text-right">
                                    <span> نوشتن دیدگاه </span>

                                    <div class="star-box-wrap">
                                        <div class="single-ratting-star">
                                            <i class="sli sli-star"></i>
                                        </div>
                                        <div class="single-ratting-star">
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                        </div>
                                        <div class="single-ratting-star">
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                        </div>
                                        <div class="single-ratting-star">
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                        </div>
                                        <div class="single-ratting-star">
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                        </div>
                                    </div>

                                    <div class="ratting-form">
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="rating-form-style mb-20">
                                                        <label> متن دیدگاه : </label>
                                                        <textarea name="Your Review"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-submit">
                                                        <input type="submit" value="ارسال">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="pro-dec-banner">
                        <a href="#"><img src="{{ asset('static/files/single-banner.png') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product-area pb-70">
        <div class="container">
            <div class="section-title text-center pb-60">
                <h2> محصولات مرتبط </h2>
            </div>
            <div class="arrivals-wrap scroll-zoom">
                <div class="ht-products product-slider-active owl-carousel">
                    <!--Product Start-->
                    @foreach($relatedProducts as $product)
                        <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
                            <div class="ht-product-inner">
                                <div class="ht-product-image-wrap">
                                    <a href="{{ route('home.products.show', $product->slug) }}"
                                       class="ht-product-image">
                                        <img src="{{ productImageUrl($product->primary_image) }}"
                                             alt="{{ $product->name }}"/>
                                    </a>
                                </div>
                                <div class="ht-product-content">
                                    <div class="ht-product-content-inner">
                                        <div class="ht-product-categories">
                                            <a href="{{ route('home.categories.show', $product->category->slug) }}">{{ $product->category->name }} {{ $product->category->parent->name }}</a>
                                        </div>
                                        <h4 class="ht-product-title text-right">
                                            <a href="{{ route('home.products.show', $product->slug) }}">{{ $product->name }}</a>
                                        </h4>
                                        <div class="ht-product-price">
                                            @if($product->quantity_check)
                                                @if($product->sale_check)
                                                    <span class="new">
                                                      {{ number_format($product->sale_check->sale_price) }}
                                                      تومان
                                                </span>
                                                    <span class="old">
                                                     {{ number_format($product->sale_check->price) }}
                                                     تومان
                                                </span>
                                                @else
                                                    <span class="new">
                                                      {{ number_format($product->price_check->price) }}
                                                      تومان
                                            </span>
                                                @endif
                                            @else
                                                <p class="font-weight-bold">ناموجود</p>
                                            @endif
                                        </div>
                                        <div class="ht-product-ratting-wrap">
                                            <div data-rating-stars="5"
                                                 data-rating-readonly="true"
                                                 data-rating-value="{{ ceil($product->rates->avg('rate')) }}">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!--Product End-->
                </div>
            </div>
        </div>
    </div>

@endsection
