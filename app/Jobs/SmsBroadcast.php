<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SmsBroadcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $phoneNumber, $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($phoneNumber, $message)
    {
        $this->phoneNumber = $phoneNumber;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     * 
     */
    public function handle()
    {
        $msgencode = urlencode($this->message);
        $url = 'http://api.gosmsgateway.net/api/Send.php?username=ewseedid&mobile=' . $this->phoneNumber . '&message=' . $msgencode . '&password=gosms3929';
        $ch = \curl_init();
        \curl_setopt($ch, CURLOPT_URL, $url);
        \curl_setopt($ch, CURLOPT_POST, 0);
        \curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = \curl_exec($ch);
        $err = \curl_error($ch);  //if you need
        \curl_close($ch);
        return $response;
    }
}
