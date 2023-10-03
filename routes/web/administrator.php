<?php

use App\Http\Controllers\Administrator\AuthController;
use App\Http\Controllers\Administrator\CountryController;
use App\Http\Controllers\Administrator\HomeController;
use App\Http\Controllers\Administrator\LotteryController;
use App\Http\Controllers\Administrator\NotificationController;
use App\Http\Controllers\Administrator\ProfileController;
use App\Http\Controllers\Administrator\StatusController;
use App\Http\Controllers\Administrator\TicketController;
use App\Http\Controllers\Administrator\TransactionController;
use App\Http\Controllers\Administrator\TransactionTypeController;
use App\Http\Controllers\Administrator\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes (Administrator)
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::name('administrator.')->prefix('/administrator')->group(function () {

    Route::middleware('guest:administrator')->name('auth.')->prefix('/auth')->group(function () {

        Route::get('/sign-up', [AuthController::class, 'signUpForm'])->name('sign-up');

        Route::post('/sign-up', [AuthController::class, 'signUp'])->name('sign-up');

        // Route::get('/send-email-validate-account', [AuthController::class, 'sendEmailValidateAccountForm'])->name('send-email-validate-account');

        // Route::post('/send-email-validate-account', [AuthController::class, 'sendEmailValidateAccount'])->name('send-email-validate-account');

        // Route::get('/validate-account/{email}/{token}', [AuthController::class, 'validateAccount'])->name('validate-account');

        Route::get('/sign-in', [AuthController::class, 'signInForm'])->name('sign-in');

        Route::post('/sign-in', [AuthController::class, 'signIn'])->name('sign-in');

        Route::get('/forgot-password', [AuthController::class, 'forgotPasswordForm'])->name('forgot-password');

        Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');

        Route::get('/reset-password/{email}/{token}', [AuthController::class, 'resetPasswordForm'])->name('reset-password');

        Route::post('/reset-password/{email}/{token}', [AuthController::class, 'resetPassword'])->name('reset-password');

    });

    Route::middleware('auth:administrator')->group(function () {

        Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');

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

        Route::name('user.')->prefix('/user')->group(function () {

            Route::get('/', [UserController::class, 'index'])->name('index');

            Route::get('/create', [UserController::class, 'createForm'])->name('create');

            Route::post('/create', [UserController::class, 'create'])->name('create');

            Route::post('/validate-account/{user}', [UserController::class, 'validateAccount'])->name('validate-account');

            Route::post('/enable-disable/{user}/{new_status}', [UserController::class, 'enableDisable'])->name('enable-disable');

            Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('delete');

        });

        Route::name('country.')->prefix('/country')->group(function () {

            Route::get('/', [CountryController::class, 'index'])->name('index');

            Route::get('/create', [CountryController::class, 'createForm'])->name('create');

            Route::post('/create', [CountryController::class, 'create'])->name('create');

            Route::get('/update/{country}', [CountryController::class, 'updateForm'])->name('update');

            Route::post('/update/{country}', [CountryController::class, 'update'])->name('update');

            Route::post('/enable-disable/{country}/{new_status}', [CountryController::class, 'enableDisable'])->name('enable-disable');

            Route::delete('/delete/{country}', [CountryController::class, 'delete'])->name('delete');

        });

        Route::name('status.')->prefix('/status')->group(function () {

            Route::get('/', [StatusController::class, 'index'])->name('index');

            Route::get('/create', [StatusController::class, 'createForm'])->name('create');

            Route::post('/create', [StatusController::class, 'create'])->name('create');

            Route::get('/update/{status}', [StatusController::class, 'updateForm'])->name('update');

            Route::post('/update/{status}', [StatusController::class, 'update'])->name('update');

            Route::post('/enable-disable/{status}/{new_status}', [StatusController::class, 'enableDisable'])->name('enable-disable');

            Route::delete('/delete/{status}', [StatusController::class, 'delete'])->name('delete');

        });

        Route::name('ticket.')->prefix('/ticket')->group(function () {

            Route::get('/', [TicketController::class, 'index'])->name('index');

            Route::get('/create', [TicketController::class, 'createForm'])->name('create');

            Route::post('/create', [TicketController::class, 'create'])->name('create');

            Route::get('/update/{ticket}', [TicketController::class, 'updateForm'])->name('update');

            Route::post('/update/{ticket}', [TicketController::class, 'update'])->name('update');

            Route::post('/enable-disable/{ticket}/{new_status}', [TicketController::class, 'enableDisable'])->name('enable-disable');

            Route::delete('/delete/{ticket}', [TicketController::class, 'delete'])->name('delete');

        });

        Route::name('transaction-type.')->prefix('/transaction-type')->group(function () {

            Route::get('/', [TransactionTypeController::class, 'index'])->name('index');

            Route::get('/create', [TransactionTypeController::class, 'createForm'])->name('create');

            Route::post('/create', [TransactionTypeController::class, 'create'])->name('create');

            Route::get('/update/{transaction_type}', [TransactionTypeController::class, 'updateForm'])->name('update');

            Route::post('/update/{transaction_type}', [TransactionTypeController::class, 'update'])->name('update');

            Route::post('/enable-disable/{transaction_type}/{new_status}', [TransactionTypeController::class, 'enableDisable'])->name('enable-disable');

            Route::delete('/delete/{transaction_type}', [TransactionTypeController::class, 'delete'])->name('delete');

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

            Route::get('/create', [LotteryController::class, 'createForm'])->name('create');

            Route::post('/create', [LotteryController::class, 'create'])->name('create');

            Route::get('/update/{lottery}', [LotteryController::class, 'updateForm'])->name('update');

            Route::post('/update/{lottery}', [LotteryController::class, 'update'])->name('update');

            Route::post('/enable-disable/{lottery}/{new_status}', [LotteryController::class, 'enableDisable'])->name('enable-disable');

            Route::delete('/delete/{lottery}', [LotteryController::class, 'delete'])->name('delete');

        });

        Route::post('/auth/sign-out', [AuthController::class, 'signOut'])->name('auth.sign-out');

    });


});
