<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
//kena instatiate kan
use App\Models\Training;

class TrainingCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $training;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    //passing sini parameter $training --$training=model
    public function __construct(Training $training)
    {
        $this->training = $training;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //guna facade utk link ke view
        return $this->view('email.training-mailable')
        //letak subjek
                    ->subject('training created email using mailable class');
    }
}
