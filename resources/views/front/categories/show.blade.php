@extends('front.layouts.front')

@section('title')
    صفحه فروشگاه
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
                        <a href="{{ $category->parent->slug }}">{{ $category->parent->name }}</a>
                    </li>
                    <li style="font-weight: bold">{{ $category->name }} {{ $category->parent->name }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="shop-area pt-95 pb-100">
        <div class="container">
            <div class="row flex-row-reverse text-right">

                <!-- sidebar -->
                <div class="col-lg-3 order-2 order-sm-2 order-md-1">
                    <div class="sidebar-style mr-30">
                        <div class="sidebar-widget">
                            <h4 class="pro-sidebar-title">جستجو </h4>
                            <div class="pro-sidebar-search mb-50 mt-25">
                                <form class="pro-sidebar-search-form" action="#">
                                    <input type="text" placeholder="... جستجو ">
                                    <button>
                                        <i class="sli sli-magnifier"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget">
                            <h4 class="pro-sidebar-title"> دسته بندی </h4>
                            <div class="sidebar-widget-list mt-30">
                                <ul>
                                    <li>
                                        مردانه
                                    </li>
                                    <li>
                                        <a href="#">
                                            پیراهن
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            تی شرت
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            پالتو
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            لباس راحتی
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            لباس راحتی
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr>

                        <div class="sidebar-widget mt-30">
                            <h4 class="pro-sidebar-title">رنگ </h4>
                            <div class="sidebar-widget-list mt-20">
                                <ul>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">سبز </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">کرم </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">آبی </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">مشکی </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="sidebar-widget mt-30">
                            <h4 class="pro-sidebar-title">سایز </h4>
                            <div class="sidebar-widget-list mt-20">
                                <ul>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">XL </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">L </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">SM </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">XXL </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- content -->
                <div class="col-lg-9 order-1 order-sm-1 order-md-2">
                    <!-- shop-top-bar -->
                    <div class="shop-top-bar" style="direction: rtl;">
                        <div class="select-shoing-wrap">
                            <div class="shop-select">
                                <select>
                                    <option value=""> مرتب سازی</option>
                                    <option value=""> بیشترین قیمت</option>
                                    <option value=""> کم ترین قیمت</option>
                                    <option value=""> جدیدترین</option>
                                    <option value=""> قدیمی ترین</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="shop-bottom-area mt-35">
                        <div class="tab-content jump">

                            <div class="row ht-products" style="direction: rtl;">

                                @foreach($products as $product)
                                    <div class="col-xl-4 col-md-6 col-lg-6 col-sm-6">
                                        <!--Product Start-->
                                        <div
                                            class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
                                            <div class="ht-product-inner">
                                                <div class="ht-product-image-wrap">
                                                    <a href="#" class="ht-product-image">
                                                        <img src="{{ productImageUrl($product->primary_image) }}"
                                                             alt="{{ $product->name }}"/>
                                                    </a>
                                                    <div class="ht-product-action">
                                                        <ul>
                                                            <li>
                                                                <a href="#" data-toggle="modal"
                                                                   data-target="#prodcutModal-{{ $product->id }}">
                                                                    <i class="sli sli-magnifier"></i>
                                                                    <span class="ht-product-action-tooltip"> مشاهده سریع </span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="sli sli-heart"></i>
                                                                    <span class="ht-product-action-tooltip">
                                                                        افزودن به علاقه مندی ها
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">
                                                                    <i class="sli sli-refresh"></i>
                                                                    <span class="ht-product-action-tooltip">مقایسه</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="ht-product-content">
                                                    <div class="ht-product-content-inner">
                                                        <div class="ht-product-categories">
                                                            <a href="{{ route('home.categories.show', $category->slug) }}">{{ $product->category->name }} {{ $product->category->parent->name }}</a>
                                                        </div>
                                                        <h4 class="ht-product-title text-right">
                                                            <a href="#">{{ $product->name }}</a>
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
                                        <!--Product End-->
                                    </div>
                                @endforeach

                            </div>

                        </div>

                        <div class="pro-pagination-style text-center mt-30">
                            <ul class="d-flex justify-content-center">
                                <li><a class="prev" href="#"><i class="sli sli-arrow-left"></i></a></li>
                                <li><a class="active" href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a class="next" href="#"><i class="sli sli-arrow-right"></i></a></li>
                            </ul>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    @foreach($products as $product)
        <div class="modal fade" id="prodcutModal-{{ $product->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-7 col-sm-12 col-xs-12" style="direction: rtl;">
                                <div class="product-details-content quickview-content">
                                    <h2 class="text-right mb-4">{{ $product->name }}</h2>
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
                                        <div class="pro-details-quality">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box quantity-input" type="text"
                                                       name="qtybutton"
                                                       value="1" data-max="5"/>
                                            </div>
                                            <div class="pro-details-cart">
                                                <a href="#">افزودن به سبد خرید</a>
                                            </div>
                                            <div class="pro-details-wishlist">
                                                <a title="Add To Wishlist" href="#"><i class="sli sli-heart"></i></a>
                                            </div>
                                            <div class="pro-details-compare">
                                                <a title="Add To Compare" href="#"><i class="sli sli-refresh"></i></a>
                                            </div>
                                        </div>
                                    @endif

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

                            <div class="col-md-5 col-sm-12 col-xs-12">
                                <div class="tab-content quickview-big-img">
                                    <div id="pro-primary-{{ $product->id }}" class="tab-pane fade show active">
                                        <img src="{{ productImageUrl($product->primary_image) }}"
                                             alt="{{ $product->name }}"/>
                                    </div>
                                    @foreach($product->images as $image)
                                        <div id="pro-{{ $image->id }}" class="tab-pane fade">
                                            <img src="{{ productImageUrl($image->image) }}" alt="{{ $product->name }}"/>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="quickview-wrap mt-15">
                                    <div class="quickview-slide-active owl-carousel nav nav-style-2" role="tablist">
                                        <a class="active" data-toggle="tab" href="#pro-primary-{{ $product->id }}">
                                            <img src="{{ productImageUrl($product->primary_image) }}"
                                                 alt="{{ $product->name }}"/>
                                        </a>
                                        @foreach($product->images as $image)
                                            <a data-toggle="tab" href="#pro-{{ $image->id }}">
                                                <img src="{{ productImageUrl($image->image) }}"
                                                     alt="{{ $product->name }}"/>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Modal end -->

@endsection
