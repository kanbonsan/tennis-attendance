<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::post('/line/webhook', function (Request $req) {
    Log::info('LINE webhook ping', ['body' => $req->getContent()]);
    // 200 を返せば Verify は通ります
    return response('OK', 200);
});
