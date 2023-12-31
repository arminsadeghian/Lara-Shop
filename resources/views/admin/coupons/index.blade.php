@extends('admin.layouts.admin')

@section('title')
    لیست همه کوپن ها
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">

            @include('errors.message')

            <div class="d-flex justify-content-between mb-4">
                <h5 class="font-weight-bold">همه کوپن ها</h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.coupons.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد کوپن
                </a>
            </div>
            <hr>

            <table class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>کد</th>
                    <th>تایپ</th>
                    <th>مبلغ</th>
                    <th>درصد</th>
                    <th>حداکثر مبلغ درصدی</th>
                    <th>تاریخ انقضا</th>
                    <th>توضیحات</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($coupons as $key => $coupon)
                    <tr>
                        <td>{{ $coupons->firstItem() + $key }}</td>
                        <td>{{ $coupon->name }}</td>
                        <td>{{ $coupon->code }}</td>
                        <td>{{ $coupon->type == 'amount' ? 'مبلغی' : 'درصدی' }}</td>
                        <td>{{ number_format($coupon->amount) }}</td>
                        <td>{{ $coupon->percentage }}</td>
                        <td>{{ number_format($coupon->max_percentage_amount) }}</td>
                        <td>{{ verta($coupon->expired_at) }}</td>
                        <td>{{ $coupon->description }}</td>
                        <td style="display: flex; justify-content: space-between;">
                            <a class="btn btn-sm btn-outline-primary"
                               href="{{ route('admin.coupons.show', $coupon->id) }}">نمایش</a>
                            <a class="btn btn-sm btn-outline-primary"
                               href="{{ route('admin.coupons.edit', $coupon->id) }}">ویرایش</a>
                            <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-primary">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

@endsection
