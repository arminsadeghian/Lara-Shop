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
                    <li style="font-weight: bold">علاقه مندی ها</li>
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
                                <div class="myaccount-content">
                                    <h3> لیست علاقه مندی ها </h3>
                                    @if($wishlist->isEmpty())
                                        <div class="alert alert-danger">
                                            <p>هنوز محصولی به لیست علاقه مندی ها اضافه نکردید</p>
                                        </div>
                                    @else
                                        <div class="table-content table-responsive cart-table-content">
                                            <table>
                                                <thead>
                                                <tr>
                                                    <th> تصویر محصول</th>
                                                    <th> نام محصول</th>
                                                    <th> حذف</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($wishlist as $item)
                                                    <tr>
                                                        <td class="product-thumbnail">
                                                            <img width="100px"
                                                                 src="{{ productImageUrl($item->product->primary_image) }}"
                                                                 alt="{{ $item->product->name }}">
                                                        </td>
                                                        <td class="product-name">
                                                            <a target="_blank"
                                                               href="{{ route('home.products.show', $item->product->slug) }}">
                                                                {{ $item->product->name }}
                                                            </a>
                                                        </td>
                                                        <td class="product-name">
                                                            <a href="{{ route('home.wishlist.remove', $item->product->id) }}">
                                                                <i class="sli sli-trash"
                                                                   style="font-size: 20px"></i>
                                                            </a>
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
@endsection

