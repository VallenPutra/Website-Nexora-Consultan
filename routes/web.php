<?php

use App\Http\Controllers\Admin\AccountManagerController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ConsultationMessageController;
use App\Http\Controllers\Admin\ConsultationRequestController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InsightController as AdminInsightController;
use App\Http\Controllers\Admin\MediaLibraryController;
use App\Http\Controllers\Admin\PlaceholderController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RevenueController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ConsultationChatController;
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
Route::post('/consultation-chat/start', [ConsultationChatController::class, 'start'])->name('consultation-chat.start');
Route::get('/consultation-chat/{token}/messages', [ConsultationChatController::class, 'messages'])->name('consultation-chat.messages');
Route::post('/consultation-chat/{token}/messages', [ConsultationChatController::class, 'send'])->name('consultation-chat.send');

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
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('clients', ClientController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('services', AdminServiceController::class);
    Route::resource('team', TeamMemberController::class)->parameters(['team' => 'teamMember']);
    Route::resource('insights', AdminInsightController::class);
    Route::get('/media', [MediaLibraryController::class, 'index'])->name('media.index');
    Route::post('/media', [MediaLibraryController::class, 'store'])->name('media.store');
    Route::get('/media/download/{path}', [MediaLibraryController::class, 'download'])->where('path', '.*')->name('media.download');
    Route::delete('/media/{path}', [MediaLibraryController::class, 'destroy'])->where('path', '.*')->name('media.destroy');
    Route::resource('consultation-requests', ConsultationRequestController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::post('/consultation-requests/{consultationRequest}/messages', [ConsultationMessageController::class, 'store'])->name('consultation-requests.messages.store');
    Route::post('/consultation-requests/{consultationRequest}/typing', [ConsultationMessageController::class, 'typing'])->name('consultation-requests.typing');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');
    Route::resource('revenue', RevenueController::class)->parameters(['revenue' => 'revenue']);
    Route::patch('/revenue/{revenue}/mark-paid', [RevenueController::class, 'markPaid'])->name('revenue.mark-paid');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password');
    Route::post('/settings/users', [SettingsController::class, 'storeUser'])->name('settings.users.store');
    Route::delete('/settings/users/{user}', [SettingsController::class, 'destroyUser'])->name('settings.users.destroy');
    Route::get('/account-manager', [AccountManagerController::class, 'index'])->name('account-manager.index');
    Route::post('/account-manager', [AccountManagerController::class, 'store'])->name('account-manager.store');
    Route::delete('/account-manager/{user}', [AccountManagerController::class, 'destroy'])->name('account-manager.destroy');

    Route::get('/{module}', [PlaceholderController::class, 'show'])->name('placeholder');
});
