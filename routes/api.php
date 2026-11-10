<?php

use App\Http\Controllers\JdihnApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - JDIHN BPHN Kemenkumham RI Standard
|--------------------------------------------------------------------------
*/

Route::get('/jdihn', [JdihnApiController::class, 'index'])->name('api.jdihn.index');
Route::get('/jdihn/{id}', [JdihnApiController::class, 'show'])->name('api.jdihn.show');

