<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        //
        $this->data=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        $data=$this->data;
        return $this->from('example@example.com', 'Example')
                ->view('Mail.ContactMail')->with([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone'=>$data['phone'],
                    'message'=>$data['message']
                ]);
    }
}
