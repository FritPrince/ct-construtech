<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\FormationController as AdminFormationController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

// ── Site public ──────────────────────────────────────────────
Route::get('/',          [HomeController::class,      'index'])->name('home');
Route::get('/services',  [ServiceController::class,   'index'])->name('services');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/portfolio/{project}', [PortfolioController::class, 'show'])->name('portfolio.show');
Route::get('/formation', [FormationController::class, 'index'])->name('formation');
Route::get('/contact',   [ContactController::class,   'index'])->name('contact');
Route::post('/contact',  [ContactController::class,   'send'])->name('contact.send');

// ── Newsletter ────────────────────────────────────────────────
Route::post('/newsletter', [App\Http\Controllers\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// ── Auth ──────────────────────────────────────────────────────
Route::get('/login',  [App\Http\Controllers\Auth\LoginController::class, 'showForm'])->name('login')->middleware('guest');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->middleware('guest');
Route::post('/logout',[App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// ── Admin ─────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Services
    Route::resource('services',    AdminServiceController::class);

    // Projects
    Route::resource('projects',    AdminProjectController::class);

    // Formations
    Route::resource('formations',  AdminFormationController::class);

    // Testimonials
    Route::resource('testimonials', TestimonialController::class);

    // Messages
    Route::get('messages',                    [ContactMessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}',          [ContactMessageController::class, 'show'])->name('messages.show');
    Route::patch('messages/{message}/read',   [ContactMessageController::class, 'markRead'])->name('messages.read');
    Route::delete('messages/{message}',       [ContactMessageController::class, 'destroy'])->name('messages.destroy');

    // Settings
    Route::get('settings',  [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings',  [SettingController::class, 'update'])->name('settings.update');
});
