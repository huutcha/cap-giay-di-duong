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
                <td style='width: 300px'><strong><center>???Y BAN NH??N D??N</center></strong></td>
                <td><strong><center>C???NG H??A X?? H???I CH??? NGH??A VI???T NAM</center></strong></td>
            </tr>
            <tr>
                <td><strong><center>X??/PH?????NG: ".$application->human->ward->name."</center></strong></td>
                <td><strong><center>?????c l???p - T??? do - H???nh ph??c</center></strong></td>
            </tr>
            <tr>
                <td><center>S???: ".$application->id."</center></td>
                <td><center>H?? N???i, ng??y ".date("d",time())." th??ng ".date("m",time())." n??m ".date("Y",time())."</center></td>
            </tr>
        </table>
        <h2 style='margin-top: 30px'><strong><center>GI???Y ??I ???????NG</center></strong></h2>
        <p style='margin-bottom: 30px'><strong><center>V??? vi???c tham gia giao th??ng trong th???i gian gi??n c??ch</center></strong></p>
        <div style='margin: 0 50px'>
            <table>
                <tr>
                    <td><strong>1. H??? t??n: </strong>".$application->human->full_name."</td>
                    <td><strong>Gi???i t??nh: </strong>".$application->human->gender."</td>
                </tr>
                <tr>
                    <td><strong>2. Ng??y sinh: </strong>".date_format(date_create($application->human->dob), "d/m/Y")."</td>
                    <td><strong>S??? c??n c?????c c??ng d??n(CMTND): </strong>".$application->human->cccd."</td>
                </tr>
                <tr>
                    <td colspan='2'><strong>3. Qu?? qu??n: </strong>".$application->human->hometown."</td>
                </tr>
                <tr>
                    <td colspan='2'><strong>4. H??? kh???u th?????ng tr??: </strong>".$application->human->full_address."</td>
                </tr>
                <tr>
                    <td><strong>5. S??? ??i???n tho???i: </strong>".$application->human->phone."</td>
                    <td><strong>Email: </strong>".$application->email."</td>
                </tr>
                <tr>
                    <td><strong>6. N??i l??m vi???c: </strong>".$application->organ->name."</td>
                    <td><strong>Th???i gian xin c???p: </strong>".date_format(date_create($application->duration), "d/m/Y")."</td>
                </tr>
                <tr>
                    <td colspan='2'><strong>7.?????a ch??? c?? quan: </strong>".$application->organ->full_address."</td>
                </tr>
            </table>
            <p style='text-align: justify; margin: 10px 0'>M???c ????ch tham gia giao th??ng: ".$application->reason." hi???n ??ang tr??n ???????ng di chuy???n t??? nh?? ?????n n??i l??m vi???c (ho???c ng?????c l???i) 
                ????? th???c hi???n c??ng vi???c chuy??n m??n ???????c giao. <br>
                Gi???y ??i ???????ng c?? hi???u l???c t??? ng??y k??, ch??? c?? hi???u l???c trong th???i gian gi??n c??ch x?? h???i. <br>
                C??ng ty/Ng?????i lao ?????ng cam ??oan nh???ng n???i dung n??u tr??n ????ng s??? th???t, ch???u ho??n to??n tr??ch nhi???m tr?????c ph??p lu???t
                v??? vi???c ch???p h??nh nghi??m quy ?????nh v??? ph??ng, ch???ng d???ch Covid-19 v?? ch??? th??? s??? 17/CT-UBND ng??y 23/07/2021 c???a UBND Th??nh ph???. <br>
                <i>(Xu???t tr??nh k??m theo C??n c?????c c??ng d??n/Ch???ng minh nh??n d??n; V??n b???n c???a c??ng ty, ????n v??? s??? d???ng lao ?????ng)</i>
            </p>
            
            
            <table>
                <tr>
                    <td style='width: 300px'>L??U ??:</td>
                    <td><strong><center>T.M ???Y BAN NH??N D??N X??</center></strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td><strong><center>CH??? T???CH</center></strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td><strong><center>(Ho???c x??c nh???n c???a c?? quan ????n v???)</center></strong></td>
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
