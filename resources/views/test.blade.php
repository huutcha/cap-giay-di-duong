<div style="width:700px; font-size: 20px;">
    <table>
        <tr>
            <td><strong></strong></td>
            <td><strong>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong></td>
        </tr>
        <tr>
            <td><strong>XÃ/PHƯỜNG: {{$application->human->ward->name}}</strong></td>
            <td><strong>Độc lập - Tự do - Hạnh phúc</strong></td>
        </tr>
        <tr>
            <td>Số: {{$application->id}}</td>
            <td>Hà Nội, ngày {{date_format($application->confirmHistory->created_at, "d")}} tháng {{date_format($application->confirmHistory->created_at, "m")}} năm {{date_format($application->confirmHistory->created_at, "Y")}}</td>
        </tr>
    </table>
    <h2><strong>GIẤY ĐI ĐƯỜNG</strong></h2>
    <p><strong>Về việc tham gia giao thông trong thời gian giãn cách</strong></p>
    <table>
        <tr>
            <td><strong>1. Họ tên: </strong>{{$application->human->full_name}}</td>
            <td><strong>Giới tính: </strong>{{$application->human->gender}}</td>
        </tr>
        <tr>
            <td><strong>2. Ngày sinh: </strong>{{date_format(date_create($application->human->dob), "d/m/Y")}}</td>
            <td><strong>Số căn cước công dân(CMTND): </strong>{{$application->human->cccd}}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>3. Quê quán: </strong>{{$application->human->hometown}}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>4. Hộ khẩu thường trú: </strong>{{$application->human->full_address}}</td>
        </tr>
        <tr>
            <td><strong>5. Số điện thoại: </strong>{{$application->human->phone}}</td>
            <td><strong>Email: </strong>{{$application->email}}</td>
        </tr>
        <tr>
            <td><strong>6. Nơi làm việc: </strong>{{$application->organ->name}}</td>
            <td><strong>Thời gian xin cấp đến ngày: </strong>{{$application->duration}}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>7.Địa chỉ cơ quan: </strong>{{$application->organ->full_address}}</td>
        </tr>
    </table>
    <p>Mục đích tham gia giao thông: {{$application->reason}} hiện đang trên đường di chuyển từ nhà đến nơi làm việc(hoặc ngược lại) 
        để thực hiện công việc chuyên môn được giao.
    </p>
    <p>Giấy đi đường có hiệu lực từ ngày ký, chỉ có hiệu lực trong thời gian giãn cách xã hội.</p>
    <p>Công ty/Người lao động cam đoan những nội dung nêu trên đúng sự thật, chịu hoàn toàn trách nhiệm trước pháp luật
        về việc chấp hành nghiêm quy định về phòng, chống dịch Covid-19 và chỉ thị số 17/CT-UBND ngày 23/07/2021 của UBND Thành phố.
    </p>
    <i>(Xuất trình kèm theo Căn cước công dân/Chứng minh nhân dân; Văn bản của công ty, đơn vị sử dụng lao động)</i>
    <table>
        <tr>
            <td></td>
            <td><strong>T.M ỦY BAN NHÂN DÂN XÃ</strong></td>
        </tr>
        <tr>
            <td></td>
            <td><strong>CHỦ TỊCH</strong></td>
        </tr>
        <tr>
            <td></td>
            <td><strong>(Hoặc xác nhận của cơ quan đơn vị)</strong></td>
        </tr>
    </table>
</div>