<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\InstructorDashboardController;
use App\Http\Controllers\OwnerDashboardController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/packages', [HomeController::class, 'packages'])->name('packages');
Route::get('/locations', [HomeController::class, 'locations'])->name('locations');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Auth routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes - require authentication
Route::middleware('auth')->group(function () {
    // Password change (all roles)
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change-password');

    // Customer routes
    Route::middleware('role:customer')->group(function () {
        Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
        Route::get('/customer/personal-info', [CustomerDashboardController::class, 'editPersonalInfo'])->name('customer.personal-info');
        Route::post('/customer/personal-info', [CustomerDashboardController::class, 'updatePersonalInfo'])->name('customer.personal-info.store');
        
        // These routes require complete profile
        Route::middleware('complete-profile')->group(function () {
            Route::get('/customer/make-reservation', [CustomerDashboardController::class, 'makeReservation'])->name('customer.make-reservation');
            Route::post('/customer/make-reservation', [CustomerDashboardController::class, 'storeReservation'])->name('customer.make-reservation.store');
            Route::post('/customer/reservations/{id}/payment', [CustomerDashboardController::class, 'markPaymentReceived'])->name('customer.mark-payment');
            Route::get('/customer/reservations', [CustomerDashboardController::class, 'viewReservations'])->name('customer.reservations');
            Route::post('/customer/lessons/{id}/cancel', [CustomerDashboardController::class, 'cancelLesson'])->name('customer.cancel-lesson');
        });
    });

    // Instructor routes
    Route::middleware('role:instructor')->group(function () {
        Route::get('/instructor/personal-info', [InstructorDashboardController::class, 'editPersonalInfo'])->name('instructor.personal-info');
        Route::post('/instructor/personal-info', [InstructorDashboardController::class, 'updatePersonalInfo'])->name('instructor.personal-info.store');
        
        // These routes require complete profile
        Route::middleware('complete-profile')->group(function () {
            Route::get('/instructor/dashboard', [InstructorDashboardController::class, 'index'])->name('instructor.dashboard');
            Route::get('/instructor/schedule', [InstructorDashboardController::class, 'schedule'])->name('instructor.schedule');
            Route::post('/instructor/lessons/{id}/cancel', [InstructorDashboardController::class, 'cancelLesson'])->name('instructor.cancel-lesson');
            Route::get('/instructor/customers', [InstructorDashboardController::class, 'viewCustomers'])->name('instructor.customers');
            Route::get('/instructor/customers/{id}', [InstructorDashboardController::class, 'manageCustomer'])->name('instructor.manage-customer');
        });
    });

    // Owner routes
    Route::middleware('role:owner')->group(function () {
        Route::get('/owner/dashboard', [OwnerDashboardController::class, 'index'])->name('owner.dashboard');
        Route::get('/owner/personal-info', [OwnerDashboardController::class, 'editPersonalInfo'])->name('owner.personal-info');
        Route::post('/owner/personal-info', [OwnerDashboardController::class, 'updatePersonalInfo'])->name('owner.personal-info.store');
        Route::post('/owner/users/{id}/role', [OwnerDashboardController::class, 'changeUserRole'])->name('owner.change-role');
        Route::get('/owner/customers', [OwnerDashboardController::class, 'viewCustomers'])->name('owner.customers');
        Route::get('/owner/customers/{id}', [OwnerDashboardController::class, 'manageCustomer'])->name('owner.manage-customer');
        Route::get('/owner/instructors', [OwnerDashboardController::class, 'viewInstructors'])->name('owner.instructors');
        Route::get('/owner/instructors/{id}', [OwnerDashboardController::class, 'manageInstructor'])->name('owner.manage-instructor');
        Route::get('/owner/reservations', [OwnerDashboardController::class, 'viewReservations'])->name('owner.reservations');
        Route::post('/owner/reservations/{id}/confirm-payment', [OwnerDashboardController::class, 'confirmPayment'])->name('owner.confirm-payment');
        Route::post('/owner/lessons/{id}/cancel', [OwnerDashboardController::class, 'cancelLesson'])->name('owner.cancel-lesson');
        Route::get('/owner/instructors/{id}/schedule', [OwnerDashboardController::class, 'viewInstructorSchedule'])->name('owner.instructor-schedule');
        Route::post('/owner/users/{id}/toggle', [OwnerDashboardController::class, 'toggleUserStatus'])->name('owner.toggle-status');
    });
});
