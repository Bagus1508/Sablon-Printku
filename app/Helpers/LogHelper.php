<?php

namespace App\Helpers;
use App\Models\LogHistory;
use Illuminate\Support\Facades\Auth;

class LogHelper
{
    public static function success($message){
        $status = 'Success';
        $user   = Auth::user()->name;
        return LogHistory::create(compact("user","status","message"));
    }
    public static function error($message){
        $status = 'Error';
        $user   = Auth::user()->name;

        // $split = explode("\n", $message);
        // if(count($split) > 1){
        //     $message = $split[0];
        // }

        return LogHistory::create(compact("user","status","message"));
    }
}
