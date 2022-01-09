<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendErrorMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $msg;
    public $error;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($error, $message)
    {
        $this->msg = $message;
        $this->error = $error;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Warning: new error created!')->view('emails.error');
    }
}
