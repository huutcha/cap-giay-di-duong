<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/logo-ha-noi.png')}}" />
        <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
        @stack('link-css')
        @stack('css')
    </head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('backend.layouts._header')
        @include('backend.layouts._sidebar')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    <h1>@yield('content-title')</h1>
                    </div>
                    <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">@yield('content-title')</li>
                    </ol>
                    </div>
                </div>
                </div><!-- /.container-fluid -->
            </section>
            @yield('content')
        </div>
        @include('backend.layouts._footer')
    </div>


<script src="{{ mix('assets/js/app.js') }}"></script>
@stack('link-js')

@stack('js')
</body>
</html>