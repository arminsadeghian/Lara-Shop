@extends('admin.layouts.admin')

@section('title')
    لیست تراکنش ها
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="d-flex justify-content-between mb-4">
                <h5 class="font-weight-bold">لیست تراکنش ها</h5>
            </div>
            <hr>

            <table id="banners-list" class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                    <th>#</th>
                    <th>کاربر</th>
                    <th> ID سفارش</th>
                    <th>مبلغ</th>
                    <th>کد پیگیری</th>
                    <th>درگاه پرداخت</th>
                    <th>وضعیت</th>
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $key => $transaction)
                    <tr>
                        <td>{{ $transactions->firstItem() + $key }}</td>
                        <td>{{ $transaction->user->cellphone }}</td>
                        <td>
                            <a target="_blank" style="color: #858796"
                               href="{{ route('admin.orders.show', $transaction->order_id) }}">
                                {{ $transaction->order_id }}
                            </a>
                        </td>
                        <td>{{ number_format($transaction->amount) }} تومان</td>
                        <td>{{ $transaction->ref_id }}</td>
                        <td>{{ $transaction->gateway_name }}</td>
                        <td>
                            <span class="{{ $transaction->status == 1 ? 'text-success' : 'text-danger' }}">
                                {{ $transaction->status == 1 ? 'پرداخت شده' : 'پرداخت نشده' }}
                            </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-5">
                {{ $transactions->render() }}
            </div>

        </div>

    </div>

@endsection
