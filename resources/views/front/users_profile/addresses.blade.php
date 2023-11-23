@extends('front.layouts.front')

@section('title')
    فروشگاه اینترنتی لباس
@endsection

@section('scripts')
    <script>
        $('.province-select').change(function () {

            let provinceID = $(this).val();

            if (provinceID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/profile/get-province-cities-list') }}?province_id=" + provinceID,
                    success: function (res) {
                        if (res) {
                            $(".city-select").empty();

                            $.each(res, function (key, city) {
                                $(".city-select").append('<option value="' + city.id + '">' +
                                    city.name + '</option>');
                            });

                        } else {
                            $(".city-select").empty();
                        }
                    }
                });
            } else {
                $(".city-select").empty();
            }
        });
    </script>
@endsection

@section('content')
    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="{{ route('home.index') }}">صفحه اصلی</a>
                    </li>
                    <li style="font-weight: bold">آدرس ها</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="my-account-wrapper pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="myaccount-page-wrapper">
                        @include('errors.message')
                        <div class="row text-right" style="direction: rtl;">
                            <div class="col-lg-3 col-md-4">
                                @include('front.users_profile.sidebar')
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <div class="myaccount-content address-content">
                                    <h3> آدرس ها </h3>

                                    @foreach($addresses as $address)
                                        <div>
                                        <address>
                                            <p>
                                                <span class="font-weight-bold">عنوان آدرس :</span>
                                                <span>{{ $address->title }}</span>
                                            </p>
                                            <p>
                                                <span class="font-weight-bold"> آدرس : </span>
                                                <span>{{ $address->address }}</span>
                                                <br>
                                                <span class="font-weight-bold"> استان : </span>
                                                <span>{{ $address->province->name }}</span>
                                                <br>
                                                <span class="font-weight-bold"> شهر : </span>
                                                <span>{{ $address->city->name }}</span>
                                            </p>
                                            <p>
                                                <span class="font-weight-bold">کدپستی :</span>
                                                <span>{{ $address->postal_code }}</span>
                                            </p>
                                            <p>
                                                <span class="font-weight-bold">شماره موبایل :</span>
                                                <span>{{ $address->cellphone }}</span>
                                            </p>

                                        </address>
                                        <a href="#" class="check-btn sqr-btn collapse-address-update">
                                            <i class="sli sli-pencil"></i>
                                            ویرایش آدرس
                                        </a>

                                        <div class="collapse-address-update-content"
                                                 style="{{ count($errors->addressUpdate) > 0 ? 'display:block' : '' }}">

                                                <form action="{{ route('home.user_profile.addresses.update', $address->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="tax-select col-lg-6 col-md-6">
                                                            <label>عنوان</label>
                                                            <input class="form-control" type="text" name="title"
                                                                   placeholder="عنوان" value="{{ $address->title }}">
                                                            @error('title','addressUpdate')
                                                                <p class="input-error-validation">
                                                                    <strong>{{ $message }}</strong>
                                                                </p>
                                                            @enderror
                                                        </div>
                                                        <div class="tax-select col-lg-6 col-md-6">
                                                            <label>شماره تماس</label>
                                                            <input class="form-control" type="text" name="cellphone"
                                                                   placeholder="شماره تماس" value="{{ $address->cellphone }}">
                                                            @error('cellphone','addressUpdate')
                                                                <p class="input-error-validation">
                                                                    <strong>{{ $message }}</strong>
                                                                </p>
                                                            @enderror
                                                        </div>
                                                        <div class="tax-select col-lg-6 col-md-6">
                                                            <label>استان</label>
                                                            <select class="form-control email s-email s-wid province-select"
                                                                    name="province_id">
                                                                @foreach($provinces as $province)
                                                                    <option value="{{ $province->id }}" {{ $province->id == $address->province_id ? 'selected' : '' }}>{{ $province->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('province_id','addressUpdate')
                                                                <p class="input-error-validation">
                                                                    <strong>{{ $message }}</strong>
                                                                </p>
                                                            @enderror
                                                        </div>
                                                        <div class="tax-select col-lg-6 col-md-6">
                                                            <label>شهر</label>
                                                            <select class="form-control email s-email s-wid city-select"
                                                                    name="city_id">
                                                                <option value="{{ $address->city_id }}">{{ $address->city->name }}</option>
                                                            </select>
                                                            @error('city_id','addressUpdate')
                                                                <p class="input-error-validation">
                                                                    <strong>{{ $message }}</strong>
                                                                </p>
                                                            @enderror
                                                        </div>
                                                        <div class="tax-select col-lg-6 col-md-6">
                                                            <label>آدرس</label>
                                                            <input class="form-control" type="text" name="address" placeholder="آدرس"
                                                                   value="{{ $address->address }}">
                                                            @error('address','addressUpdate')
                                                                <p class="input-error-validation">
                                                                    <strong>{{ $message }}</strong>
                                                                </p>
                                                            @enderror
                                                        </div>
                                                        <div class="tax-select col-lg-6 col-md-6">
                                                            <label>کد پستی</label>
                                                            <input class="form-control" type="text" name="postal_code" placeholder="کد پستی"
                                                                   value="{{ $address->postal_code }}">
                                                            @error('postal_code','addressUpdate')
                                                                <p class="input-error-validation">
                                                                    <strong>{{ $message }}</strong>
                                                                </p>
                                                            @enderror
                                                        </div>
                                                        <div class=" col-lg-12 col-md-12">
                                                            <button class="cart-btn-2" type="submit">
                                                                ثبت آدرس
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>

                                    </div>
                                    @endforeach

                                    <hr>

                                    <button class="collapse-address-create mt-3" type="submit">
                                        ایجاد آدرس جدید
                                    </button>
                                    <div class="collapse-address-create-content"
                                         style="{{ count($errors->addressStore) > 0 ? 'display:block' : '' }}">

                                        <form action="{{ route('home.user_profile.addresses.store') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <input class="form-control" type="text" name="title"
                                                           placeholder="عنوان" value="{{ old('title') }}">
                                                    @error('title','addressStore')
                                                        <p class="input-error-validation">
                                                            <strong>{{ $message }}</strong>
                                                        </p>
                                                    @enderror
                                                </div>
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <input class="form-control" type="text" name="cellphone"
                                                           placeholder="شماره تماس" value="{{ old('cellphone') }}">
                                                    @error('cellphone','addressStore')
                                                        <p class="input-error-validation">
                                                            <strong>{{ $message }}</strong>
                                                        </p>
                                                    @enderror
                                                </div>
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label>
                                                        استان
                                                    </label>
                                                    <select class="form-control email s-email s-wid province-select"
                                                            name="province_id">
                                                        @foreach($provinces as $province)
                                                            <option
                                                                value="{{ $province->id }}">{{ $province->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('province_id','addressStore')
                                                        <p class="input-error-validation">
                                                            <strong>{{ $message }}</strong>
                                                        </p>
                                                    @enderror
                                                </div>
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label>
                                                        شهر
                                                    </label>
                                                    <select class="form-control email s-email s-wid city-select"
                                                            name="city_id">
                                                    </select>
                                                    @error('city_id','addressStore')
                                                        <p class="input-error-validation">
                                                            <strong>{{ $message }}</strong>
                                                        </p>
                                                    @enderror
                                                </div>
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <input type="text" name="address" placeholder="آدرس"
                                                           value="{{ old('address') }}">
                                                    @error('address','addressStore')
                                                        <p class="input-error-validation">
                                                            <strong>{{ $message }}</strong>
                                                        </p>
                                                    @enderror
                                                </div>
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <input type="text" name="postal_code" placeholder="کد پستی"
                                                           value="{{ old('postal_code') }}">
                                                    @error('postal_code','addressStore')
                                                        <p class="input-error-validation">
                                                            <strong>{{ $message }}</strong>
                                                        </p>
                                                    @enderror
                                                </div>
                                                <div class=" col-lg-12 col-md-12">
                                                    <button class="cart-btn-2" type="submit">
                                                        ثبت آدرس
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
