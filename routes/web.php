<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Session;
use Sayakb\Captcha\Facades\Captcha;

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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/about', [IndexController::class, 'about'])->name('about');

Route::get('/vision', [IndexController::class, 'vision'])->name('vision');

Route::get('/mission', [IndexController::class, 'mission'])->name('mission');

Route::get('/future-scenario', [IndexController::class, 'future_scenario'])->name('future_scenario');

Route::get('/members', [IndexController::class, 'members'])->name('members');

Route::get('/rules', [IndexController::class, 'rules'])->name('rules');

Route::get('/services-and-standards', [IndexController::class, 'services_and_standards'])->name('services-and-standards');

Route::get('/complaints', [IndexController::class, 'complaints'])->name('complaints');

Route::get('/contact', [IndexController::class, 'contact'])->name('contact');



Route::get('/register', [RegisterController::class, 'register'])->name('register');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/loginpage', [RegisterController::class, 'login'])->name('loginpage');

Route::get('/login', [LoginController::class, 'login'])->name('login');

Route::post('/login', [LoginController::class, 'check'])->name('login.check');

Route::post('/login/verify', [LoginController::class, 'verifyOtp'])->name('login.verify');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard route with authentication middleware
Route::get('/dashboard', function () {
    return view('user_login.index'); 
})->name('dashboard')->middleware('auth.dashboard');




// ------------after login ------------------
Route::get('/user_login', [RegisterController::class, 'user_login'])->name('user_login');

Route::get('/apply-form-s', [RegisterController::class, 'apply_form_s'])->name('apply-form-s');

Route::get('/apply-form-w', [RegisterController::class, 'apply_form_w'])->name('apply-form-w');


// --------success-page---------------------

Route::get('/successpage', [RegisterController::class, 'successpage'])->name('successpage');


Route::get('captcha/image', function () {
    return Captcha::create();
});

// ----------------------------------------

Route::post('/form/store', [FormController::class, 'store'])->name('form.store');
Route::get('/generate-pdf/{login_id}', [PDFController::class, 'generatePDF'])->name('generate.pdf');
Route::get('/generateTamilPDF/{login_id}', [PDFController::class, 'generateTamilPDF'])->name('generate.tamil.pdf');


