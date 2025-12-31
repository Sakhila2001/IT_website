<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $contact = \App\Models\ContactDetailModel::find(1);
    
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                   ->replyTo($this->data['email'], $this->data['name'])
                   ->subject('New Contact Form Submission: ' . $this->data['subject'])
                   ->view('emails.admin_contact')
                   ->with([
                       'data' => $this->data,
                       'contact' => $contact,
                   ]);
    }
}