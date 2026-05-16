<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// ── Main pages ────────────────────────────────────────────────────────────────
Route::get('/',                        fn() => Inertia::render('Home'))->name('home');
Route::get('/aboutUs',                 fn() => Inertia::render('AboutUs'))->name('about');
Route::get('/workProgram',             fn() => Inertia::render('WorkProgram'))->name('workProgram');
Route::get('/gallery',                 fn() => Inertia::render('Gallery'))->name('gallery');
Route::get('/information',             fn() => Inertia::render('Information'))->name('information');
Route::get('/information/detail/{id}', fn(int $id) => Inertia::render('InformationDetail', ['id' => $id]))->name('information.detail');
Route::get('/aspirationForm',          fn() => Inertia::render('AspirationForm'))->name('aspirationForm');
Route::get('/linkPage',                fn() => Inertia::render('LinkPage'))->name('linkPage');

// ── Event short-links — update hrefs here whenever a new event launches ───────
Route::redirect('/inforta',     'https://infortaumn.my.id',    301);
Route::redirect('/cursor',      'https://cursor.hmif.id',      301);
Route::redirect('/ppif',        'https://ppif.hmif.id',        301);
Route::redirect('/byte',        'https://byte.hmif.id',        301);
Route::redirect('/codeconnect', 'https://codeconnect.hmif.id', 301);
