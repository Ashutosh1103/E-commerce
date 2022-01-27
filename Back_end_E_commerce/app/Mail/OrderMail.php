<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
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
        // return $this->view('view.name');
        $data=$this->data;
        return $this->from('example@example.com', 'Example')
                ->view('Mail.OrderMail')->with([
                    'email' => $data['email'],
                    'product_name' => $data['product_name'],
                    'product_price'=>$data['product_price'],
                    'product_quantity'=>$data['product_quantity'],
                   'coupon_code'=>$data['coupon_code'],
                    'amount'=>$data['amount'],
                ]);
    }
}
