<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConsultingMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($consultingData)
    {
        $this->consultingData = $consultingData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.consulting')                               // Mail blade
        ->Subject($this->consultingData['subject'])                               //  Subject mail
        // ->from( $this->consultingData['email'] , $this->consultingData['first_name'] )     // From 2 prame ( mail sender , name sender )
        ->with('consultingData' , $this->consultingData);                            // Send Data to mail blade
    }
}
