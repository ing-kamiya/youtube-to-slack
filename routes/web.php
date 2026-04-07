<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;

Route::get('/youtube-slack-notify', [VideoController::class, 'notify']);