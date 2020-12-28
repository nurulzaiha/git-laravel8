<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Models\Training;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $training;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Training $training)
    {
        $this->training=$training;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //copy dr TrainingController
        Mail::to('nurulzaihazainal@gmail.com')->send(new \App\Mail\TrainingCreated($this->training));
        //
    }
}
