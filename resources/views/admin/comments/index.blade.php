@extends('admin.layouts.admin')

@section('title')
    لیست همه کامنت ها
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">

            @include('errors.message')

            <div class="d-flex justify-content-between mb-4">
                <h5 class="font-weight-bold">همه کامنت ها</h5>
            </div>
            <hr>

            <table class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                    <th>#</th>
                    <th>کاربر</th>
                    <th>محصول</th>
                    <th>متن کامنت</th>
                    <th>وضعیت</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $key => $comment)
                    <tr>
                        <td>{{ $comments->firstItem() + $key }}</td>
                        <td>{{ $comment->user->cellphone }}</td>
                        <td>
                            <a style="text-decoration: none;color: #858796" target="_blank"
                               href="{{ route('admin.products.show', $comment->product->id) }}">
                                {{ $comment->product->name }}
                            </a>
                        </td>
                        <td>{{ $comment->text }}</td>
                        <td>
                            <span class="{{ $comment->approved == 1 ? 'text-success' : 'text-danger' }}">
                                {{ $comment->approved == 1 ? 'تایید شده' : 'تایید نشده' }}
                            </span>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-outline-primary"
                               href="{{ route('admin.comments.show', $comment->id) }}">نمایش</a>
                        </td>
                        <td>
                            <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST">
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
