@extends('backend.layouts.main')
@section('title')
    Thông tin chi tiết người dùng
@endsection
@section('content-title')
    Cán bộ / Chi tiết
@endsection
@push('link-css')
    <link rel="stylesheet" href="{{asset('assets/css/user.css')}}">
@endpush
@push('css')
    <style>
        .select2-container{
            flex: 1;
            margin: 0 6px;
        }
    </style>
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title"><strong>Thông tin cán bộ</strong></div>
            </div>
            <div class="card-body">
                <form action="{{url('/admin/users/'.$user->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Họ:</label>
                            <input type="text" name="fname" class="form-control" value="{{$user->human->fname}}" required>
                            <div class="invalid-feedback">
                                Trường này không được để trống
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Tên:</label>
                            <input type="text" name="lname" class="form-control" value="{{$user->human->lname}}" required>
                            <div class="invalid-feedback">
                                Trường này không được để trống
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Căn cước công dân(CMTND):</label>
                        <input type="text" name="cccd" class="form-control" value="{{$user->human->cccd}}" required>
                        <div class="invalid-feedback">
                            Trường này không được để trống
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Email:</label>
                        <input type="text" name="email" class="form-control" value="{{$user->email}}" required>
                        <div class="invalid-feedback">
                            Trường này không được để trống
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại:</label>
                        <input type="text" name="phone" class="form-control" value="{{$user->human->phone}}" required>
                        <div class="invalid-feedback">
                            Trường này không được để trống
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 form-group align-items-center">
                            <label for="" class="col-form-label">Giới tính:</label>
                            <div class="">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male"  value="Nam" {{$user->human->gender == 'Nam' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="male">Nam</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female"  value="Nữ" {{$user->human->gender == 'Nữ' ? 'checked' : ''}} >
                                    <label class="form-check-label" for="female">Nữ</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="other"  value="Khác" {{$user->human->gender == 'Khác' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="other">Khác</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="" class=" col-form-label">Ngày sinh:</label>
                            <div class="">
                                <input type="date" name="dob" class="form-control" value="{{$user->human->dob}}" required />
                                <div class="invalid-feedback">
                                    Trường này không được để trống
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Quê quán:</label>
                        <input type="text" name="hometown" id="" class="form-control" value="{{$user->human->hometown}}" required>
                        <div class="invalid-feedback">
                            Trường này không được để trống
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Địa chỉ thường trú:</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <label style="font-weight: 400" for="">Thành phố:</label>
                                    <select style="flex: 1" class="form-control custom-select mx-2">
                                        <option value="">Hà Nội</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <label style="font-weight: 400" for="">Quận, huyện:</label>
                                    <select id="district-select" style="flex: 1" onchange="loadWards($(this).val())"  class="form-control mx-2 select2">
                                        @if (Auth::user()->role == 0)
                                            @foreach ($districts as $district)
                                                <option value="{{$district->id}}" {{$user->human->ward->district->id == $district->id ? 'selected' : ''}}>{{$district->name}}</option>
                                            @endforeach
                                        @else
                                            <option value="{{Auth::user()->human->ward->district->id}}">{{Auth::user()->human->ward->district->name}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <label style="font-weight: 400" for="">Phường, xã:</label>
                                    <select name="ward_id" style="flex: 1" id="ward-select" class="form-control mx-2 select2">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <label for="">Địa chỉ cụ thể: </label>
                        <input type="text" name="address" placeholder="Số nhà, đường, ..." class="form-control" value="{{$user->human->address}}" required>
                        <div class="invalid-feedback">
                            Trường này không được để trống
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Ảnh đại diện:</label>
                                <input type="file" name="avatar" onchange="load(this)" id="upload" class="form-control" >
                                <div class="invalid-feedback">
                                    Trường này không được để trống
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 avatar-preview">
                            <img src="{{asset('storage/avatars/'.$user->avatar)}}" width="60" alt="">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@push('js')
    <script>
        function load(input){
            $('.avatar-preview').html('');
            
            var reader = []
            var html = ""
            for (i = 0; i < input.files.length; i++){
                reader[i] = new FileReader()
                reader[i].onload = function(e){
                html = `<img src="${e.target.result}" alt="" class="file-upload-image" style="margin-right: 8px" width="60px">`
                    $('.avatar-preview').html(html);
                }
                reader[i].readAsDataURL(input.files[i]);
            }
            
        }

        $('.select2').select2({
            theme: 'bootstrap4'
        })

        function loadWards (id){
            var url = '/admin/district/' + id + '/wards'
            var userWard = {{$user->human->ward_id}}
            axios.get(url)
                .then((res) => {
                    var html = ''
                    res.data.forEach((ward) => {
                        html += `<option value="${ward.id}" ${ward.id == userWard ? 'selected' : ''}>${ward.name}</option>`
                    })
                    $('#ward-select').html(html)
                })
                .catch((res) => {
                    console.log(res);
                })
        }
        loadWards($('#district-select').val());

        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
                });
            }, false);
        })();
    </script>
    
@endpush