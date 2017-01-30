<?php

namespace App\Bot\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class NewAppCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "newapp";

    /**
     * @var string Command Description
     */
    protected $description = "Generate token for your app";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $this->replyWithMessage(['text' => 'Ok, We will generate an token for your app:']);

        // This will update the chat status to typing...
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        // Build the list
        $response = "Right Place!";

        // Reply with the commands list
        $this->replyWithMessage(['text' => $response]);
    }
}