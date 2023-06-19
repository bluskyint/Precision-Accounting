<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $newsletterData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($newsletterData)
    {
        $this->newsletterData = $newsletterData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.Newsletter')
        ->Subject($this->newsletterData['subject'])                               //  Subject mail
        // ->from( $this->newsletterData['email'] , $this->newsletterData['name'] )     // From 2 prame ( mail sender , name sender )
        ->with('newsletterData' , $this->newsletterData);                            // Send Data to mail blade

    }
}
