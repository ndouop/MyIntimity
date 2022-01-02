<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomMail extends Mailable
{
    use Queueable, SerializesModels;


    public $login;
    public $pwd;
    public $type;
    public $data;



    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($login, $pwd, $type, $data)
    {
        $this->login = $login;
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
            return $this->from(' noreply@intimity.smart-univers.com')
                ->view('auth.email.register');
        }else{
            return $this->from(' noreply@intimity.smart-univers.com')
                ->view('auth.email.register');
        }
    }
}
