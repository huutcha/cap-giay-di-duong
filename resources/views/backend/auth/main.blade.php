<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        {{-- <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png')}}" /> --}}
        <link rel="stylesheet" href="{{asset('vendors/bootstrap-5.1.2-dist/css/bootstrap.css')}}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
        @stack('link-css')
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
        @stack('css')
    </head>
<body>
    <header>
        <div class="container">
            @include('frontend.layouts._header')
        </div>
    </header>
    <section>
        <div class="container">
            @yield('content')
        </div>
    </section>
    <footer>
        <div class="container">
            @include('frontend.layouts._footer')
        </div>
    </footer>



<script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('vendors/bootstrap-5.1.2-dist/js/bootstrap.js')}}"></script>
<script src="{{asset('vendors/bootstrap-5.1.2-dist/js/bootstrap.bundle.js')}}"></script>
{{-- <script src="{{asset('vendors/sweetalert/dist/sweetalert.min.js')}}"></script> --}}
<script src="{{ mix('assets/js/app.js') }}"></script>
@stack('link-js')

@stack('js')
</body>
</html>