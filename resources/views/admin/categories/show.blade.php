@extends('admin.layouts.admin')

@section('title')
    نمایش دسته بندی
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">نمایش دسته بندی</h5>
            </div>
            <hr>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="name">نام</label>
                    <input class="form-control" value="{{ $category->name }}"
                           disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="slug">نام انگلیسی</label>
                    <input class="form-control" value="{{ $category->slug }}"
                           disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="parent">والد</label>
                    <input class="form-control" value="{{ $category->parent->name ?? 'بدون والد' }}"
                           disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="is_active">وضعیت</label>
                    <input class="form-control" value="{{ $category->is_active }}"
                           disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="attributes">ویژگی ها</label>
                    <div style="background-color: #eaecf4" class="form-control">
                        @foreach($category->attributes as $attribute)
                            {{ $attribute->name }}{{ $loop->last ? '' : '،' }}
                        @endforeach
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label>ویژگی های قابل فیلتر</label>
                    <div style="background-color: #eaecf4" class="form-control">
                        @foreach($category->attributes()->wherePivot('is_filter', 1)->get() as $attribute)
                            {{ $attribute->name }}{{ $loop->last ? '' : '،' }}
                        @endforeach
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label>ویژگی متغیر</label>
                    <div style="background-color: #eaecf4" class="form-control">
                        @foreach($category->attributes()->wherePivot('is_variation', 1)->get() as $attribute)
                            {{ $attribute->name }}
                        @endforeach
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="icon">آیکون</label>
                    <input class="form-control" value="{{ $category->icon }}" disabled>
                </div>
                <div class="form-group col-md-12">
                    <label for="description">توضیحات</label>
                    <textarea class="form-control" disabled>{{ $category->description }}</textarea>
                </div>
            </div>

        </div>

    </div>

@endsection
