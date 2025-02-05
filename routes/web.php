<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdenesPublicController;
use Illuminate\Support\Facades\Artisan;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/ordenes/public/{public_token}', [OrdenesPublicController::class, 'show'])->name('ordenes.public');

Route::get('storage-link', function () {
    if (file_exists(public_path('storage'))) {
        return 'The "public/storage" directory already exists.';
    }

    app('files')->link(
        storage_path('app/public'), public_path('storage')
    );

    return 'The [public/storage] directory has been linked.';
});

