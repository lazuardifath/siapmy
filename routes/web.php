<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;

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
Route::get('/', function () {return view('home');});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('register', [RegisterController::class, 'register']);

Route::get('password/forget', function () {
    return view('pages.forgot-password');
})->name('password.forget');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Routes that require a complete profile

Route::group(['middleware' => 'auth'], function () {
    // logout route
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/clear-cache', [HomeController::class, 'clearCache']);
    Route::resource('start-cbt', SesiController::class);

    Route::get('/start-cbt', [SesiController::class, 'index'])->name('start-cbt.index');
    Route::get('/start-cbt/delete/{id}', [SesiController::class, 'delete'])->name('start-cbt.delete');
    Route::get('/start-cbt/create', [SesiController::class, 'create'])->name('start-cbt.create');
    Route::post('/start-cbt/store', [SesiController::class, 'store'])->name('start-cbt.store');
    Route::get('/start-cbt/edit/{id}', [SesiController::class, 'edit'])->name('start-cbt.edit');
    Route::put('/start-cbt/update/{id}', [SesiController::class, 'update'])->name('start-cbt.update');

    // dashboard route
    Route::group(['middleware' => 'profile.complete'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
    //only those have manage_user permission will get access
    Route::group(['middleware' => 'can:manage_user'], function () {
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/user/get-list', [UserController::class, 'getUserList']);
        Route::get('/user/create', [UserController::class, 'create']);
        Route::post('/user/create', [UserController::class, 'store'])->name('create-user');
        Route::get('/user/{id}', [UserController::class, 'edit'])->name('edit-user');
        Route::post('/user/update', [UserController::class, 'update']);
        Route::get('/user/delete/{id}', [UserController::class, 'delete']);
    });

    Route::group(['middleware' => 'can:edit_profile'], function () {

        Route::get('/user/{id}', [UserController::class, 'edit'])->name('edit-user');
        Route::post('/user/update', [UserController::class, 'update']);
    });

    //only those have manage_role permission will get access
    Route::group(['middleware' => 'can:manage_role|manage_user'], function () {
        Route::get('/roles', [RolesController::class, 'index']);
        Route::get('/role/get-list', [RolesController::class, 'getRoleList']);
        Route::post('/role/create', [RolesController::class, 'create']);
        Route::get('/role/edit/{id}', [RolesController::class, 'edit']);
        Route::post('/role/update', [RolesController::class, 'update']);
        Route::get('/role/delete/{id}', [RolesController::class, 'delete']);
    });

    //only those have manage_permission permission will get access
    Route::group(['middleware' => 'can:manage_permission|manage_user'], function () {
        Route::get('/permission', [PermissionController::class, 'index']);
        Route::get('/permission/get-list', [PermissionController::class, 'getPermissionList']);
        Route::post('/permission/create', [PermissionController::class, 'create']);
        Route::get('/permission/update', [PermissionController::class, 'update']);
        Route::get('/permission/delete/{id}', [PermissionController::class, 'delete']);
    });

    // get permissions
    Route::get('get-role-permissions-badge', [PermissionController::class, 'getPermissionBadgeByRole']);

    // Basic demo routes
    Route::group(['middleware' => 'can:manage_template'], function () {
        include ('modules/demo.php');
    });

    Route::get('/login-1', function () { return view('pages.login'); });
});
