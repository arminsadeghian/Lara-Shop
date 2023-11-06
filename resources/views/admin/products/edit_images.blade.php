@extends('admin.layouts.admin')

@section('title')
    ویرایش تصاویر محصول : {{ $product->name }}
@endsection

@section('script')
    <script>
        // Show file name
        $('#primary_image').change(function () {
            let fileName = $(this).val();
            $(this).next('.custom-file-label').html(fileName);
        });

        $('#images').change(function () {
            let fileName = $(this).val();
            $(this).next('.custom-file-label').html(fileName);
        });
    </script>
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ویرایش تصاویر محصول : {{ $product->name }}</h5>
            </div>

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

            <form action="{{ route('admin.products.images.add', $product->id) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    @foreach($productImages as $image)
                        <div class="col-md-3">
                            <div class="card">
                                <a target="_blank" href="{{ productImageUrl($image->image) }}">
                                    <img class="card-img-top"
                                         src="{{ productImageUrl($image->image) }}"
                                         alt="{{ $product->name }}">
                                </a>
                                <div class="card-body text-center">
                                    <form action="{{ route('admin.products.images.destroy', $product->id) }}"
                                          method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="image_id" value="{{ $image->id }}">
                                        <button type="submit" class="btn btn-danger btn-sm mb-3">حذف</button>
                                    </form>
                                    <form action="{{ route('admin.products.images.set_primary', $product->id) }}"
                                          method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="image_id" value="{{ $image->id }}">
                                        <button type="submit" class="btn btn-primary btn-sm mb-3">
                                            انتخاب به عنوان تصویر اصلی
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-md-12">
                        <hr>
                        <p style="margin-bottom: 30px">اضافه کردن تصاویر جدید به محصول:</p>
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

                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>

        </div>

    </div>

@endsection
