<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Jobs\TelegramReceiveMessageHandler;

class TelegramGetUpdates extends Command
{
   
    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:getupdates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Updates From Telegram';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        while(true){
            $update_id = Cache::get('latest_update_id');
            $updates = Telegram::getUpdates([
                'offset' => $update_id,
            ]);
            foreach($updates as $update){
                $this->dispatch(new TelegramReceiveMessageHandler($update));
            }
            sleep(1);
        }
    }
}
