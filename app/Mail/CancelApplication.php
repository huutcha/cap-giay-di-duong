<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Application;
class CancelApplication extends Mailable
{
    use Queueable, SerializesModels;
    protected $application;
    protected $reason;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Application $application, $reason)
    {
        $this->application = $application;
        $this->reason = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.cancel_application')
                    ->subject("Đăng ký cấp giấy đi đường bị từ chối")
                    ->with([
                        'application' => $this->application,
                        'reason' => $this->reason,
                    ]);
    }
}
