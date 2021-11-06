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
                            <img class="profile-user-img img-fluid img-circle" src="{{asset('storage/avatars/'.$user->avatar)}}" alt="User profile picture" />
                        </div>

                        <h3 class="profile-username text-center">{{$user->human->full_name}}</h3>

                        <p class="text-muted text-center">{{$user->role_text}}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item"><b>Đơn vị công tác</b> <br>
                                <i class="fas fa-university"></i>
                                <a>{{$user->work_unit}}</a>
                            </li>
                            <li class="list-group-item"><b>Liên hệ</b>
                                <ul style="list-style: none; padding:0">
                                    <li><i class="far fa-envelope"></i> Email: {{$user->email}}</li>
                                    <li><i class="fas fa-phone-alt"></i> SĐT: {{$user->human->phone}}</li>
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
                        </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="profile">
                                {{-- <div class="text-right">
                                    <div class="btn btn-primary"><i class="far fa-edit"></i></div>
                                </div> --}}
                                <form action="" class="mt-3">
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Họ, tên đệm</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" readonly id="" value="{{$user->human->fname}}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Tên</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" readonly id="" value="{{$user->human->lname}}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">CCCD(CMTND)</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" readonly value="{{$user->human->cccd}}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 row form-group align-items-center">
                                            <label for="" class="col-sm-4 col-form-label">Giới tính</label>
                                            <div class="col-sm-8">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" id="male"  value="Nam" {{$user->human->gender == "Nam" ? 'checked' : 'disabled'}}>
                                                    <label class="form-check-label" for="male">Nam</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" id="female"  value="Nữ" {{$user->human->gender == "Nữ" ? 'checked' : 'disabled'}}>
                                                    <label class="form-check-label" for="female">Nữ</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" id="other"  value="Khác" {{$user->human->gender == "Khác" ? 'checked' : 'disabled'}}>
                                                    <label class="form-check-label" for="other">Khác</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 row form-group">
                                            <label for="" class="col-sm-4 col-form-label">Ngày sinh</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" id="" readonly value="{{$user->human->dob}}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Quê quán</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" readonly value="{{$user->human->hometown}}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Thường trú</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" readonly value="{{$user->human->full_address}}" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="activities">
                                Chức năng đang phát triển
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
