@extends('backend.layouts.main')
@section('title')
Quản lý đơn vị
@endsection

@section('content-title')
    Đơn vị / {{Auth::user()->human->ward->district->name}}
@endsection
@push('link-css')
    <link rel="stylesheet" href="{{asset('assets/css/unit.css')}}">
@endpush
@push('css')
    <style>
        tr.unactive{
            color: rgb(119, 118, 118);
        }
        tr.active{
            color: black;
        }
        tr.unactive .btn-danger{
            display: none;
        }
        tr.active .btn-success{
            display: none;
        }
        .card-header::after{
            content: none;
        }
    </style>
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><strong>Danh sách phường, xã kích hoạt cấp giấy đi đường</strong></div>
                    </div>
                    <div class="card-body">
                        <table id="ward-table" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Phường, xã</th>
                                    <th>Kích hoạt</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wards as $ward)
                                    <tr class="{{$ward->active == 0 ? 'unactive' : 'active'}}">
                                        <td>{{$ward->id}}</td>
                                        <td class="col-name">{{$ward->name}}</td>
                                        <td class="col-active">{{$ward->active_text}}</td>
                                        <td>
                                            <button class="btn btn-success" onclick="active({{$ward->id}}, 'ward', $(this))"><i class="fas fa-plus"></i></button>
                                            <button class="btn btn-danger" onclick="unactive({{$ward->id}}, 'ward', $(this))"><i class="fas fa-minus"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="far fa-building"></i></span>
                
                    <div class="info-box-content" id="ward-info">
                        <span class="info-box-text">Phường, xã, thị trấn</span>
                        <span class="info-box-number">{{$countWardActive}}</span>
                
                        <div class="progress">
                            <div class="progress-bar" style="width: {{round(($countWardActive / $countWard) * 100)}}%;"></div>
                        </div>
                        <span class="progress-description">
                            {{round(($countWardActive / $countWard) * 100)}}% phường, xã, thị trấn đã kích hoạt cấp giấy đi đường
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->                
            </div>
        </div>
    </div>
</section>
@endsection
@push('js')
<script>
    $(function () {
      $('#ward-table').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        order: [[2, 'desc']],
        "info": false,
        "autoWidth": false,
        "responsive": true,
        "scrollY": 400,
      });
    });
</script>
<script>
    function active (id, type, node) {
        var url = '/admin/' + type;
        axios.put(url, {id: id, action: 'active'})
            .then((res) => {
                if (res.data) {
                    swal("Thành công", "Kích hoạt cấp giấy đi đường tại địa phương thành công!", "success")
                    // console.log(node.parent().siblings('.col-active'));
                    node.parent().siblings('.col-active').text("Đã kích hoạt");
                    if(type == 'district'){
                        node.parent().siblings('.col-name').attr({'style': 'cursor: pointer', 'onclick': 'loadWard(' + id + ', $(this))'})
                    }
                    node.parents('tr').addClass('active')
                    node.parents('tr').removeClass('unactive')
                    node.hide()
                    node.siblings('button').show()
                    loadQuantity(type)
                }
            })
            .catch((res) => {
                console.log(res);
            })
        
    }

    function unactive (id, type, node) {
        var url = '/admin/' + type;
        axios.put(url, {id: id, action: 'unactive'})
            .then((res) => {
                if (res.data) {
                    swal("Thành công", "Đã được hủy kích hoạt cấp giấy đi đường!", "success")
                    // console.log(node.parent().siblings('.col-active'));
                    node.parent().siblings('.col-active').text("Chưa kích hoạt");
                    if(type == 'district'){
                        node.parent().siblings('.col-name').removeAttr('style')
                        node.parent().siblings('.col-name').removeAttr('onclick')
                    }
                    node.parents('tr').removeClass('active')
                    node.parents('tr').addClass('unactive')
                    node.hide()
                    node.siblings('button').show()
                    $('#ward-card').html('');
                }
            })
            .catch((res) => {
                console.log(res);
            })
        
    }
</script>
@endpush