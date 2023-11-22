@extends('admin.layouts.admin')

@section('title')
    نمایش کوپن: {{ $coupon->name }}
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">نمایش کوپن: {{ $coupon->name }}</h5>
            </div>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>نام</label>
                    <input class="form-control" value="{{ $coupon->name }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>کد</label>
                    <input class="form-control" value="{{ $coupon->code }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>نوع</label>
                    <input class="form-control" value="{{ $coupon->type == 'amount' ? 'مبلغی' : 'درصدی' }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>مبلغ</label>
                    <input class="form-control" value="{{ number_format($coupon->amount) }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>درصد</label>
                    <input class="form-control" value="{{ $coupon->percentage }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="max_percentage_amount">حداکثر مبلغ درصدی</label>
                    <input class="form-control" value="{{ $coupon->max_percentage_amount }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>تاریخ انقضا</label>
                    <input class="form-control" value="{{ verta($coupon->expired_at) }}" disabled>
                </div>
                <div class="form-group col-md-12">
                    <label>توضیحات</label>
                    <textarea class="form-control" rows="5" disabled>{{ $coupon->description }}</textarea>
                </div>
                <div class="form-group col-md-12">
                    <a class="btn btn-dark mt-5 mr-3"
                       href="{{ route('admin.coupons.index') }}">بازگشت</a>
                </div>
            </div>
        </div>

    </div>

@endsection
