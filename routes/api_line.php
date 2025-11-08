<?php

use App\Http\Controllers\LineWebHookController;
use Illuminate\Support\Facades\Route;

Route::match(['GET', 'POST'], '/line/webhook', [LineWebHookController::class, 'handle']);
