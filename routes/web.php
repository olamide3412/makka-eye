<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Public Pages
Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::inertia('/about-us','About')->name('about');
Route::inertia('/services','Services')->name('services');
Route::inertia('/contact','Contact')->name('contact');
Route::inertia('/faq','FAQ')->name('faq');

// Public Appointment Booking
Route::inertia('/book-appointment', 'BookAppointment')->name('book-appointment');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');

Route::get('/track-appointment', [AppointmentController::class, 'monitor'])->name('track-appointment');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLinkRequestForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Dashboard & Staff Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    
    // Manage specific Appointments
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
    Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
});
