@extends('admin.layouts.admin')

@section('title')
    ویرایش محصول : {{ $product->name }}
@endsection

@section('script')
    <script>
        $('#brandSelect').selectpicker({
            'title': 'انتخاب برند'
        });

        $('#tagSelect').selectpicker({
            'title': 'انتخاب تگ'
        });
    </script>
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ویرایش محصول : {{ $product->name }}</h5>
            </div>
            <hr>

            <form action="{{ route('admin.products.update', $product->id) }}" method="post">
                @csrf
                @method('put')

                <div class="form-row">

                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input id="name" name="name" class="form-control" value="{{ $product->name }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="is_active">وضعیت</label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value="1" {{ $product->is_active == 'فعال' ? 'selected' : '' }}>فعال</option>
                            <option value="0" {{ $product->is_active == 'غیرفعال' ? 'selected' : '' }}>غیرفعال</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="brand_id">برند</label>
                        <select class="form-control" id="brandSelect" name="brand_id"
                                data-live-search="true">
                            @foreach($brands as $brand)
                                <option
                                    value="{{ $brand->id }}" {{ $brand->id == $product->brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="tag_ids">تگ</label>
                        <select class="form-control" id="tagSelect" name="tag_ids[]"
                                data-live-search="true" multiple>
                            @php
                                $productTagIds = $product->tags()->pluck('id')->toArray();
                            @endphp

                            @foreach($tags as $tag)
                                <option
                                    value="{{ $tag->id }}" {{ in_array($tag->id, $productTagIds) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea style="height: 100px;" class="form-control" id="description"
                                  name="description">{{ $product->description }}</textarea>
                    </div>

                    <div class="col-md-12">
                        <hr>
                        <p>هزینه ارسال:</p>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="delivery_amount">هزینه ارسال</label>
                        <input class="form-control" id="delivery_amount" name="delivery_amount" type="text"
                               value="{{ $product->delivery_amount }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="delivery_amount_per_product">هزینه ارسال به ازای محصول اضافی</label>
                        <input class="form-control" id="delivery_amount_per_product" name="delivery_amount_per_product"
                               type="text" value="{{ $product->delivery_amount_per_product }}">
                    </div>

                    <div class="col-md-12">
                        <hr>
                        <p>ویژگی ها:</p>
                    </div>

                    @foreach($productAttributes as $productAttribute)
                        <div class="form-group col-md-3">
                            <label>{{ $productAttribute->attribute->name }}</label>
                            <input class="form-control" name="attribute_values[{{ $productAttribute->id }}]"
                                   value="{{ $productAttribute->value }}">
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
                                            <input type="text" class="form-control"
                                                   name="variation_values[{{ $variation->id }}][price]"
                                                   value="{{ $variation->price }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label> تعداد </label>
                                            <input type="text" class="form-control"
                                                   name="variation_values[{{ $variation->id }}][quantity]"
                                                   value="{{ $variation->quantity }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label> sku </label>
                                            <input type="text" class="form-control"
                                                   name="variation_values[{{ $variation->id }}][sku]"
                                                   value="{{ $variation->sku }}">
                                        </div>

                                        <div class="col-md-12">
                                            <p> حراج : </p>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label> قیمت حراجی </label>
                                            <input type="text"
                                                   name="variation_values[{{ $variation->id }}][sale_price]"
                                                   value="{{ $variation->sale_price }}"
                                                   class="form-control">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label> تاریخ شروع حراجی </label>
                                            <input type="text"
                                                   name="variation_values[{{ $variation->id }}][date_on_sale_from]"
                                                   value="{{ $variation->date_on_sale_from == null ? null : verta($variation->date_on_sale_from) }}"
                                                   class="form-control">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label> تاریخ پایان حراجی </label>
                                            <input type="text"
                                                   name="variation_values[{{ $variation->id }}][date_on_sale_to]"
                                                   value="{{ $variation->date_on_sale_to == null ? null : verta($variation->date_on_sale_to) }}"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>

        </div>

    </div>

@endsection
