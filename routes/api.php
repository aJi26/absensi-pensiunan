<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::post('/login', [ApiController::class, 'login']);
Route::post('/scan-store', [ApiController::class, 'storeScan']);
Route::get('/riwayat/{id}', [ApiController::class, 'getRiwayat']);