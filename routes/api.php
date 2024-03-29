<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\AttendanceController;

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
Route::get('/count', [UserController::class, 'getCountStatistics']);
Route::get('/count-poll', [PollController::class, 'getCountStatistics']);
Route::get('/result', [ElectionController::class, 'getResults']);
Route::post('/cast-vote', [ElectionController::class, 'store']);
Route::post('/cast-poll', [PollController::class, 'store']);
Route::get('/member-list', [UserController::class, 'getRegisteredUsers']);
Route::post('/can-vote/{id}', [UserController::class, 'validateCanVote']);
Route::post('/cannot-vote/{id}', [UserController::class, 'validateCannotVote']);
Route::post('/start-election', [UserController::class, 'updateElectionStatus1']);
Route::post('/end-election', [UserController::class, 'updateElectionStatus2']);

Route::post('/start-registration', [UserController::class, 'updateElectionStatus1']);
Route::post('/end-registration', [UserController::class, 'updateElectionStatus2']);
Route::post('/show-participants', [AttendanceController::class, 'getAttendanceUsers']);

Route::post('/check-in',[AttendanceController::class, 'check_in']);
Route::post('/time-in',[AttendanceController::class, 'time_in']);