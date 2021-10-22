@extends('backend.auth.main')

@section('title')
Đăng nhập hệ thống
@endsection
@push('css')
    <style>
        .toast{
            position: fixed;
            top: 5%;
            right: 5%;
        }
    </style>
@endpush
@section('content')
    <h1 class="text-center mt-4">
        <strong>ĐĂNG NHẬP HỆ THỐNG</strong>
    </h1>
    <form action="{{url('/admin/login')}}" method="post" class="my-5 p-4 mx-auto" style="width:400px; background-color: white" >
        @csrf
        @if (Session::has('error'))
            <div class="text-danger">{{Session::get('error')}}</div>  
        @endif
        <div class="form-group">
            <label for="username" style="font-size: 18px; margin-bottom: 6px">Username:</label>
            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{old('username')}}">
            @error('username')
                <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="password" style="font-size: 18px; margin-bottom: 6px">Password:</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
        <a href="{{url('/admin/forgot-password')}}">Quên mật khẩu?</a> <br>
        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-3">ĐĂNG NHẬP</button>
        </div>
    </form>
    @if(Session::has('status'))
        <div class="toast show align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{Session::get('status')}}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>   
    @endif
@endsection