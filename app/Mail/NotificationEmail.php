<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\HTTP\Controllers\ROFController;
use Auth;
use PDF;
use Illuminate\Support\Facades\Storage;

class NotificationEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $data;
    protected $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $pdf)
    {
        //get data from sendEmail function in ROFController
        $this->data = $data;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdf = $this->pdf;
        $rof_details = $this->data['details'];
        $user = $this->data['user'];
        $subject = "[New] ROF Application";

        if($rof_details['status'] == "Rejected"){
            $subject = "[Rejected] ROF Application";
        }

        if($rof_details['status'] == "Approved"){
            return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                        ->subject($subject)
                        ->cc($user['email'])
                        ->attachData($pdf->output(), $rof_details['form_ref_no'].'.pdf')
                        ->view('rof.mail.notification-email', ['mail_data' => $this->data]);
        }
        
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->subject($subject)
                    ->attachData($pdf->output(), $rof_details['form_ref_no'].'.pdf')
                    ->view('rof.mail.notification-email', ['mail_data' => $this->data]);
    }
}
