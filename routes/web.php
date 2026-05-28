<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TicketController;
use App\Http\Controllers\BulkSmsController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\SenderIdController;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard-ui', [DashboardController::class, 'index']);

    /*
    |--------------------------------------------------------------------------
    | Deposit
    |--------------------------------------------------------------------------
    */

    Route::get('/deposit', [DepositController::class, 'index']);

    Route::post('/deposit', [DepositController::class, 'store']);

    Route::get('/deposit-history', [DepositController::class, 'history']);

    /*
    |--------------------------------------------------------------------------
    | Sender IDs
    |--------------------------------------------------------------------------
    */

    Route::get('/senderids', [SenderIdController::class, 'index']);

    Route::post('/senderids', [SenderIdController::class, 'store']);

    /*
    |--------------------------------------------------------------------------
    | Bulk SMS
    |--------------------------------------------------------------------------
    */

    Route::get('/send-sms', [BulkSmsController::class, 'index']);

    Route::post('/send-sms', [BulkSmsController::class, 'send']);

    Route::get('/sms-history', [BulkSmsController::class, 'history']);

    /*
    |--------------------------------------------------------------------------
    | Calls
    |--------------------------------------------------------------------------
    */

    Route::get('/make-call', [CallController::class, 'index']);

    Route::post('/make-call', [CallController::class, 'call']);

    Route::get('/call-history', [CallController::class, 'history']);

    /*
    |--------------------------------------------------------------------------
    | Caller IDs
    |--------------------------------------------------------------------------
    */

    Route::get('/callerids', [CallController::class, 'callerids']);

    Route::post('/callerids', [CallController::class, 'storeCallerId']);

    Route::get('/profile', function () {return view('profile');});


    /*
    |--------------------------------------------------------------------------
    | Tickets
    |--------------------------------------------------------------------------
    */

    Route::get('/tickets', [TicketController::class, 'index']);

    Route::post('/tickets', [TicketController::class, 'store']);

    Route::get('/tickets/{ticket}', [TicketController::class, 'show']);

    Route::post('/tickets/{ticket}/reply', [TicketController::class, 'reply']);


    /*
    |--------------------------------------------------------------------------
    | Admin Ticket Management
    |--------------------------------------------------------------------------
    */

    Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/tickets', [App\Http\Controllers\AdminTicketController::class, 'index']);

    Route::get('/admin/tickets/{ticket}', [App\Http\Controllers\AdminTicketController::class, 'show']);

    Route::post('/admin/tickets/{ticket}/reply', [App\Http\Controllers\AdminTicketController::class, 'reply']);

    Route::post('/admin/tickets/{ticket}/close', [App\Http\Controllers\AdminTicketController::class, 'close']);

    });

});

require __DIR__.'/auth.php';