<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\App as AppModel;

class ReportReceiver extends Controller
{
    public function handler($token)
    {
        $app = AppModel::where('token', $token)->first();
        if ($app === null) {
            abort(401);
        } else {
            
        }
    }
}
