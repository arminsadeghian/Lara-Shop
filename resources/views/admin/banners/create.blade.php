@extends('admin.layouts.admin')

@section('title')
    ایجاد بنر جدید
@endsection

@section('script')
    <script>
        $('#image').change(function () {
            let fileName = $(this).val();
            $(this).next('.custom-file-label').html(fileName);
        });
    </script>
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ایجاد بنر</h5>
            </div>
            <hr>

            @include('errors.message')

            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="title">عنوان</label>
                        <input class="form-control" id="title" name="title" type="text">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="text">متن</label>
                        <input class="form-control" id="text" name="text" type="text">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="priority">اولویت</label>
                        <input class="form-control" id="priority" name="priority" type="text">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="is_active">وضعیت</label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value="1" selected>فعال</option>
                            <option value="0">غیرفعال</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="type">نوع بنر</label>
                        <input class="form-control" id="type" name="type" type="text">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="button_text">متن دکمه</label>
                        <input class="form-control" id="button_text" name="button_text" type="text">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="button_link">لینک دکمه</label>
                        <input class="form-control" id="button_link" name="button_link" type="text">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="button_icon">آیکون دکمه</label>
                        <input class="form-control" id="button_icon" name="button_icon" type="text">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="image">انتخاب تصویر</label>
                        <div class="custom-file">
                            <input type="file" id="image" name="image" class="custom-file-input">
                            <label class="custom-file-label" for="image">انتخاب فایل</label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('admin.banners.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
