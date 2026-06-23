<?php

use App\Http\Controllers\Admin\AboutUs\AboutImageController;
use App\Http\Controllers\Admin\AboutUs\DivisionMemberController;
use App\Http\Controllers\Admin\AboutUs\WordinganController as AboutWordinganController;
use App\Http\Controllers\Admin\AspirationSubmissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ContactSubmissionController;
use App\Http\Controllers\Admin\CustomLinkController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\Home\HomeSettingsController;
use App\Http\Controllers\Admin\KpiController;
use App\Http\Controllers\Admin\Proker\WordinganController as ProkerWordinganController;
use App\Http\Controllers\Admin\Proker\WorkProgramController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AspirationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// ── Main pages ────────────────────────────────────────────────────────────────
Route::get('/',         [HomeController::class, 'index'])->name('home');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/aboutUs',                 [AboutUsController::class, 'index'])->name('about');
Route::get('/workProgram',             fn() => Inertia::render('WorkProgram'))->name('workProgram');
Route::get('/gallery',                 [GalleryController::class, 'index'])->name('gallery');
Route::get('/information',             fn() => Inertia::render('Information'))->name('information');
Route::get('/information/detail/{id}', fn(int $id) => Inertia::render('InformationDetail', ['id' => $id]))->name('information.detail');
Route::get('/aspirationForm',          fn() => Inertia::render('AspirationForm'))->name('aspirationForm');
Route::post('/aspirationForm',         [AspirationController::class, 'store'])->name('aspirationForm.store');
Route::get('/profile',                fn() => Inertia::render('LinkPage'))->name('linkPage');

// ── Event short-links ─────────────────────────────────────────────────────────
Route::redirect('/inforta', 'https://infortaumn.my.id', 301);
Route::redirect('/ppif',    'https://ppif.umn.ac.id',   301);
Route::redirect('/byte',    'https://byteumn.com',      301);

// ── Auth routes ───────────────────────────────────────────────────────────────
require __DIR__ . '/auth.php';

// ── Custom admin login entry point ────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/adminhmifxvi/login',  [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/adminhmifxvi/login', [AuthenticatedSessionController::class, 'store']);
});

// ── Authenticated routes ──────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {

        // Master only
        Route::middleware('role:master')->group(function () {
            Route::resource('users', UserController::class)->except(['show']);
        });

        // Admin + Master
        Route::middleware('role:admin,master')->group(function () {
            Route::resource('custom-links', CustomLinkController::class)->except(['show']);

            Route::get('gallery',                   [GalleryImageController::class, 'index'])->name('gallery.index');
            Route::post('gallery',                  [GalleryImageController::class, 'store'])->name('gallery.store');
            Route::post('gallery/{galleryImage}',   [GalleryImageController::class, 'update'])->name('gallery.update');
            Route::delete('gallery/{galleryImage}', [GalleryImageController::class, 'destroy'])->name('gallery.destroy');

            Route::get('contact-submissions',                                  [ContactSubmissionController::class, 'index'])->name('contact-submissions.index');
            Route::patch('contact-submissions/{contactSubmission}/read',       [ContactSubmissionController::class, 'markRead'])->name('contact-submissions.read');
            Route::delete('contact-submissions/{contactSubmission}',           [ContactSubmissionController::class, 'destroy'])->name('contact-submissions.destroy');

            Route::get('aspiration-submissions',                                     [AspirationSubmissionController::class, 'index'])->name('aspiration-submissions.index');
            Route::patch('aspiration-submissions/{aspirationSubmission}/read',       [AspirationSubmissionController::class, 'markRead'])->name('aspiration-submissions.read');
            Route::delete('aspiration-submissions/{aspirationSubmission}',           [AspirationSubmissionController::class, 'destroy'])->name('aspiration-submissions.destroy');

            Route::prefix('about-us')->name('about-us.')->group(function () {
                Route::get('wordingan',   [AboutWordinganController::class, 'edit'])->name('wordingan.edit');
                Route::patch('wordingan', [AboutWordinganController::class, 'update'])->name('wordingan.update');
                Route::resource('division-members', DivisionMemberController::class)->except(['show']);
                Route::get('grid-images',                 [AboutImageController::class, 'index'])->name('grid-images.index');
                Route::post('grid-images',                [AboutImageController::class, 'store'])->name('grid-images.store');
                Route::delete('grid-images/{aboutImage}', [AboutImageController::class, 'destroy'])->name('grid-images.destroy');
            });

            Route::prefix('home')->name('home.')->group(function () {
                Route::get('settings',   [HomeSettingsController::class, 'edit'])->name('settings.edit');
                Route::patch('settings', [HomeSettingsController::class, 'update'])->name('settings.update');
                Route::post('hero',      [HomeSettingsController::class, 'updateHero'])->name('hero.update');
            });

            Route::prefix('proker')->name('proker.')->group(function () {
                Route::resource('work-programs', WorkProgramController::class)->except(['show']);
                Route::get('wordingan',   [ProkerWordinganController::class, 'edit'])->name('wordingan.edit');
                Route::patch('wordingan', [ProkerWordinganController::class, 'update'])->name('wordingan.update');
            });
        });

        // Admin + HR + Master
        Route::middleware('role:admin,hr,master')->group(function () {
            Route::get('kpi',                  [KpiController::class, 'index'])->name('kpi.index');
            Route::get('kpi/{kpiMember}/edit', [KpiController::class, 'edit'])->name('kpi.edit');
            Route::patch('kpi/{kpiMember}',    [KpiController::class, 'update'])->name('kpi.update');
        });
    });
});

// ── Custom link slug resolver — must be LAST ──────────────────────────────────
Route::get('/{slug}', [CustomLinkController::class, 'redirect'])
    ->where('slug', '^(?!admin|login|register|logout|password|forgot-password|reset-password|verify-email|confirm-password|profile|up|dashboard|inforta|ppif|byte)[a-zA-Z0-9_-]+$')
    ->name('custom-link.redirect');
