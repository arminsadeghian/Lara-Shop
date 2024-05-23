@extends('admin.layouts.admin')

@section('title')
    لیست همه کاربران
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">

            @include('errors.message')

            <div class="d-flex justify-content-between mb-4">
                <h5 class="font-weight-bold">همه کاربران</h5>
                <a class="btn btn-sm btn-outline-primary" href="#">
                    <i class="fa fa-plus"></i>
                    کاربر جدید
                </a>
            </div>
            <hr>

            <table class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                    <th>#</th>
                    <th>موبایل</th>
                    <th>تاریخ ثبت نام</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $key => $user)
                    <tr>
                        <td>{{ $users->firstItem() + $key }}</td>
                        <td>{{ $user->cellphone }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-primary"
                               href="{{ route('admin.users.show', $user->id) }}">نمایش</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

@endsection
