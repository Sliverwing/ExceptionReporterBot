<?php

namespace App\Http\Controllers;

use App\Bot\Jobs\TelegramSendExceptionAlert;
use Illuminate\Http\Request;
use App\Models\App as AppModel;
use App\Models\Exception as ExceptionModel;
use Illuminate\Support\Facades\Log;

class ReportReceiver extends Controller
{
    public function handler($token, Request $request)
    {
        $_idToken = explode(':', $token);
        $app = AppModel::where('token', $_idToken[1])->where('id', $_idToken[0])->first();
        if ($app === null) {
            abort(401);
        } else {
            $this->dispatch(new TelegramSendExceptionAlert($app->to_id, $request->input('message')));
            ExceptionModel::create([
                'app_id' => $app->id,
                'file' => $request->input('file'),
                'code' => $request->input('code'),
                'message' => $request->input('message'),
                'trace' => $request->input('trace'),
            ]);
        }
    }
}
