<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PlaceholderController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\InsightController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SolutionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/locale/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');

// Solutions
Route::get('/solutions', [SolutionController::class, 'index'])->name('solutions.index');
Route::get('/solutions/{slug}', [SolutionController::class, 'show'])->name('solutions.show');

// Services
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Industries
Route::get('/industries', [IndustryController::class, 'index'])->name('industries.index');
Route::get('/industries/{slug}', [IndustryController::class, 'show'])->name('industries.show');

// Insights
Route::get('/insights', [InsightController::class, 'index'])->name('insights.index');
Route::get('/insights/{slug}', [InsightController::class, 'show'])->name('insights.show');

// Company
Route::get('/company', [CompanyController::class, 'about'])->name('company.index');
Route::get('/company/about', [CompanyController::class, 'about'])->name('company.about');
Route::get('/company/approach', [CompanyController::class, 'approach'])->name('company.approach');
Route::get('/company/team', [CompanyController::class, 'team'])->name('company.team');
Route::get('/company/careers', [CompanyController::class, 'careers'])->name('company.careers');
Route::get('/company/partners', [CompanyController::class, 'partners'])->name('company.partners');

// Contact
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
| Minimal, hand-rolled login/register (no Breeze/Fortify/Jetstream) so the
| styling matches NEXORA's own design system instead of a generic scaffold.
*/
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('throttle:5,1');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Admin dashboard
|--------------------------------------------------------------------------
| Now protected by the 'auth' middleware — unauthenticated visitors are
| redirected to /login automatically.
*/
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/{module}', [PlaceholderController::class, 'show'])->name('placeholder');
});
