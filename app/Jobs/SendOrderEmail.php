<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;

use App\Mail\CallOrderMail;

class SendOrderEmail implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    /**
     * Số lần job sẽ thử thực hiện lại
     *
     * @var int
     */
    public $tries = 3;
    public $timeout = 3;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        sleep(3);
        echo 'Start send email';
        $email = new CallOrderMail($this->order);
        Mail::to($this->order->email)->send($email);
        echo 'End send email';
    }
}
