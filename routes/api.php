<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\PollController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/temp', [CreateNewUser::class, 'test']);
Route::get('/test', [CandidateController::class, 'list']);

//Routes for vote
Route::get('/candidate-list', [CandidateController::class, 'list']);
Route::post('/cast-vote', [ElectionController::class, 'store']);
Route::post('/cast-poll', [PollController::class, 'store']);
