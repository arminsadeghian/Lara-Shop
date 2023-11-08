@extends('admin.layouts.admin')

@section('title')
    لیست همه بنر ها
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="d-flex justify-content-between mb-4">
                <h5 class="font-weight-bold">همه بنر ها</h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.banners.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد بنر
                </a>
            </div>
            <hr>

            <table id="banners-list" class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                    <th>#</th>
                    <th>تصویر</th>
                    <th>عنوان</th>
                    <th>متن</th>
                    <th>اولویت</th>
                    <th>نوع</th>
                    <th>متن دکمه</th>
                    <th>لینک دکمه</th>
                    <th>آیکون دکمه</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($banners as $key => $banner)
                    <tr>
                        <td>{{ $banners->firstItem() + $key }}</td>
                        <td>
                            <img width="70px" src="{{ bannerImageUrl($banner->image) }}" alt="">
                        </td>
                        <td>{{ $banner->title }}</td>
                        <td>{{ $banner->text }}</td>
                        <td>{{ $banner->priority }}</td>
                        <td>{{ $banner->type }}</td>
                        <td>{{ $banner->button_text }}</td>
                        <td>{{ $banner->button_link }}</td>
                        <td>{{ $banner->button_icon }}</td>
                        <td>
                            <span class="{{ $banner->is_active == 'فعال' ? 'text-success' : 'text-danger' }}">
                                {{ $banner->is_active }}
                            </span>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-outline-primary"
                               href="{{ route('admin.banners.show', $banner->id) }}">نمایش</a>
                            <a class="btn btn-sm btn-outline-primary"
                               href="{{ route('admin.banners.edit', $banner->id) }}">ویرایش</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

@endsection
