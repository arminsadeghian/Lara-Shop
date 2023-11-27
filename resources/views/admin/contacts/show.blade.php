@extends('admin.layouts.admin')

@section('title')
    نمایش پیام
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">نمایش پیام</h5>
            </div>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>نام</label>
                    <input class="form-control" value="{{ $contact->name }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>ایمیل</label>
                    <input class="form-control" value="{{ $contact->email }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>عنوان</label>
                    <input class="form-control" value="{{ $contact->subject }}" disabled>
                </div>
                <div class="form-group col-md-12">
                    <label>متن پیام</label>
                    <textarea class="form-control" rows="6" disabled>{{ $contact->text }}</textarea>
                </div>
            </div>
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
        </div>
    </div>

@endsection
