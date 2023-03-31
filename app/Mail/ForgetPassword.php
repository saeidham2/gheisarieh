<?php

namespace App\Mail;

use App\Models\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $code;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code)
    {
        $this->code =  $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $code = $this->code;
        return $this->view('emails.password.forget-password',compact('code'));
    }
}
