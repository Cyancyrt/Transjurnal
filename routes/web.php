<?php

use App\Http\Controllers\Admin\OrderManagementController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\OrderController;

use App\Http\Controllers\Translator\DashboardController as TranslatorDashboardController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ScholarManagementController;
use App\Http\Controllers\Admin\ServiceManagementController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Translator\JobController;
use App\Http\Controllers\Translator\OrderController as TranslatorOrderController;
use App\Http\Controllers\Translator\ProfileController;
use App\Http\Controllers\Translator\ReviewController;
use App\Http\Controllers\User\ScholarController;
use App\Http\Controllers\User\ServiceController;

Route::get('/', [
    LandingController::class,
    'index'
])->name('landing');

Route::middleware('guest')->group(function () {

    Route::get('/login',
        [LoginController::class,'showLogin']
    )->name('login');

    Route::post('/login',
        [LoginController::class,'login']
    );

    Route::get('/register',
        [RegisterController::class,'showRegister']
    )->name('register');

    Route::post('/register',
        [RegisterController::class,'register']
    );
});

Route::post('/logout',
    [LoginController::class,'logout']
)->middleware('auth')
 ->name('logout');

Route::middleware([
    'auth',
    'role:user'
])->prefix('user')
  ->name('user.')
  ->group(function () {

    Route::get('/dashboard',
        [UserDashboardController::class,'index']
    )->name('dashboard');

    Route::resource(
        'orders',
        OrderController::class
    );
    Route::resource(
        'scholars',
        ScholarController::class
    );
    Route::resource(
        'services',
        ServiceController::class
    );
    Route::get(
        '/translations',
        [OrderController::class, 'completedTranslations']
    )->name('translations.index');
});

Route::middleware([
    'auth',
    'role:translator'
])->prefix('translator')
  ->name('translator.')
  ->group(function () {

    Route::get('/dashboard',
        [TranslatorDashboardController::class,'index']
    )->name('dashboard');
    Route::resource(
        'jobs',
        JobController::class
    );
    Route::patch(
        '/jobs/{job}/accept',
        [JobController::class,'accept']
    )->name('jobs.accept');
    Route::resource(
        'orders',
        TranslatorOrderController::class
    );
    Route::get('/orders/{order}/show',
        [TranslatorOrderController::class,'show'])
        ->name('orders.show');
    Route::get('/orders/{order}/work',
        [TranslatorOrderController::class,'work'])
        ->name('orders.work');

    Route::patch('/orders/{order}/status',
        [TranslatorOrderController::class,'updateStatus'])
        ->name('orders.status');

    Route::post('/orders/{order}/upload',
        [TranslatorOrderController::class,'upload'])
        ->name('orders.upload');
    Route::resource(
        'profile',
        ProfileController::class
    );
    Route::resource(
        'reviews',
        ReviewController::class
    );
});

Route::middleware([
    'auth',
    'role:admin'
])->prefix('admin')
  ->name('admin.')
  ->group(function () {

    Route::get('/dashboard',
        [AdminDashboardController::class,'index']
    )->name('dashboard');
    Route::get('/orders', [
        OrderManagementController::class,
        'index'
    ])->name('orders.index');
    Route::get('/orders/{order}', [
        OrderManagementController::class,
        'show'
    ])->name('orders.show');
    Route::post(
        '/orders/{order}/assign',
        [OrderManagementController::class, 'assignTranslator']
    )->name('orders.assign');
    Route::resource(
            'scholars',
        ScholarManagementController::class
    );
    Route::post(
        'scholars/{scholar}/approve',
        [
            ScholarManagementController::class,
            'approve'
        ]
    )->name('scholars.approve');

    Route::post(
        'scholars/{scholar}/reject',
        [
            ScholarManagementController::class,
            'reject'
        ]
    )->name('scholars.reject');
    Route::resource('/users', UserManagementController::class)->names('users');
    Route::resource('/services', ServiceManagementController::class)->names('services');
    Route::get('/reports', [
        ReportController::class,
        'index'
    ])->name('reports.index');
});