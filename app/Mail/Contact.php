<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


use App\Message;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        //save the message
        $m = new Message;
        $m->name = $request->name;
        $m->email = $request->email;
        $m->message = $request->message;
        $m->submitted_by = $submitted_by;
        $m->updated_by = 0;
        $m->save();         



    $address = 'ignore@batcave.io';
    $name = 'Ignore Me';
    $subject = 'Krytonite Found';

    return $this->view('mail.contact')
                ->from($address, $name)
                ->cc($address, $name)
                ->bcc($address, $name)
                ->replyTo($address, $name)
                ->subject($subject);

    }
}
