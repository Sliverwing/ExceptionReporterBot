<?php

namespace App\Bot\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use App\Models\App as AppModel;

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
        // $this->replyWithChatAction(['action' => Actions::TYPING]);
        $user_id = $this->update->getMessage()->getFrom()->getId();

        $can_generate_token = AppModel::where('to_id', $user_id)->count() < 5 ? true : false;
        $is_dublicated = true;

        if (!$can_generate_token) {
            $response = 'Sorry, Your app count should less than 6, please delete some useless app';
        }

        while($can_generate_token && $is_dublicated) {
            $token = str_random(50);
            $is_dublicated = AppModel::where('token', 'like', '%' . $token)->count() === 0 ? false : true;
            if (!$is_dublicated) {
                $app = AppModel::create([
                    'to_id' => $user_id,
                    'token' => $token,
                ]);
                $response = 'Your Token is ' . $app->id . ':' .$token;
                break;
            }
        }

        $this->replyWithMessage(['text' => $response]);
    }
}