<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Resort Web Routes
|--------------------------------------------------------------------------
| Sishwar Chitwan Tiger Resort (Devchuli-17, Piprahar, Nawalparasi)
*/

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/rooms', [FrontendController::class, 'rooms'])->name('rooms.index');
Route::get('/rooms/{slug}', [FrontendController::class, 'roomDetail'])->name('rooms.show');
Route::get('/activities', [FrontendController::class, 'activities'])->name('activities.index');
Route::get('/activities/{slug}', [FrontendController::class, 'activityDetail'])->name('activities.show');
Route::get('/gallery', [FrontendController::class, 'gallery'])->name('gallery.index');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'submitInquiry'])->name('inquiry.submit');
Route::post('/book', [FrontendController::class, 'submitBooking'])->name('booking.submit');
Route::get('/booking/confirmed/{code}', [FrontendController::class, 'bookingConfirmed'])->name('booking.confirmed');
