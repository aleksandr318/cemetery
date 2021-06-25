<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $content;
    public $subject;
    public $email;
    public $sender;

    public function __construct($message, $subject, $from, $fname)
    {
        $this->content = $message;
        $this->subject = $subject;
        $this->email = $from;
        $this->sender = $fname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contactemailview')->subject($this->subject)->from($this->email,$this->sender);
    }
}
