@extends('admin.layouts.admin')

@section('title')
    نمایش بنر
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">نمایش بنر</h5>
            </div>
            <hr>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>عنوان</label>
                    <input class="form-control" value="{{ $banner->title }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>متن</label>
                    <input class="form-control" value="{{ $banner->text }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>اولویت</label>
                    <input class="form-control" value="{{ $banner->priority }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>وضعیت</label>
                    <input class="form-control" value="{{ $banner->is_active == 1 ? 'فعال' : 'غیرفعال' }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>نوع بنر</label>
                    <input class="form-control" value="{{ $banner->type }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>متن دکمه</label>
                    <input class="form-control" value="{{ $banner->button_text }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>لینک دکمه</label>
                    <input class="form-control" value="{{ $banner->button_link }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>آیکون دکمه</label>
                    <input class="form-control" value="{{ $banner->button_icon }}" disabled>
                </div>
                <div class="col-md-12">
                    <hr>
                    <p>تصویر بنر : </p>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <a target="_blank" href="{{ bannerImageUrl($banner->image) }}">
                            <img width="300px" class="card-img-top"
                                 src="{{ bannerImageUrl($banner->image) }}"
                                 alt="{{ $banner->title }}">
                        </a>
                    </div>
                </div>
            </div>

            <a href="{{ route('admin.banners.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
        </div>

    </div>

@endsection
