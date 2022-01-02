<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $pwd;
    public $type;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $pwd, $type, $data)
    {
        $this->email = $email;
        $this->pwd = $pwd;
        $this->type = $type;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->type == 'register') {
            return $this->from('noreply@myintimity.vision-numerique.com')
                ->view('auth.emails.register')
                ->with('login', $this->email)
                ->with('pwd', $this->pwd)
                ->with('data', $this->data);
        }else{
            return $this->from('noreply@myintimity.vision-numerique.com')
                ->view('auth.emails.register')
                ->with('login', $this->email)
                ->with('pwd', $this->pwd)
                ->with('data', $this->data);
        }
    }
}
