@extends('admin.layouts.admin')

@section('title')
    لیست همه ویژگی ها
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">

            @include('errors.message')

            <div class="d-flex justify-content-between mb-4">
                <h5 class="font-weight-bold">همه ویژگی ها</h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.attributes.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد ویژگی
                </a>
            </div>
            <hr>

            <table class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($attributes as $key => $attribute)
                    <tr>
                        <td>{{ $attributes->firstItem() + $key }}</td>
                        <td>{{ $attribute->name }}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-primary"
                               href="{{ route('admin.attributes.show', $attribute->id) }}">نمایش</a>
                            <a class="btn btn-sm btn-outline-primary"
                               href="{{ route('admin.attributes.edit', $attribute->id) }}">ویرایش</a>
                            <form style="display: inline"
                                  action="{{ route('admin.attributes.destroy', $attribute->id) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

@endsection
