@extends('admin.layouts.admin')

@section('title')
    لیست محصولات
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="d-flex justify-content-between mb-4">
                <h5 class="font-weight-bold">همه محصولات</h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.products.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد محصول
                </a>
            </div>
            <hr>

            <table class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                    <th>#</th>
                    <th>تصویر اصلی</th>
                    <th>نام</th>
                    <th>نامک</th>
                    <th>نام برند</th>
                    <th>دسته بندی</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $key => $product)
                    <tr>
                        <td>{{ $products->firstItem() + $key }}</td>
                        <td><img width="70px" src="{{ productImageUrl($product->primary_image)  }}" alt=""></td>
                        <td><a style="color: #858796;text-decoration: none;" target="_blank"
                               href="{{ route('admin.products.show', $product->id) }}">{{ $product->name }}</a></td>
                        <td>{{ $product->slug }}</td>
                        <td>{{ $product->brand->name }}</td>
                        <td>{{ $product->category->name . ' - ' . $product->category->parent->name }}</td>
                        <td>
                            <span class="{{ $product->is_active == 'فعال' ? 'text-success' : 'text-danger' }}">
                                {{ $product->is_active }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle"
                                        data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    عملیات
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item text-right"
                                       href="{{ route('admin.products.edit', $product->id) }}">ویرایش محصول</a>
                                    <a class="dropdown-item text-right"
                                       href="#">ویرایش تصاویر</a>
                                    <a class="dropdown-item text-right"
                                       href="#">ویرایش دسته بندی و ویژگی</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-5">
                {{ $products->render() }}
            </div>

        </div>

    </div>

@endsection
