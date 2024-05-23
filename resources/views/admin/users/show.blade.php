@extends('admin.layouts.admin')

@section('title')
    نمایش کاربر: {{ $user->cellphone }}
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">نمایش کاربر: {{ $user->cellphone }}</h5>
            </div>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="name">موبایل</label>
                    <input id="name" class="form-control" value="{{ $user->cellphone }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="name">تاریخ ایجاد</label>
                    <input id="name" class="form-control"
                           value="{{ $user->created_at }}" disabled>
                </div>
            </div>
            <a href="{{ route('admin.users.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
        </div>
    </div>

@endsection
