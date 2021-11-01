<p><strong>UBND {{$application->human->ward->name}} thông báo quyết định không thông qua đơn xin cấp giấy đi đường</strong></p>
<p>
    <strong>Chi tiết:</strong> <br>
    Mã đơn: {{$application->id}} <br>
    Người duyệt: {{$application->confirmHistory->account->human->full_name}} <br>
    Ngày duyệt: {{$application->confirmHistory->created_at}} <br>
    Người xin cấp giấy: {{$application->human->full_name}} <br>
    Lý do không được chấp thuận: {{$reason}}

</p>