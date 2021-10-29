<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Application;
use PDF;
class AcceptApplication extends Mailable
{
    use Queueable, SerializesModels;
    public $application;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.accept_application')
                    ->subject("Đăng ký cấp giấy đi đường được phê duyệt")
                    ->attachFromStorageDisk('files', 'application'.$this->application->id.'.pdf');
    }
}
