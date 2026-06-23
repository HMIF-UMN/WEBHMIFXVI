<?php

use App\Http\Controllers\InformationController;
use Illuminate\Support\Facades\Route;

Route::get('/information/articles', [InformationController::class, 'getArticles']);
Route::get('/information/articles/{id}', [InformationController::class, 'getArticle']);
