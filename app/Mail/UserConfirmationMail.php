<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserConfirmationMail extends Mailable
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
                   ->subject('Thank You for Contacting Us')
                   ->view('emails.user_confirmation')
                   ->with([
                       'data' => $this->data,
                       'contact' => $contact,
                   ]);
    }
}