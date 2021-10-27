@extends('backend.layouts.main')
@section('title')
    Thêm tài khoản mới
@endsection
@section('content-title')
    Cán bộ / Thêm mới
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
            <div class="bs-stepper">
                <div class="bs-stepper-header" role="tablist">
                    <!-- your steps here -->
                    <div class="step" data-target="#logins-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                            <span class="bs-stepper-circle">1</span>
                            <span class="bs-stepper-label">Tài khoản</span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#information-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                            <span class="bs-stepper-circle">2</span>
                            <span class="bs-stepper-label">Thông tin cá nhân</span>
                        </button>
                    </div>
                </div>
                <div class="bs-stepper-content">
                    <!-- your steps content here -->
                    <form action="{{url('/admin/users')}}" class="needs-validation" novalidate enctype="multipart/form-data" method="post">
                        @csrf
                        <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                            <div class="form-group">
                                <label for="">Tên đăng nhập:</label>
                                <input type="text" name="username" oninput="validate()" class="form-control" required>
                                <div class="invalid-feedback">
                                    Trường này không được để trống
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Mật khẩu:</label>
                                <input type="password" name="password" oninput="validate()" class="form-control" required>
                                <div class="invalid-feedback">
                                    Trường này không được để trống
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Cấp chức vụ:</label>
                                <select name="role" id="" class="form-control">
                                    <option value="1" {{Auth::user()->role == 0 ? '' : 'disabled'}}>Quận, huyện</option>
                                    <option value="2">Phường, xã, thị trấn</option>
                                </select>
                            </div>
                            <span class="btn btn-primary disabled" id="next-btn" >Tiếp tục</span>
                        </div>
                        <div id="information-part" class="content p-3" role="tabpanel" aria-labelledby="information-part-trigger">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Họ:</label>
                                    <input type="text" name="fname" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Trường này không được để trống
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Tên:</label>
                                    <input type="text" name="lname" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Trường này không được để trống
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Căn cước công dân(CMTND):</label>
                                <input type="text" name="cccd" class="form-control" required>
                                <div class="invalid-feedback">
                                    Trường này không được để trống
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Email:</label>
                                <input type="text" name="email" class="form-control" required>
                                <div class="invalid-feedback">
                                    Trường này không được để trống
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Số điện thoại:</label>
                                <input type="text" name="phone" class="form-control" required>
                                <div class="invalid-feedback">
                                    Trường này không được để trống
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 form-group align-items-center">
                                    <label for="" class="col-form-label">Giới tính:</label>
                                    <div class="">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="male"  value="Nam" checked>
                                            <label class="form-check-label" for="male">Nam</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="female"  value="Nữ" >
                                            <label class="form-check-label" for="female">Nữ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="other"  value="Khác" >
                                            <label class="form-check-label" for="other">Khác</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="" class=" col-form-label">Ngày sinh:</label>
                                    <div class="">
                                        <input type="date" name="dob" class="form-control" required />
                                        <div class="invalid-feedback">
                                            Trường này không được để trống
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Quê quán:</label>
                                <input type="text" name="hometown" id="" class="form-control" required>
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
                                                        <option value="{{$district->id}}">{{$district->name}}</option>
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
                                <input type="text" name="address" placeholder="Số nhà, đường, ..." class="form-control" required>
                                <div class="invalid-feedback">
                                    Trường này không được để trống
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Ảnh đại diện:</label>
                                        <input type="file" name="avatar" onchange="load(this)" id="upload" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Trường này không được để trống
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 avatar-preview">

                                </div>
                            </div>
                            <span class="btn btn-secondary" onclick="stepper.previous()">Trở về</span>
                            <button type="submit" class="btn btn-success">Tạo mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('link-js')
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
@endpush
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })

        function load(input){
            $('.avatar-preview').html('');
            
            var reader = []
            var html = ""
            for (i = 0; i < input.files.length; i++){
                reader[i] = new FileReader()
                reader[i].onload = function(e){
                html = `<img src="${e.target.result}" alt="" class="file-upload-image" style="margin-right: 8px" width="60px">`
                    $('.avatar-preview').append(html);
                }
                reader[i].readAsDataURL(input.files[i]);
            }
            
        }

        $('.select2').select2({
            theme: 'bootstrap4'
        })

        function loadWards (id){
            var url = '/admin/district/' + id + '/wards'
            axios.get(url)
                .then((res) => {
                    var html = ''
                    res.data.forEach((ward) => {
                        html += `<option value="${ward.id}">${ward.name}</option>`
                    })
                    $('#ward-select').html(html)
                })
                .catch((res) => {
                    console.log(res);
                })
        }
        loadWards($('#district-select').val());
        
        function validate(){
            if ($('input[name="username"]').val() && !$('input[name="username"]').hasClass('is-invalid') && $('input[name="password"]').val()){
                $('#next-btn').removeClass('disabled')
                $('#next-btn').attr('onclick', "stepper.next()")
            } else {
                $('#next-btn').addClass('disabled')
                $('#next-btn').removeAttr('onclick')
            }

        }
        


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


        $('input[name="username"]').blur(function(){
            axios.post('/admin/check-username-existed', {username: $(this).val()})
                .then ((res) =>{
                    if (!res.data){
                        $(this).siblings('.invalid-feedback').text('Tài khoản đã tồn tại')
                        $(this).addClass('is-invalid');
                        validate()
                    } else {
                        $(this).siblings('.invalid-feedback').text('Trường này không được để trống')
                        $(this).removeClass('is-invalid');
                        validate()
                    }
                })
                .catch((res) => {

                })
        })
    </script>
    
@endpush