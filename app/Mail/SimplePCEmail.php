<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SimplePCEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $text;
    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $subject, $text)
    {
       $this->user = $user;
       $this->subject = $subject;
       $this->text = $text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->from('rahul.sharma416@gmail.com')
                    ->view('emails.welcome');
    }
}
