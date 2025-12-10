<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogoController;

Route::apiResource('catalogos', CatalogoController::class);

