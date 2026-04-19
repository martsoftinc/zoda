<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;   
    public $token;  


    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }
    public function build()
    {
        return $this->view('emails.passwordreset')
                    ->subject('Reset Your Password')
                    ->with(['user' => $this->user, 'token' => $this->token]);
    }
    
}
