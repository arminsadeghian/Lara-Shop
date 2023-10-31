@extends('admin.layouts.admin')

@section('title')
    نمایش تگ: {{ $tag->name }}
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">نمایش تگ: {{ $tag->name }}</h5>
            </div>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="name">نام</label>
                    <input class="form-control" value="{{ $tag->name }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="name">تاریخ ایجاد</label>
                    <input class="form-control" value="{{ verta($tag->created_at) }}" disabled>
                </div>
            </div>
            <a href="{{ route('admin.tags.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
        </div>
    </div>

@endsection
