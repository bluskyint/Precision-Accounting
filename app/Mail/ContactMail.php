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
    public function __construct($contactData)
    {
        $this->contactData = $contactData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact')                               // Mail blade
        ->Subject($this->contactData['subject'])                               //  Subject mail
        // ->from( $this->contactData['email'] , $this->contactData['name'] )     // From 2 prame ( mail sender , name sender )
        ->with('contactData' , $this->contactData);                            // Send Data to mail blade
    }
}
