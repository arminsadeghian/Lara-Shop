@extends('admin.layouts.admin')

@section('title')
    نمایش کامنت
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">

            @include('errors.message')

            <div class="mb-4">
                <h5 class="font-weight-bold">نمایش کامنت</h5>
            </div>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>کاربر</label>
                    <input class="form-control" value="{{ $comment->user->cellphone }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>محصول</label>
                    <input class="form-control" value="{{ $comment->product->name }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>وضعیت</label>
                    <input class="form-control" value="{{ $comment->approved == 1 ? 'تایید شده' : 'تایید نشده' }}"
                           disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>تاریخ ایجاد</label>
                    <input class="form-control" value="{{ verta($comment->created_at) }}" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label>متن کامنت</label>
                    <textarea class="form-control" disabled>{{ $comment->text }}</textarea>
                </div>
            </div>
            <a href="{{ route('admin.comments.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            @if($comment->approved == 0)
                <a href="{{ route('admin.comments.change_approve', $comment->id) }}"
                   class="btn btn-outline-success mt-5 mr-3">تایید</a>
            @else
                <a href="{{ route('admin.comments.change_approve', $comment->id) }}"
                   class="btn btn-outline-danger mt-5 mr-3">عدم تایید</a>
            @endif
        </div>
    </div>

@endsection
