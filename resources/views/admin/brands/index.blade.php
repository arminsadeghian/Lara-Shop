@extends('admin.layouts.admin')

@section('title')
    لیست همه برند ها
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="d-flex justify-content-between mb-4">
                <h5 class="font-weight-bold">همه برند ها</h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.brands.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد برند
                </a>
            </div>
            <hr>

            <table class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>نامک</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($brands as $key => $brand)
                    <tr>
                        <td>{{ $brands->firstItem() + $key }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>{{ $brand->slug }}</td>
                        <td>
                            <span class="{{ $brand->is_active == 'فعال' ? 'text-success' : 'text-danger' }}">
                                {{ $brand->is_active }}
                            </span>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-outline-primary"
                               href="{{ route('admin.brands.show', $brand->id) }}">نمایش</a>
                            <a class="btn btn-sm btn-outline-primary"
                               href="{{ route('admin.brands.edit', $brand->id) }}">ویرایش</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

@endsection
