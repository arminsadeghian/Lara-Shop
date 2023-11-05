@extends('admin.layouts.admin')

@section('title')
    نمایش محصول : {{ $product->name }}
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">نمایش محصول : {{ $product->name }}</h5>
            </div>
            <hr>

            <div class="form-row">

                <div class="form-group col-md-3">
                    <label>نام</label>
                    <input class="form-control" value="{{ $product->name }}" disabled>
                </div>

                <div class="form-group col-md-3">
                    <label>وضعیت</label>
                    <input class="form-control" value="{{ $product->is_active }}" disabled>
                </div>

                <div class="form-group col-md-3">
                    <label>برند</label>
                    <input class="form-control" value="{{ $product->brand->name }}" disabled>
                </div>

                <div class="form-group col-md-3">
                    <label>دسته بندی</label>
                    <input class="form-control"
                           value="{{ $product->category->name . ' - ' . $product->category->parent->name}}" disabled>
                </div>

                <div class="form-group col-md-3">
                    <label>تگ ها</label>
                    <div style="background-color: #eaecf4" class="form-control">
                        @foreach($product->tags as $tag)
                            {{ $tag->name }}{{ $loop->last ? '' : '،' }}
                        @endforeach
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="description">توضیحات</label>
                    <textarea style="height: 100px;" class="form-control"
                              disabled>{{ $product->description }}</textarea>
                </div>

                <div class="col-md-12">
                    <hr>
                    <p>هزینه ارسال:</p>
                </div>

                <div class="form-group col-md-3">
                    <label for="delivery_amount">هزینه ارسال</label>
                    <input class="form-control" value="{{ $product->delivery_amount }}" disabled>
                </div>

                <div class="form-group col-md-3">
                    <label for="delivery_amount_per_product">هزینه ارسال به ازای محصول اضافی</label>
                    <input class="form-control" value="{{ $product->delivery_amount_per_product }}" disabled>
                </div>

                <div class="col-md-12">
                    <hr>
                    <p>ویژگی ها:</p>
                </div>
                @foreach($productAttributes as $productAttribute)
                    <div class="form-group col-md-3">
                        <label>{{ $productAttribute->attribute->name }}</label>
                        <input class="form-control" value="{{ $productAttribute->value }}" disabled>
                    </div>
                @endforeach

                @foreach ($productVariations as $variation)
                    <div class="col-md-12">
                        <hr>
                        <div class="d-flex">
                            <p class="mb-0"> قیمت و موجودی برای متغیر ( {{ $variation->value }} ) : </p>
                            <p class="mb-0 mr-3">
                                <button class="btn btn-sm btn-primary" type="button" data-toggle="collapse"
                                        data-target="#collapse-{{ $variation->id }}">
                                    نمایش
                                </button>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="collapse mt-2" id="collapse-{{ $variation->id }}">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label> قیمت </label>
                                        <input type="text" disabled class="form-control"
                                               value="{{ $variation->price }}">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label> تعداد </label>
                                        <input type="text" disabled class="form-control"
                                               value="{{ $variation->quantity }}">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label> sku </label>
                                        <input type="text" disabled class="form-control" value="{{ $variation->sku }}">
                                    </div>

                                    {{-- Sale Section --}}
                                    <div class="col-md-12">
                                        <p> حراج : </p>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label> قیمت حراجی </label>
                                        <input type="text" value="{{ $variation->sale_price }}" disabled
                                               class="form-control">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label> تاریخ شروع حراجی </label>
                                        <input type="text"
                                               value="{{ $variation->date_on_sale_from == null ? null : verta($variation->date_on_sale_from) }}"
                                               disabled class="form-control">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label> تاریخ پایان حراجی </label>
                                        <input type="text"
                                               value="{{ $variation->date_on_sale_to == null ? null : verta($variation->date_on_sale_to) }}"
                                               disabled class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-md-12">
                    <hr>
                    <p>تصویر اصلی محصول : </p>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <a target="_blank" href="{{ productImageUrl($product->primary_image) }}">
                            <img class="card-img-top"
                                 src="{{ productImageUrl($product->primary_image) }}"
                                 alt="{{ $product->name }}">
                        </a>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                    <p>تصاویر محصول : </p>
                </div>

                @foreach($productImages as $image)
                    <div class="col-md-3">
                        <div class="card">
                            <a target="_blank" href="{{ productImageUrl($image->image) }}">
                                <img class="card-img-top"
                                     src="{{ productImageUrl($image->image) }}"
                                     alt="{{ $product->name }}">
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>

    </div>

@endsection
