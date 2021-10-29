<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\ConfirmHistory;
use App\Mail\CancelApplication;
use App\Mail\AcceptApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PDF;

class ApplicationAdminController extends Controller
{
    public function index (){
        $humans = Auth::user()->human->ward->human->where('account_id', null);
        $applications = collect();
        foreach($humans as $human){
            foreach($human->application as $application){
                if(!$application->confirmHistory){
                    $applications->push($application);
                }
            }
            // $applications = $applications->merge($human->application);
        }
        // dd($applications);
        return view('backend.application.index', compact('applications'));
    }

    public function edit ($id) {
        $application = Application::find($id);
        return view('backend.application.edit', compact('application'));
    }

    public function update ($id, Request $request) {
        $application = Application::find($id);
        ConfirmHistory::create([
            'account_id' => Auth::user()->id,
            'application_id' => $id,
            'state' => $request->input('state'),
        ]);
        if($request->input('state') == 'cancel'){
            // return (new CancelApplication($application, $request->input('reason')))->render();
            Mail::to($application->email)->send(new CancelApplication($application, $request->input('reason')));
        }
        if($request->input('state') == 'accept'){
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($this->renderPDF($application));

            $pdf->save(storage_path('app\public\files\application'.$id.'.pdf'));
            Mail::to($application->email)->send(new AcceptApplication($application));
        }
        
        return 1;
    }
    public function renderPDF(Application $application){
        $fontpathRegu = storage_path('fonts\TIMES.TTF');
        $fontpathBold = storage_path('fonts\TIMESBD.TTF');
        $fontpathItalic = storage_path('fonts\TIMESI.TTF');
        // dd($fontpathBold);
        
        return  $html = "
            <style>
                
                @font-face {
                    font-family: 'TimesNewRegu';
                    font-style: normal;
                    font-weight: 400;
                    src: url('$fontpathRegu') format('truetype');
                }
                @font-face {
                    font-family: 'TimesNewBold';
                    font-style: normal;
                    font-weight: 700;
                    src: url('$fontpathBold') format('truetype');
                }
                @font-face {
                    font-family: 'TimesNewItalic';
                    font-style: italic;
                    src: url('$fontpathItalic') format('truetype');
                }
                
                body{
                    font-family: TimesNewRegu;
                }
                strong{
                    font-family: TimesNewBold;
                }
                i{
                    font-family: TimesNewItalic;
                }
                p,h2{
                    margin: 0
                }
            </style>
            <table>
            
            <tr>
                <td style='width: 300px'><strong><center>ỦY BAN NHÂN DÂN</center></strong></td>
                <td><strong><center>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</center></strong></td>
            </tr>
            <tr>
                <td><strong><center>XÃ/PHƯỜNG: ".$application->human->ward->name."</center></strong></td>
                <td><strong><center>Độc lập - Tự do - Hạnh phúc</center></strong></td>
            </tr>
            <tr>
                <td><center>Số: ".$application->id."</center></td>
                <td><center>Hà Nội, ngày ".date("d",time())." tháng ".date("m",time())." năm ".date("Y",time())."</center></td>
            </tr>
        </table>
        <h2 style='margin-top: 30px'><strong><center>GIẤY ĐI ĐƯỜNG</center></strong></h2>
        <p style='margin-bottom: 30px'><strong><center>Về việc tham gia giao thông trong thời gian giãn cách</center></strong></p>
        <div style='margin: 0 50px'>
            <table>
                <tr>
                    <td><strong>1. Họ tên: </strong>".$application->human->full_name."</td>
                    <td><strong>Giới tính: </strong>".$application->human->gender."</td>
                </tr>
                <tr>
                    <td><strong>2. Ngày sinh: </strong>".date_format(date_create($application->human->dob), "d/m/Y")."</td>
                    <td><strong>Số căn cước công dân(CMTND): </strong>".$application->human->cccd."</td>
                </tr>
                <tr>
                    <td colspan='2'><strong>3. Quê quán: </strong>".$application->human->hometown."</td>
                </tr>
                <tr>
                    <td colspan='2'><strong>4. Hộ khẩu thường trú: </strong>".$application->human->full_address."</td>
                </tr>
                <tr>
                    <td><strong>5. Số điện thoại: </strong>".$application->human->phone."</td>
                    <td><strong>Email: </strong>".$application->email."</td>
                </tr>
                <tr>
                    <td><strong>6. Nơi làm việc: </strong>".$application->organ->name."</td>
                    <td><strong>Thời gian xin cấp: </strong>".date_format(date_create($application->duration), "d/m/Y")."</td>
                </tr>
                <tr>
                    <td colspan='2'><strong>7.Địa chỉ cơ quan: </strong>".$application->organ->full_address."</td>
                </tr>
            </table>
            <p style='text-align: justify; margin: 10px 0'>Mục đích tham gia giao thông: ".$application->reason." hiện đang trên đường di chuyển từ nhà đến nơi làm việc (hoặc ngược lại) 
                để thực hiện công việc chuyên môn được giao. <br>
                Giấy đi đường có hiệu lực từ ngày ký, chỉ có hiệu lực trong thời gian giãn cách xã hội. <br>
                Công ty/Người lao động cam đoan những nội dung nêu trên đúng sự thật, chịu hoàn toàn trách nhiệm trước pháp luật
                về việc chấp hành nghiêm quy định về phòng, chống dịch Covid-19 và chỉ thị số 17/CT-UBND ngày 23/07/2021 của UBND Thành phố. <br>
                <i>(Xuất trình kèm theo Căn cước công dân/Chứng minh nhân dân; Văn bản của công ty, đơn vị sử dụng lao động)</i>
            </p>
            
            
            <table>
                <tr>
                    <td style='width: 300px'>LƯU Ý:</td>
                    <td><strong><center>T.M ỦY BAN NHÂN DÂN XÃ</center></strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td><strong><center>CHỦ TỊCH</center></strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td><strong><center>(Hoặc xác nhận của cơ quan đơn vị)</center></strong></td>
                </tr>
            </table>
        </div>
            ";
    }
    public function pdf($id){
        $application = Application::find($id);
        // PDF::setOptions(['defaultFont' => 'sans-serif']);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->renderPDF($application));

        // $pdf->save(storage_path('app\files\application'.$id.'.pdf'));
        return $pdf->stream();
        // return view('test', compact('application'));
    }
}
