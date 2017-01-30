<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use Telegram\Bot\Objects\Update;


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
        var_dump($this->message);
        var_dump($this->update_id);
    }
}
