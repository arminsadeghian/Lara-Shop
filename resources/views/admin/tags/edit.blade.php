@extends('admin.layouts.admin')

@section('title')
    ویرایش تگ : {{ $tag->name }}
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ویرایش تگ : {{ $tag->name }}</h5>
            </div>
            <hr>

            @include('errors.message')

            <form action="{{ route('admin.tags.update', $tag->id) }}" method="POST">
                @csrf
                @method('put')

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ $tag->name }}">
                    </div>
                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('admin.tags.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
