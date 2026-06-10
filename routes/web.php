<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
})->name('home');

Route::middleware("guest")->group(function(){
    Route::get('/admin',[AdminController::class,'loginPage'])->name('admin.login.page');
    Route::post('/admin',[AdminController::class,'login'])->name('admin.login.submit');
});

Route::middleware("auth:admin")->prefix('admin')->group(function(){
    Route::post('logout',[AdminController::class,'logout'])->name('admin.logout');
    Route::get('dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('books',[BooksController::class,'listBooks'])->name('admin.books');
    Route::match(["get","post"],'books/create',[BooksController::class,'createBook'])->name('admin.books.create');
    Route::match(["get","put"],'books/edit/{book_id}',[BooksController::class,'editBook'])->name('admin.books.edit');
    Route::patch('books/avail/{book_id}',[BooksController::class,'toggleAvailability'])->name('admin.books.avail');
    Route::delete('books/delete/{book_id}',[BooksController::class,'deleteBook'])->name('admin.books.delete');
    Route::get("weather-by-latlon",[WeatherController::class,'getWeatherByLatLon'])->name('weather.latlon');
});