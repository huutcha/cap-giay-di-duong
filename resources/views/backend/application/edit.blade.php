@extends('backend.layouts.main')
@section('title')
    Chi tiết đơn xin cấp giấy
@endsection
@section('content-title')
    Đơn xin / Chi tiết
@endsection
@push('css')
    <style>
        .card-body{
            font-size: 20px;
            line-height: 36px;
        }
        .card-body strong{
            margin-left: 8px;
        }
        .img-room{
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .img-room img{
            width: 660px;
        }
        .img-room .close{
            position: absolute;
            top: 4%;
            right: 4%;
            font-size: 28px;
            cursor: pointer;
        }
    </style>
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title" style="font-size: 24px">
                    <strong>Mã Đơn #{{$application->id}}</strong>
                    <span style="font-size: 18px"><i class="far fa-calendar-alt"></i> {{$application->created_at}}</span>
                    <a href="{{url('admin/applications/'.$application->id.'/pdf')}}" class="btn btn-primary">PDF</a>
                </div>
            </div>
            <div class="card-body">
                <table>
                    <tr>
                        <td><strong>Họ tên: </strong>{{$application->human->full_name}}</td>
                        <td><strong>Giới tính: </strong>{{$application->human->gender}}</td>
                    </tr>
                    <tr>
                        <td><strong>Ngày sinh: </strong>{{$application->human->dob}}</td>
                        <td><strong>Số căn cước công dân(CMTND): </strong>{{$application->human->cccd}}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>Quê quán: </strong>{{$application->human->hometown}}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>Hộ khẩu thường trú: </strong>{{$application->human->full_address}}</td>
                    </tr>
                    <tr>
                        <td><strong>Số điện thoại: </strong>{{$application->human->phone}}</td>
                        <td><strong>Email: </strong>{{$application->email}}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>Lý do xin cấp: </strong>{{$application->reason}}</td>
                    </tr>
                    <tr>
                        <td><strong>Cấp đến ngày: </strong>{{$application->duration}}</td>
                        <td><strong>Điểm đến: </strong>{{$application->organ->name}}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>Mô tả chi tiết lý do: </strong>{{$application->reason_desc}}</td>
                    </tr>
                </table>
                <p><strong>Hồ sơ minh chứng:</strong></p>
                <div class="verifies" style="margin-left: 8px">
                    @foreach ($application->human->verify as $verify)
                        <img src="{{asset('storage/verifies/'.$verify->path)}}" style="cursor: pointer" alt="" width="100px">
                    @endforeach
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-danger" id="cancel">Hủy đơn</button>
                <button class="btn btn-success" id="accept">Duyệt đơn</button>
            </div>
        </div>
    </div>
</section>
<div class="img-room">
    <img src="" alt="">
    <div class="close"><i class="fas fa-times"></i></div>
</div>

@endsection
@push('js')
    <script>
        $('.verifies img').click(function(){
            $('.img-room img').attr('src', $(this).attr('src'));
            $('.img-room').fadeIn()
        })
        $('.close').click(function(){
            $('.img-room').fadeOut()
        })
        $('#cancel').click(function(){
            var url = "/admin/applications/" + "{{$application->id}}"
            swal({
                title: "Bạn chắc chắn?",
                text: "Bạn chắc chắn hủy đơn xin cấp giấy này!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal({
                        text: 'Lý do đơn không được chấp thuận.',
                        content: "input",
                        button: {
                            text: "Xác nhận",
                            closeModal: false,
                        },
                    })
                    .then((reason)=>{
                        if (!reason) throw null;
                        axios.put(url, {state: 'cancel', reason: reason})
                        .then((res) => {
                            swal("Đơn xin cấp giấy đã bị hủy bỏ", {
                                icon: "success",
                            })
                            .then((val) => {
                                window.location.assign('/admin/applications')
                            })
                        })
                        .catch((res)=>{
                            console.log(res);
                        })
                    })
                } 
            });
        })
        $('#accept').click(function(){
            var url = "/admin/applications/" + "{{$application->id}}"
            $(this).text('Đang duyệt...')
            axios.put(url, {state: 'accept'})
                .then((res) => {
                    swal("Đơn xin cấp giấy đã được phê duyệt", {
                        icon: "success",
                    })
                    .then((val) => {
                        window.location.assign('/admin/applications')
                    })
                })
                .catch((res)=>{
                    console.log(res);
                })
        })
    </script>
@endpush