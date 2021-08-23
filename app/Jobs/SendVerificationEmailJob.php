<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendVerificationEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $randNo;
    protected $defaultName;
    protected $user;
    protected $defaultEmail;

    /**
     * Create a new job instance.
     *
     * @param $randNo
     * @param $defaultName
     * @param $user
     * @param $defaultEmail
     */
    public function __construct($randNo, $defaultName, $user, $defaultEmail)
    {
        $this->randNo = $randNo;
        $this->defaultName = $defaultName;
        $this->user = $user;
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
            $user = $this->user;
            $defaultEmail = $this->defaultEmail;
            $defaultName = $this->defaultName;
            Mail::send('email.email_verification', ['key' => $this->randNo, 'company' => $this->defaultName], function ($message) use ($user, $defaultEmail, $defaultName) {
                $message->to($user->email)->subject(__('Email Verification'))->from(
                    $defaultEmail, $defaultName
                );
            });
        }catch (\Exception $exception){
            Log::info($exception->getMessage());
        }
    }
}
