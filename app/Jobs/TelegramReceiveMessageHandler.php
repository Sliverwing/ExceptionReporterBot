<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use Telegram\Bot\Objects\Update;
use Telegram\Bot\Laravel\Facades\Telegram;


class TelegramReceiveMessageHandler implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;
    protected $update_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Update $update)
    {
        Telegram::commandsHandler(false);
        $this->message = $update['message'];
        $this->update_id = $update['update_id'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Cache::forever('latest_update_id', $this->update_id);
        var_dump($this->update_id);
    }
}
