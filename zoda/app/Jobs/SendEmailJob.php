<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;


class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $title;
    protected $message;

    public function __construct($email, $title, $message)
    {
        $this->email = $email;
        $this->title = $title;
        $this->message = $message;
    }
    public function handle()
    {
         $data = [
            'title' => $this->title,
            'message' => $this->message,
        ];

        // Use Laravel's Mail facade to send the email
        Mail::send('emails.campaigns', $data, function ($message) {
            $message->to($this->email)
                    ->subject($this->title);
        });
    }
   
}
