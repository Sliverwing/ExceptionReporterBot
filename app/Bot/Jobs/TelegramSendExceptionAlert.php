<?php

namespace App\Bot\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramSendExceptionAlert implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user_id;
    protected $message;

    /**
     * TelegramSendExceptionAlert constructor.
     * @param $user_id
     * @param $message
     */
    public function __construct($user_id, $message)
    {
        $this->user_id = $user_id;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Telegram::sendMessage([
            'chat_id' => $this->user_id,
            'text' => "Ooops, there is something wrong! \n" . $this->message
        ]);
    }
}
