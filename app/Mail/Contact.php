<?php

namespace App\Mail;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->input = $request->all();

        if (empty($this->input['email'])) {
            $this->input['email'] = 'admin@site.ru';
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        $address = $this->input['email'];
        $name = $this->input['name'];
        $subject = "enstars.info - New Message from " . $this->input['name'];

        return $this->view('mail.contact')
            ->from($address, $name)
            ->replyTo($address, $name)
            ->subject($subject);

    }
}
