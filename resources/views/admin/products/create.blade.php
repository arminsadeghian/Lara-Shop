@extends('admin.layouts.admin')

@section('title')
    ایجاد محصول جدید
@endsection

@section('script')
    <script>
        $('#brandSelect').selectpicker({
            'title': 'انتخاب برند'
        });

        $('#tagSelect').selectpicker({
            'title': 'انتخاب تگ'
        });

        $('#categorySelect').selectpicker({
            'title': 'انتخاب دسته بندی'
        });

        // Show file name
        $('#primary_image').change(function () {
            let fileName = $(this).val();
            $(this).next('.custom-file-label').html(fileName);
        });

        $('#images').change(function () {
            let fileName = $(this).val();
            $(this).next('.custom-file-label').html(fileName);
        });

        $('#attributesContainer').hide();

        $('#categorySelect').on('changed.bs.select', function () {
            let categoryId = $(this).val();

            $.get(`{{ url('/admin-panel/category-attributes/${categoryId}') }}`, function (response, status) {
                if (status == 'success') {

                    $('#attributesContainer').fadeIn();

                    // Empty attribute container
                    $('#attributes').find('div').remove();

                    response.attributes.forEach(attribute => {

                        let attributeFormGroup = $('<div/>', {
                            class: 'form-group col-md-3'
                        });

                        let attributeLabel = $('<label/>', {
                            for: attribute.name,
                            text: attribute.name
                        });

                        let attributeInput = $('<input/>', {
                            type: 'text',
                            class: 'form-control',
                            id: attribute.name,
                            name: `attribute_ids[${attribute.id}]`
                        });

                        attributeFormGroup.append(attributeLabel);
                        attributeFormGroup.append(attributeInput);

                        $('#attributes').append(attributeFormGroup);
                    });

                    $('#variationName').text(response.variation.name);

                } else {
                    console.log('خطایی در دریافت ویژگی ها');
                }
            }).fail(function () {
                console.log('خطایی در دریافت ویژگی ها');
            });

        });

        $("#czContainer").czMore();

    </script>
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ایجاد محصول</h5>
            </div>
            <hr>

            @include('errors.message')

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">

                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="is_active">وضعیت</label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value="1" selected>فعال</option>
                            <option value="0">غیرفعال</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="brand_id">برند</label>
                        <select class="form-control" id="brandSelect" name="brand_id"
                                data-live-search="true">
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="tag_ids">تگ</label>
                        <select class="form-control" id="tagSelect" name="tag_ids[]"
                                data-live-search="true" multiple>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea style="height: 100px;" class="form-control" id="description"
                                  name="description">{{ old('description') }}</textarea>
                    </div>

                    <div class="col-md-12">
                        <hr>
                        <p style="margin-bottom: 30px">تصاویر محصول:</p>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="primary_image">تصویر اصلی</label>
                        <div class="custom-file">
                            <input type="file" id="primary_image" name="primary_image" class="custom-file-input">
                            <label class="custom-file-label" for="primary_image">انتخاب فایل</label>
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="images">تصاویر</label>
                        <div class="custom-file">
                            <input type="file" id="images" name="images[]" multiple class="custom-file-input">
                            <label class="custom-file-label" for="images">انتخاب فایل ها</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <hr>
                        <p style="margin-bottom: 30px">دسته بندی و ویژگی ها:</p>
                    </div>

                    <div class="form-group col-md-3 m-auto">
                        <label for="category_id">دسته بندی</label>
                        <select class="form-control" id="categorySelect" name="category_id"
                                data-live-search="true">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }} - {{ $category->parent->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div style="margin-top: 30px" id="attributesContainer" class="col-md-12">
                        <div id="attributes" class="row"></div>
                        <div class="col-md-12">
                            <hr>
                            <p>افزودن قیمت و موجودی برای متغیر
                                <span class="font-weight-bold" id="variationName"></span> :
                            </p>
                        </div>

                        <div id="czContainer">
                            <div id="first">
                                <div class="recordset">
                                    <div class="form-row">
                                        <div style="margin: 15px 0;" class="form-group col-md-3">
                                            <label>نام</label>
                                            <input class="form-control" name="variation_values[value][]" type="text">
                                        </div>
                                        <div style="margin: 15px 0;" class="form-group col-md-3">
                                            <label>قیمت</label>
                                            <input class="form-control" name="variation_values[price][]" type="text">
                                        </div>
                                        <div style="margin: 15px 0;" class="form-group col-md-3">
                                            <label>تعداد</label>
                                            <input class="form-control" name="variation_values[quantity][]" type="text">
                                        </div>
                                        <div style="margin: 15px 0;" class="form-group col-md-3">
                                            <label>شناسه انبار</label>
                                            <input class="form-control" name="variation_values[sku][]" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12">
                        <hr>
                        <p>هزینه ارسال:</p>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="delivery_amount">هزینه ارسال</label>
                        <input class="form-control" id="delivery_amount" name="delivery_amount" type="text"
                               value="{{ old('delivery_amount') }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="delivery_amount_per_product">هزینه ارسال به ازای محصول اضافی</label>
                        <input class="form-control" id="delivery_amount_per_product" name="delivery_amount_per_product"
                               type="text" value="{{ old('delivery_amount_per_product') }}">
                    </div>

                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
