@extends('admin.layouts.admin')

@section('title')
    ایجاد کد تخفیف جدید
@endsection

@section('script')
    <script>
        $('#expired_at').MdPersianDateTimePicker({
            targetTextSelector: $('#expired_at_input'),
            englishNumber: true,
            enableTimePicker: true,
            textFormat: 'yyyy-MM-dd HH:mm'
        });
    </script>
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ایجاد کد تخفیف</h5>
            </div>
            <hr>

            @include('errors.message')

            <form action="{{ route('admin.coupons.store') }}" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input class="form-control" id="name" name="name" type="text">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="code">کد</label>
                        <input class="form-control" id="code" name="code" type="text">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="coupon_type">نوع</label>
                        <select class="form-control" name="coupon_type">
                            <option value="percentage">درصدی</option>
                            <option value="amount">مبلغی</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="amount">مبلغ</label>
                        <input class="form-control" id="amount" name="amount" type="text">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="percentage">درصد</label>
                        <input class="form-control" id="percentage" name="percentage" type="text">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="max_percentage_amount">حداکثر مبلغ درصدی</label>
                        <input class="form-control" id="max_percentage_amount" name="max_percentage_amount" type="text">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="expired_at">تاریخ انقضا</label>
                        <div class="input-group">
                            <div class="input-group-prepend order-2">
                                  <span class="input-group-text"
                                        id="expired_at">
                                         <i class="fas fa-clock"></i>
                                  </span>
                            </div>
                            <input type="text"
                                   id="expired_at_input"
                                   name="expired_at"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                    </div>
                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
