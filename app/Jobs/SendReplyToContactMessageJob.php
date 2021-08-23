<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendReplyToContactMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;
    protected $email;
    protected $defaultName;
    protected $reply;
    protected $defaultEmail;

    /**
     * Create a new job instance.
     *
     * @param $message
     * @param $defaultName
     * @param $reply
     * @param $defaultEmail
     */
    public function __construct($defaultName, $defaultEmail, $message, $reply)
    {
        $this->email = $message['email'];
        $this->message = $message['message'];
        $this->defaultName = $defaultName;
        $this->reply = $reply;
        $this->defaultEmail = $defaultEmail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Mail::send('email.contact_reply', ['contactMessage' => $this->message, 'reply' => $this->reply, 'company' => $this->defaultName], function ($message) {
                $message->to($this->email)->subject(__('Reply'))->from(
                    $this->defaultEmail, $this->defaultName
                );
            });
        }catch (\Exception $exception){
            Log::info($exception->getMessage());
        }
    }
}
