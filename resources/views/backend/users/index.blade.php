@extends('backend.layouts.main')
@section('title')
    Quản lý cán bộ
@endsection
@section('content-title')
    Cán bộ
@endsection

@push('css')
    <style>
        .card-header::after{
            content: none;
        }
    </style>
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @if (Auth::user()->role == 0)
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="fas fa-city"></i></span>
            
                        <div class="info-box-content">
                            <span class="info-box-text">Cán bộ cấp quận, huyện</span>
                            <span class="info-box-number">{{$countUserByDistrict}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            @endif
            
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-building"></i></span>
        
                    <div class="info-box-content">
                        <span class="info-box-text">Cán bộ cấp xã, phường</span>
                        <span class="info-box-number">{{$countUserByWard}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title"><strong>Danh sách tài khoản</strong></div>
                <a href="{{url('/admin/users/create')}}" class="btn btn-primary">Thêm tài khoản mới</a>
            </div>
            <div class="card-body">
                <table class="table" id="account-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên tài khoản</th>
                            <th>Họ tên</th>
                            <th>Cấp quản lý</th>
                            <th>Đơn vị</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($users))
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->human->full_name}}</td>
                                    <td>{{$user->role_text}}</td>
                                    <td>{{$user->work_unit}}</td>
                                    <td>
                                        <a href="{{url('/admin/users/'.$user->id)}}" class="btn btn-primary">Chi tiết</a>
                                        <button class="btn btn-danger delete" data-user="{{$user->id}}">Xóa</button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                                <tr>
                                    <td colspan="6">Không có tài khoản nào</td>
                                </tr>
                        @endif
                        
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</section>
@endsection
@push('js')
    <script>
        $('.delete').click(function(){
            var url = '/admin/users'
            swal({
                title: "Bạn chắc chắn?",
                text: "Bạn chắc chắn muốn xóa thông tin người dùng này!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.delete(url, {data : {
                        id: $(this).data('user')
                    }})
                    .then((res) => {
                        swal("Xóa người dùng thành công!", {
                            icon: "success",
                        });
                        window.location.reload()
                    })
                    .catch((res)=>{
                        console.log(res);
                    })
                    
                } else {
                    swal("Hủy xóa người dùng thành công!");
                }
            });
        })
    </script>
@endpush