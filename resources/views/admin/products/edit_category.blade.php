@extends('admin.layouts.admin')

@section('title')
    ویرایش دسته بندی محصول
@endsection

@section('script')
    <script>
        $('#categorySelect').selectpicker({
            'title': 'انتخاب دسته بندی'
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
                <h5 class="font-weight-bold">ویرایش دسته بندی و ویژگی های محصول : {{ $product->name }}</h5>
            </div>
            <hr>

            @include('errors.message')

            <form action="{{ route('admin.products.category.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group col-md-3 m-auto">
                    <label for="category_id">دسته بندی</label>
                    <select class="form-control" id="categorySelect" name="category_id"
                            data-live-search="true">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $product->category->id ? 'selected' : '' }}>
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

                <button class="btn btn-outline-primary mt-5" type="submit">ویرایش</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
