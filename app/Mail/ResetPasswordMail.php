<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
<<<<<<< HEAD
    public $link, $email;
    public function __construct($link, $email)
    {
        //
        $this->link = $link;
        $this->email = $email;
=======
    public $link,$email;
    public function __construct($link, $email)
    {
        //
        $this->link=$link;
        $this->email=$email;
>>>>>>> 312342a01d678b565250d9485aa4c0d3f20d1c91
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Email khoi phuc mat khau Quizz")->view('mail.mail');
    }
}
