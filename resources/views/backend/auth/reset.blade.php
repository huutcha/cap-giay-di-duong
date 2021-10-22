@extends('backend.auth.main')

@section('title')
Quên mật khẩu
@endsection

@section('content')
    <h1 class="text-center mt-4">
        <strong>Quên mật khẩu</strong>
    </h1>
    <form action="{{url('/admin/forgot-password')}}" method="post" class="my-5 p-4 mx-auto" style="width:400px; background-color: white" >
        @csrf
        @if (Session::has('status'))
            <p class="text-success">{{Session::get('status')}}</p> 
        @endif
        <p>Chúng tôi sẽ gửi đường dẫn tạo mật khẩu mới vào email đăng ký với username của bạn. Vui lòng kiểm tra email trong khoảng 30 giây sau.</p>
        <div class="form-group">
            <label for="email" style="font-size: 18px; margin-bottom: 6px">Email:</label>
            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}">
            @error('email')
                <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-3">GỬI LINK</button>
        </div>
    </form>
@endsection