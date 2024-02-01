<?php

use App\Http\Controllers\EmailTrackingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// routes/web.php

Route::get('/track-email/{token}/{email_id}', [EmailTrackingController::class, 'track'])->name('track-email');
Route::get('/send-email', [EmailTrackingController::class, 'sendEmail']);