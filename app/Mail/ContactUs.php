<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    protected $request;

    public function __construct($request)
    {
        $this->request  = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->request;

        $address = 'webmaster@stg.drsalmean.com';
        $subject = 'contact us e-mail - Dr. Salmean';
        $name    = $data['name'];

        return $this->markdown('emails.contactUs')
                    ->from($address, $name)
                    ->cc($address, $name)
                    ->subject($subject)
                    ->with(['data' => $data]);
    }
}