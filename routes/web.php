<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoverLetterController;

/*Route::get('/', function () {*/
/*    return view('welcome');*/
/*});*/

Route::controller(CoverLetterController::class)->group(function () {
    Route::get('/', 'index')->name('coverletters.index');
    Route::post('/submit', 'submit')->name('coverletters.submit');
});
