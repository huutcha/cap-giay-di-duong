@extends('backend.auth.main')
@section('title')
    Đặt lại mật khẩu
@endsection
@section('content')
    <h1 class="text-center mt-4">
        <strong>Đặt lại mật khẩu</strong>
    </h1>
    <form action="{{url('/admin/reset-password')}}" method="post" class="my-5 p-4 mx-auto" style="width:400px; background-color: white" >
        @csrf
        @method('PUT')
        @if (Session::has('status'))
            <p class="text-success">{{Session::get('status')}}</p> 
        @endif
        <input type="hidden" name="token" value="{{$token}}">
        <input type="hidden" name="email" value="{{$email}}">
        <div class="form-group">
            <label for="password" style="font-size: 18px; margin-bottom: 6px">Mật khẩu mới:</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation" style="font-size: 18px; margin-bottom: 6px">Nhập lại mật khẩu:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
            @error('password_confirmation')
                <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-3">XÁC NHẬN</button>
        </div>
    </form>
@endsection