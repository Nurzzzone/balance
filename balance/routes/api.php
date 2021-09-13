<?php

use App\Http\Procedures\BalanceProcedure;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1/user/balance'], function () {
    Route::rpc('current', [BalanceProcedure::class]);
    Route::rpc('history', [BalanceProcedure::class]);
});

