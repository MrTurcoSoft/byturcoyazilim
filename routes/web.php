<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ReferenceController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\GoogleCalendarController;

// Public Routes
Route::middleware([\App\Http\Middleware\SetLocale::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/hakkimizda', [HomeController::class, 'about'])->name('about');
    Route::get('/hizmetler', [HomeController::class, 'services'])->name('services');
    Route::get('/hizmetler/{id}', [HomeController::class, 'serviceDetail'])->name('services.detail');
    Route::get('/referanslar', [HomeController::class, 'references'])->name('references');
    Route::get('/referanslar/{id}', [HomeController::class, 'referenceDetail'])->name('references.detail');
    Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
    Route::get('/blog/{slug}', [HomeController::class, 'blogPost'])->name('blog.post');
    Route::get('/iletisim', [HomeController::class, 'contact'])->name('contact');
    Route::get('/teklif-al', [HomeController::class, 'quote'])->name('quote');
    
    // Form submissions
    Route::post('/iletisim', [FormController::class, 'submitContact'])->name('contact.submit');
    Route::post('/teklif-al', [FormController::class, 'submitQuote'])->name('quote.submit');
    
    // Language switcher
    Route::get('/lang/{locale}', [HomeController::class, 'setLocale'])->name('locale');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Services
    Route::resource('services', ServiceController::class)->except(['show']);
    
    // References
    Route::resource('references', ReferenceController::class)->except(['show']);
    
    // Blog
    Route::resource('blog', BlogController::class)->except(['show']);
    
    // Contacts
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::patch('/contacts/{contact}/status', [ContactController::class, 'updateStatus'])->name('contacts.status');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    
    // Quotes
    Route::get('/quotes', [QuoteController::class, 'index'])->name('quotes.index');
    Route::get('/quotes/{quote}', [QuoteController::class, 'show'])->name('quotes.show');
    Route::patch('/quotes/{quote}', [QuoteController::class, 'update'])->name('quotes.update');
    Route::post('/quotes/{quote}/calendar', [QuoteController::class, 'addToCalendar'])->name('quotes.calendar.add');
    Route::delete('/quotes/{quote}/calendar', [QuoteController::class, 'removeFromCalendar'])->name('quotes.calendar.remove');
    Route::delete('/quotes/{quote}', [QuoteController::class, 'destroy'])->name('quotes.destroy');
    
    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::get('/settings/theme', [SettingController::class, 'theme'])->name('settings.theme');
    Route::post('/settings/theme', [SettingController::class, 'updateTheme'])->name('settings.theme.update');
    
    // SEO
    Route::get('/seo', [SeoController::class, 'index'])->name('seo.index');
    Route::get('/seo/{page}', [SeoController::class, 'edit'])->name('seo.edit');
    Route::post('/seo/{page}', [SeoController::class, 'update'])->name('seo.update');
    
    // Upload
    Route::post('/upload', [UploadController::class, 'upload'])->name('upload');
    Route::delete('/upload', [UploadController::class, 'delete'])->name('upload.delete');
    Route::get('/uploads', [UploadController::class, 'list'])->name('uploads.list');
    
    // Google Calendar
    Route::get('/calendar/connect', [GoogleCalendarController::class, 'connect'])->name('calendar.connect');
    Route::get('/calendar/disconnect', [GoogleCalendarController::class, 'disconnect'])->name('calendar.disconnect');
    Route::get('/calendar/status', [GoogleCalendarController::class, 'status'])->name('calendar.status');
});

// Google Calendar OAuth Callback (outside admin middleware for OAuth flow)
Route::get('/api/oauth/calendar/callback', [GoogleCalendarController::class, 'callback'])->middleware('auth')->name('calendar.callback');
