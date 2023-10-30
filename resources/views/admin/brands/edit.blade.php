@extends('admin.layouts.admin')

@section('title')
    ویرایش برند: {{ $brand->name }}
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">

            @include('errors.message')

            <div class="mb-4">
                <h5 class="font-weight-bold">ویرایش برند: {{ $brand->name }}</h5>
            </div>
            <hr>

            <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST">
                @csrf
                @method('put')

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ $brand->name }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="is_active">وضعیت</label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value="1" {{ $brand->is_active == 'فعال' ? 'selected' : '' }}>فعال</option>
                            <option value="0" {{ $brand->is_active == 'غیرفعال' ? 'selected' : '' }}>غیرفعال</option>
                        </select>
                    </div>
                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
