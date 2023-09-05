<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="theme-color" content="#ffffff">
    @vite('resources/sass/app.scss')
    @include('partials.head')
    @yield('addon-style')
</head>

<body >
    <div class="sidebar sidebar-dark sidebar-fixed " id="sidebar">
        <div class="sidebar-brand d-none d-md-flex ">
            @yield('title', 'Dashboard')
        </div>
        @include('partials.navigation')
        <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light ">
        {{-- Header --}}
        @include('partials.header')
        {{-- En Header --}}
        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                <h1 class="fw-semibold h2 mb-4">@yield('page-heading', 'Dashboard')</h1>
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
    @include('partials.script')
    @yield('addon-script')
</body>

</html>
