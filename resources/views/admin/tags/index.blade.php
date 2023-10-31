@extends('admin.layouts.admin')

@section('title')
    لیست تگ ها
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="d-flex justify-content-between mb-4">
                <h5 class="font-weight-bold">همه تگ ها</h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.tags.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد تگ
                </a>
            </div>
            <hr>

            <table class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>تاریخ ایجاد</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tags as $key => $tag)
                    <tr>
                        <td>{{ $tags->firstItem() + $key }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>{{ verta($tag->created_at) }}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-primary"
                               href="{{ route('admin.tags.show', $tag->id) }}">نمایش</a>
                            <a class="btn btn-sm btn-outline-primary"
                               href="{{ route('admin.tags.edit', $tag->id) }}">ویرایش</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

@endsection
