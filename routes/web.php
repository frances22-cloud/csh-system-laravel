<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\ApplicationsController;

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
    return view('home');
});

Route::get('/login_reg', function () {
    return view('login_reg');
});


//APPLICATIONS
Route::post('/',[ApplicationsController::class, 'insert']);
Route::get('viewApplications',[ApplicationsController::class, 'viewApplications']);


//CUSTOMIZATION
Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
Route::post( 'customlogin',[CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post( 'customRegistration',[CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

require_once __DIR__ . '/lec_stud.php';


//SENDING ACCEPTANCE MAIL TO CHOSEN STUDENT
Route::get('/send_mail', function () {
   
    $details = [
        'title' => 'Mail from Eduka',
        'body' => 'Dear Applicant,

        On behalf of Eduka, We are pleased to congratulate you on our acceptance into our program. 
    
        As you know, Eduka is a school with the most exclusive program in the area and we have accepted only the finest applicants since our founding in 1975.   We were very impressed with your skills and abilities and gladly chose you from our pool of applicants to enroll in our fall program.
        
        In order to ensure your full official enrollment into our fall program,  please fill out and return the enclosed forms no later than January 10, 2022.
        
        Receiving the necessary information as soon as possible will help us facilitate your enrollment.    In the meantime, please do not hesitate to contact us if you have any questions or concerns.     Our telephone number is 0710-020-034

        and our email address is info@meeting.eduka. We look forward to hearing from you.
        
        We are delighted to accept you into our fall program and feel confident that you will make a great addition.    We trust that your whole family will be pleased with the nurturing environment of Eduka providing a safe place for you to learn and grow.   Thank you for choosing to apply with our program.
        
    '];
   
    Mail::to('student.laravel01@gmail.com')->send(new \App\Mail\TestMail($details));
    return redirect('/view_applications')->with('message','Application accepted. Email sent to students');
});

Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
Route::post( 'customlogin',[CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post( 'customRegistration',[CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

require_once __DIR__ . '/lec_stud.php';
require_once __DIR__ . '/admin.php';

