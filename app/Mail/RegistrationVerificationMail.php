<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $verificationCode;


    /**
     * Create a new message instance.
     */
    public function __construct($verificationCode)
    {
        $this->verificationCode = $verificationCode;
    }

     /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Verify Your Registration')
                    ->view('emails.registration_verification')
                    ->with([
                        'verificationCode' => $this->verificationCode,
                    ]);
    }
}
