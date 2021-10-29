@extends('backend.layouts.main')
@section('title')
Lịch sử duyệt đơn
@endsection
@section('content-title')
    Lịch sử duyệt đơn
@endsection
@push('link-css')
    <link rel="stylesheet" href="{{asset('assets/css/unit.css')}}">
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title"><strong>Lịch sử duyệt đơn {{Auth::user()->work_unit}}</strong></div>
            </div>
            <div class="card-body">
                <table class="table" id="history-table">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Người tạo</th>
                            <th>Ngày tạo</th>
                            <th>Người duyệt</th>
                            <th>Ngày duyệt</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($histories as $history)
                            <tr>
                                <td>{{$history->application->id}}</td>
                                <td>{{$history->application->human->full_name}}</td>
                                <td>{{$history->application->created_at}}</td>
                                <td><a href="{{url('admin/users/'.$history->account->id.'/profile')}}">{{$history->account->human->full_name}}</a></td>
                                <td>{{$history->created_at}}</td>
                                <td><span @class([
                                    'badge',
                                    'badge-success' => $history->state == "accept",
                                    'badge-danger' => $history->state == "cancel",
                                ])>{{$history->state_text}}</span></td>
                                <td>
                                    <a href="{{url('admin/applications/'.$history->application->id.'/pdf')}}" class="btn btn-primary">Chi tiết</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td>Lịch sử trống</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
@push('js')
   <script>
       $('#history-table').DataTable();
    </script> 
@endpush