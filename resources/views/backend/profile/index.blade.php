@extends('backend.layouts.main')
@section('title')
Thông tin cá nhân
@endsection
@section('content-title')
    Hồ sơ
@endsection
@section('content')
    <!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{asset('assets/img/unnamed.png')}}" alt="User profile picture" />
                        </div>

                        <h3 class="profile-username text-center">{{Auth::user()->human->full_name}}</h3>

                        <p class="text-muted text-center">{{Auth::user()->role_text}}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item"><b>Đơn vị công tác</b> <br>
                                <i class="fas fa-university"></i>
                                <a>{{Auth::user()->work_unit}}</a>
                            </li>
                            <li class="list-group-item"><b>Liên hệ</b>
                                <ul style="list-style: none; padding:0">
                                    <li><i class="far fa-envelope"></i> Email: {{Auth::user()->email}}</li>
                                    <li><i class="fas fa-phone-alt"></i> SĐT: {{Auth::user()->human->phone}}</li>
                                </ul>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block"><b>FACEBOOK</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Thông tin chi tiết</a></li>
                            <li class="nav-item"><a class="nav-link" href="#activities" data-toggle="tab">Lịch sử hoạt động</a></li>
                            <li class="nav-item"><a class="nav-link" href="#change_password" data-toggle="tab">Đổi mật khẩu</a></li>
                        </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="profile">
                                <div class="text-right">
                                    <div class="btn btn-primary"><i class="far fa-edit"></i></div>
                                </div>
                                <form action="" class="mt-3">
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Họ, tên đệm</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" readonly id="" value="{{Auth::user()->human->fname}}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Tên</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" readonly id="" value="{{Auth::user()->human->lname}}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">CCCD(CMTND)</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" readonly value="{{Auth::user()->human->cccd}}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 row form-group align-items-center">
                                            <label for="" class="col-sm-4 col-form-label">Giới tính</label>
                                            <div class="col-sm-8">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" id="male"  value="Nam" {{Auth::user()->human->gender == "Nam" ? 'checked' : 'disabled'}}>
                                                    <label class="form-check-label" for="male">Nam</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" id="female"  value="Nữ" {{Auth::user()->human->gender == "Nữ" ? 'checked' : 'disabled'}}>
                                                    <label class="form-check-label" for="female">Nữ</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" id="other"  value="Khác" {{Auth::user()->human->gender == "Khác" ? 'checked' : 'disabled'}}>
                                                    <label class="form-check-label" for="other">Khác</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 row form-group">
                                            <label for="" class="col-sm-4 col-form-label">Ngày sinh</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" id="" readonly value="{{Auth::user()->human->dob}}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Quê quán</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" readonly value="{{Auth::user()->human->hometown}}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Thường trú</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" readonly value="{{Auth::user()->human->full_address}}" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="activities">
                                Chức năng đang phát triển
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="change_password">
                                <div class="" id="change_pass_form">
                                    <div class="alert alert-danger" id="error" style="display:none" role="alert"></div>
                                    <div class="form-group">
                                        <label for="">Mật khẩu của bạn:</label>
                                        <input type="password" class="form-control" id="old_password" name="old_password" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Mật khẩu mới:</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nhập lại mật khẩu:</label>
                                        <input type="password" class="form-control" id="re_new_password" name="re_new_password" />
                                    </div>
                                    
                                    <button class="btn btn-success">Lưu thay đổi</button>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

@push('js')
    <script>
        $('#change_pass_form button').click(function(){
            if (!$('#change_pass_form input').val()){
                $('#error').text("Không được để trống bất kỳ trường nào");
                $('#error').show();
            } else {
                axios.post('/admin/change-password', {
                    old_password: $('#old_password').val(),
                    new_password: $('#new_password').val(),
                    re_new_password: $('#re_new_password').val(),
                })
                    .then((res) => {
                        if (res.data == 1){
                            swal("Thành công!", "Đổi mật khẩu thành công.", "success");
                            $('#change_pass_form input').val('');
                        } else {
                            $('#error').text(res.data);
                            $('#error').show();
                        }
                    })
                    .catch((res) => {
                        console.log(res);
                    })
            }
            
        })
    </script>
@endpush