@extends('backend.layouts.main')
@section('title')
    Quản lý đơn xin cấp giấy đi đường
@endsection
@section('content-title')
    Đơn xin
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        @if (count($applications))
        <div class="alert alert-warning alert-dismissible fade show" style="width: 50%" role="alert">
            Có {{count($applications)}} đơn mới cần phê duyệt
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        
        <div class="card">
            <div class="card-header">
                <strong>Danh sách đơn xin cấp giấy đi đường</strong>
            </div>
            <div class="card-body">
                <table class="table" id="applications-table">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Họ tên</th>
                            <th>Ngày tạo đơn</th>
                            <th>Lý do</th>
                            <th>Hạn xin cấp giấy</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (count($applications))
                        @foreach ($applications as $application)
                            <tr>
                                <td>{{$application->id}}</td>
                                <td>{{$application->human->full_name}}</td>
                                <td>{{$application->created_at}}</td>
                                <td>{{$application->reason}}</td>
                                <td>{{$application->duration}}</td>
                                <td>
                                    <a href="{{url('/admin/applications/'.$application->id)}}" class="btn btn-primary">Chi tiết</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td>Không có đơn xin cấp nào mới</td></tr>
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
    $(function () {
      $('#applications-table').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        order: [[2, 'desc']],
        "info": false,
        "autoWidth": true,
        "responsive": true,
      });
    });
</script>
@endpush