@extends('admin.layouts.admin')

@section('title')
    لیست سفارشات
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="d-flex justify-content-between mb-4">
                <h5 class="font-weight-bold">سفارشات</h5>
            </div>
            <hr>

            <table class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                    <th>#</th>
                    <th>کاربر</th>
                    <th>آدرس گیرنده</th>
                    <th>کد تخفیف</th>
                    <th>وضعیت</th>
                    <th>کد پیگیری</th>
                    <th>مبلغ کل</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $key => $order)
                    <tr>
                        <td>{{ $orders->firstItem() + $key }}</td>
                        <td>{{ $order->user->cellphone }}</td>
                        <td>{{ $order->address->title }}</td>
                        <td>{{ $order->coupon->code ?? 'ندارد' }}</td>
                        <td>
                            <span class="{{ $order->payment_status == 1 ? 'text-success' : 'text-danger' }}">
                                {{ $order->payment_status == 1 ? 'پرداخت شده' : 'پرداخت نشده' }}
                            </span>
                        </td>
                        <td>{{ $order->reference_code }}</td>
                        <td>{{ number_format($order->paying_amount) }} تومان</td>
                        <td>
                            <a class="btn btn-sm btn-outline-primary"
                               href="{{ route('admin.orders.show', $order->id) }}">نمایش</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

@endsection
