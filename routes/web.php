<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuotationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/test-company',function () {
    return view('testCompany.listTest');
})->name('test')->middleware('auth');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::resource('companies', CompanyController::class)->middleware('auth');

Route::resource('contacts', ContactController::class)->middleware('auth');

Route::resource('brands', BrandController::class)->middleware('auth');
Route::put('brands/{brand}/update-target', [BrandController::class, 'updateTarget'])->name('brands.update-target')->middleware('auth');

Route::resource('category', CategoryController::class)->middleware('auth');

Route::resource('products', ProductController::class)->middleware('auth');

Route::resource('leads', LeadController::class)->middleware('auth');

Route::resource('quotations', QuotationController::class)->middleware('auth');
Route::post('quotations/addAddress', [QuotationController::class, 'addNewAddress'])->name('quotations.addAddress')->middleware('auth');
Route::post('quotations/lead', [QuotationController::class, 'searchLead'])->name('quotations.searchLead')->middleware('auth');






