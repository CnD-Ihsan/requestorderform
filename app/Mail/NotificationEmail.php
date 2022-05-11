<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\HTTP\Controllers\ROFController;
use Auth;
use PDF;

class NotificationEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdf = $this->data['pdf'];
        $rof_details = $this->data['details'];

        //make this dynamic
        //get data from sendEmail function in ROFController
        return $this->from(Auth::user()->email, Auth::user()->name)
                    ->subject('New ROF Request')
                    ->attachData($pdf->output(), 'test.pdf')
                    ->view('rof.mail.notification-email', ['mail_data' => $this->data]);
    }
}
