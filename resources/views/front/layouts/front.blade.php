<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <title>@yield('title')</title>
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="{{ asset('/css/front.css') }}"/>
</head>

<body>

<div class="wrapper">

    @include('front.sections.header')

    @include('front.sections.mobile_off_canvas')

    @yield('content')

    @include('front.sections.footer')
</div>

<script src="{{ asset('/js/front/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('/js/front/plugins.js') }}"></script>
<script src="{{ asset('/js/front.js') }}"></script>

@yield('scripts')

</body>

</html>
