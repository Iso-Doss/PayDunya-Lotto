<?php

use App\Http\Controllers\Customer\AuthController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\LotteryController;
use App\Http\Controllers\Customer\NotificationController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\Customer\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes (Customer)
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::name('customer.')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::middleware('guest:customer')->name('auth.')->prefix('/auth')->group(function () {

        Route::get('/sign-up', [AuthController::class, 'signUpForm'])->name('sign-up');

        Route::post('/sign-up', [AuthController::class, 'signUp'])->name('sign-up');

        Route::get('/send-email-validate-account', [AuthController::class, 'sendEmailValidateAccountForm'])->name('send-email-validate-account');

        Route::post('/send-email-validate-account', [AuthController::class, 'sendEmailValidateAccount'])->name('send-email-validate-account');

        Route::get('/validate-account/{email}/{token}', [AuthController::class, 'validateAccount'])->name('validate-account');

        Route::get('/sign-in', [AuthController::class, 'signInForm'])->name('sign-in');

        Route::post('/sign-in', [AuthController::class, 'signIn'])->name('sign-in');

        Route::get('/forgot-password', [AuthController::class, 'forgotPasswordForm'])->name('forgot-password');

        Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');

        Route::get('/reset-password/{email}/{token}', [AuthController::class, 'resetPasswordForm'])->name('reset-password');

        Route::post('/reset-password/{email}/{token}', [AuthController::class, 'resetPassword'])->name('reset-password');

    });

    Route::middleware('auth:customer')->group(function () {

        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

        Route::name('profile.')->prefix('/profile')->group(function () {

            Route::get('/', [ProfileController::class, 'index'])->name('index');

            Route::post('/update', [ProfileController::class, 'update'])->name('update');

            Route::post('/update-email', [ProfileController::class, 'updateEmail'])->name('update-email');

            Route::get('/validate-update-email/{email}/{new_email}/{token}', [ProfileController::class, 'validateUpdateEmail'])->name('validate-update-email');

            Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('update-password');

            Route::post('/disable-account', [ProfileController::class, 'disableAccount'])->name('disable-account');

            Route::post('/delete-account', [ProfileController::class, 'deleteAccount'])->name('delete-account');

        });

        Route::name('notification.')->prefix('/notification')->group(function () {

            Route::get('/', [NotificationController::class, 'index'])->name('index');

            Route::post('/mark-as-read-or-as-unread/{notification_id}/{new_status}', [NotificationController::class, 'markAsReadOrAsUnread'])->name('mark-as-read-or-as-unread');

            Route::delete('/delete/{notification_id}', [NotificationController::class, 'delete'])->name('delete');

            Route::post('/mark-all-as-read-or-as-unread/{new_status}', [NotificationController::class, 'markAllAsReadOrAsUnread'])->name('mark-all-as-read-or-as-unread');

            Route::delete('/delete-all', [NotificationController::class, 'deleteAll'])->name('delete-all');

        });


        Route::name('transaction.')->prefix('/transaction')->group(function () {

            Route::get('/', [TransactionController::class, 'index'])->name('index');

            // Route::get('/create', [TransactionController::class, 'createForm'])->name('create');

            // Route::post('/create', [TransactionController::class, 'create'])->name('create');

            // Route::get('/update/{transaction}', [TransactionController::class, 'updateForm'])->name('update');

            // Route::post('/update/{transaction}', [TransactionController::class, 'update'])->name('update');

            Route::post('/enable-disable/{transaction}/{new_status}', [TransactionController::class, 'enableDisable'])->name('enable-disable');

            Route::delete('/delete/{transaction}', [TransactionController::class, 'delete'])->name('delete');

        });

        Route::name('lottery.')->prefix('/lottery')->group(function () {

            Route::get('/', [LotteryController::class, 'index'])->name('index');

            Route::get('/buy-ticket', [LotteryController::class, 'buyTicketForm'])->name('buy-ticket');

            Route::post('/buy-ticket', [LotteryController::class, 'buyTicket'])->name('buy-ticket');

        });


        Route::post('/auth/sign-out', [AuthController::class, 'signOut'])->name('auth.sign-out');

    });


});
