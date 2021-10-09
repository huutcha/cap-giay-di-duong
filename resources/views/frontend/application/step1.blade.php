@extends('frontend.layouts.main')
@section('title')
    Đăng ký cấp giấy đi đường
@endsection
@section('content')
    <h1 class="text-center my-4">
        <strong>ĐĂNG KÝ CẤP GIẤY ĐI ĐƯỜNG</strong>
    </h1>
    <div class="step-menu d-flex">
        <div style="width:25%">
            <div class="step-item step-item1 active" style="z-index: 4">
                <h1 class="step-num"> <strong>01</strong></h1>
                <h4 class="step-title"> <strong>Chọn nơi bạn sinh sống</strong> </h4>
            </div>
        </div>
        <div style="width:25%">
            <div class="step-item step-item2" style="z-index: 3">
                <h1 class="step-num"> <strong>02</strong></h1>
                <h4 class="step-title"> <strong>Xác thực Email</strong> </h4>
            </div>
        </div>
        <div style="width:25%" >
            <div class="step-item step-item3" style="z-index: 2">
                <h1 class="step-num"> <strong>03</strong></h1>
                <h4 class="step-title"> <strong>Thông tin cá nhân</strong> </h4>
            </div>
        </div>
        <div style="width:25%" >
            <div class="step-item step-item4" style="z-index: 1">
                <h1 class="step-num"> <strong>04</strong></h1>
                <h4 class="step-title"> <strong>Lý do xin cấp giấy</strong> </h4>
            </div>
        </div>
    </div>
    {{-- STEP1 --}}
    {{-- STEP1 --}}
    {{-- STEP1 --}}
    <div class="content step1">
        <h1 class="content-title my-5">BƯỚC 1: CHỈ RA NƠI BẠN SINH SỐNG</h1>
        <div class="form-address mx-4" style="margin-bottom: 240px">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Thành phố, tỉnh:</label>
                        <select name="city" id="city" class="form-control" style=" height: 46px">
                            <option value="">--Chọn thành phố, tỉnh--</option>
                            <option value="1">Hà Nội</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Quận, huyện:</label>
                        <select name="district" id="district" class="form-control" style=" height: 46px" disabled >
                            <option value="">--Chọn quận, huyện--</option>
                            <option value="1">Bắc Từ Liêm</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Phường, xã:</label>
                        <select name="ward" id="ward" class="form-control" style=" height: 46px" disabled>
                            <option value="">--Chọn xã, phường--</option>
                            <option value="1">Thượng Cát</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-end mb-4">
            <button class="btn btn-success btn-lg" id="step1-next" disabled>Tiếp tục</button>
        </div>
    </div>
    {{-- STEP2 --}}
    {{-- STEP2 --}}
    {{-- STEP2 --}}
    <div class="content step2 d-none">
        <h1 class="content-title my-5">BƯỚC 2: XÁC THỰC EMAIL
            <span>Chúng tôi cần đúng email của bạn để gửi thông báo kết quả sớm nhất.</span>
        </h1>
        <div class="form-email mx-5" style="margin-bottom: 200px">
            <div class="form-group">
                <label for="">Nhập email của bạn:</label>
                <input type="text" name="email" id="email" class="form-control" style="width:500px; height: 46px">
                <button class="btn btn-primary mt-3 btn-lg" id="send-mail" disabled>Gửi mã</button>
            </div>
            <div class="form-group mt-4">
                <label for="">Mã xác nhận:</label>
                <input type="text" name="email-confirm" id="email-confirm" class="form-control" style="width:500px; height: 46px" disabled>
            </div>
        </div>
        <div class="text-end mb-4">
            <button class="btn btn-success btn-lg" id="step2-next" disabled>Tiếp tục</button>
        </div>
    </div>
    {{-- STEP3 --}}
    {{-- STEP3 --}}
    {{-- STEP3 --}}
    <div class="content step3 d-none">
        <h1 class="content-title my-5">BƯỚC 3: NHẬP THÔNG TIN CÁ NHÂN
            <span>Thông tin cá nhân cần chính xác, là thông tin của người xin cấp.</span>
        </h1>
        <div class="row">
            <div class="col-md-6">
                <div class="form-info mx-5" style="margin-bottom: 150px">
                    <div class="form-group">
                        <label for="">Họ và tên:</label>
                        <input type="text" name="fullname" id="" class="form-control" >
                    </div>
                    <div class="form-group mt-4">
                        <label for="">Số căn cước công dân:</label>
                        <input type="text" name="cccd" id="" class="form-control" >
                    </div>
                    <div class="form-group mt-4">
                        <label for="">Số điện thoại liên hệ:</label>
                        <input type="text" name="phone" id="" class="form-control" >
                    </div>
                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Giới tính:</label> <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" checked id="male" value="1">
                                    <label class="form-check-label" style="font-size: 18px" for="male">Nam</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="2">
                                    <label class="form-check-label" style="font-size: 18px" for="female">Nữ</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="other" value="3">
                                    <label class="form-check-label" style="font-size: 18px" for="other">Khác</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Ngày sinh:</label>
                                    <input type="date" name="dob" id="" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <label for="">Địa chỉ thường trú chi tiết:</label>
                        <input type="text" name="address" placeholder="Số nhà, hẻm, ngõ, ngách, ..." id="" class="form-control" >
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Hồ sơ minh chứng:
                        <span>*Bao gồm ảnh chụp CCCD(CMTND) hai mặt, Sổ hộ khẩu...</span>
                    </label>
                    <input type="file" name="proof-upload" id="proof-upload" class="form-control" multiple>
                    <div class="proof-img-container mt-4">

                    </div>
                </div>
            </div>
        </div>
        <div class="text-end mb-4">
            <button class="btn btn-success btn-lg" id="step3-next" disabled>Tiếp tục</button>
        </div>
    </div>
    {{-- STEP4 --}}
    {{-- STEP4 --}}
    {{-- STEP4 --}}
    <div class="content step4 d-none">
        <h1 class="content-title my-5">BƯỚC 4: LÝ DO XIN CẤP GIẤY ĐI ĐƯỜNG
            <span></span>
        </h1>
        <div class="form-reason mx-5" style="margin-bottom: 150px">
            <div class="form-group">
                <label for="">Lý do cấp giấy:</label>
                <select name="reason" id="" class="form-control" style="width:500px; height: 46px">
                    <option value="">--Chọn lí do--</option>
                    <option value="Đi làm">Đi làm</option>
                    <option value="Công nhân viên chức">Công nhân viên chức</option>
                    <option value="Đi học">Đi học</option>
                </select>
            </div>
            <div class="form-group mt-4">
                <label for="">Đơn vị công tác:</label>
                <input type="text" name="work-unit" id="" class="form-control" style="width:500px; height: 46px" >
            </div>
            <div class="form-group mt-4">
                <label for="">Số ngày xin cấp giấy:</label>
                <input type="text" name="quantity-day" id="" class="form-control" style="width:500px; height: 46px">
            </div>
            <div class="form-group mt-4">
                <label for="">Mô tả chi tiết lý do:</label>
                <textarea name="reason-decs" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
        </div>
        <div class="text-end mb-4">
            <button class="btn btn-success btn-lg" id="step4-next" disabled>Hoàn thành</button>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('#ward').change(function(){
            $('#step1-next').removeAttr('disabled')
        })
        $('.step1 .form-control').change(function(){
            if ($('#city').val()){
                $('#district').removeAttr('disabled')
                if($('#district').val()){
                    $('#ward').removeAttr('disabled')
                }
            }
        })
        $('#step1-next').click(function(){
            $('.step1').addClass('d-none')
            $('.step2').removeClass('d-none')
            $('.step-item1').removeClass('active')
            $('.step-item2').addClass('active')
        })
        $('.step2 #email').change(function(){
            if ($(this).val()){
                $('#send-mail').removeAttr('disabled')
            }
        })
        $('#send-mail').click(function(){
            $('#email-confirm').removeAttr('disabled')
        })
        $('.step2 #email-confirm').change(function(){
            if ($(this).val()){
                $('#step2-next').removeAttr('disabled')
            }
        })
        $('#step2-next').click(function(){
            $('.step2').addClass('d-none')
            $('.step3').removeClass('d-none')
            $('.step-item2').removeClass('active')
            $('.step-item3').addClass('active')
        })
        $('#proof-upload').change(function(){
            var reader = []
            var html = ""
            for (i = 0; i < this.files.length; i++){

                reader[i] = new FileReader()
                reader[i].onload = function(e){
                    html = `<img src="${e.target.result}" alt="" class="file-upload-image mb-2" style="margin-right: 8px" width="120px">`
                    $('.proof-img-container').append(html);
                }
                reader[i].readAsDataURL(this.files[i]);
            }
        })
        $('.step3 input.form-control').change(function(){
            var inputs = document.querySelectorAll('.step3 input.form-control')
            var validated = true
            inputs.forEach((input) => {
                if (!input.value){
                    validated = false
                }
            })
            if (validated){
                $('#step3-next').removeAttr('disabled')
            }
        })
        $('#step3-next').click(function(){
            $('.step3').addClass('d-none')
            $('.step4').removeClass('d-none')
            $('.step-item3').removeClass('active')
            $('.step-item4').addClass('active')
        })
        $('.step4 .form-control').change(function(){
            var inputs = document.querySelectorAll('.step4 .form-control')
            var validated = true
            inputs.forEach((input) => {
                if (!input.value){
                    validated = false
                }
            })
            if (validated){
                $('#step4-next').removeAttr('disabled')
            }
        })
        $('#step4-next').click(function(){
            swal("Thành công!", "Đơn xin cấp giấy của bạn đang chờ phê duyêt.", "success");
        })
    </script>
@endpush