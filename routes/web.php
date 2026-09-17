<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\InsightController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SolutionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

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
