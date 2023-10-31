@extends('admin.layouts.admin')

@section('title')
    لیست دسته بندی ها
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="d-flex justify-content-between mb-4">
                <h5 class="font-weight-bold">همه دسته بندی ها</h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.categories.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد دسته بندی
                </a>
            </div>
            <hr>

            <table class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>نام انگلیسی</th>
                    <th>والد</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $key => $category)
                    <tr>
                        <td>{{ $categories->firstItem() + $key }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->parent->name ?? 'بدون والد' }}</td>
                        <td>
                            <span class="{{ $category->is_active == 'فعال' ? 'text-success' : 'text-danger' }}">
                                {{ $category->is_active }}
                            </span>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-outline-primary"
                               href="{{ route('admin.categories.show', $category->id) }}">نمایش</a>
                            <a class="btn btn-sm btn-outline-primary"
                               href="{{ route('admin.categories.edit', $category->id) }}">ویرایش</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

@endsection
