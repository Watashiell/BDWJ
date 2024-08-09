<?php

use App\Http\Controllers\ProfileController;
// Remove the duplicate import statement
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RiskController;


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Add the following code after the existing code
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/forms', function () {
        return view('admin.forms');
    })->name('admin.forms');
    Route::get('/tables', function () {
        return view('admin.tables');
    })->name('admin.tables');
    Route::get('/ui-elements', function () {
        return view('admin.ui-elements');
    })->name('admin.ui-elements');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
});

require __DIR__.'/auth.php';

Route::get('/admin/risk/context', [RiskController::class, 'context'])->name('admin.risk.context');
Route::get('/admin/risk/identification', [RiskController::class, 'identification'])->name('admin.risk.identification');
Route::get('/admin/risk/analysis', [RiskController::class, 'analysis'])->name('admin.risk.analysis');
Route::get('/admin/risk/evaluation', [RiskController::class, 'evaluation'])->name('admin.risk.evaluation');
Route::get('/admin/risk/action_plan', [RiskController::class, 'actionPlan'])->name('admin.risk.action_plan');
// Route::get('/', function () {
//     return view('auth.login');
// });


// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/admin', function () {
//         return view('admin.dashboard');
//     })->name('dashboard');

//     // Add the following route to redirect to the admin dashboard
//     Route::get('/admin', function () {
//         return view('admin.dashboard');
//     })->name('admin.dashboard');
// });



// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::group(['middleware' => ['role:admin']], function () {
//     Route::get('/forms', function () {
//         return view('admin.forms');
//     })->name('admin.forms');
//     Route::get('/tables', function () {
//         return view('admin.tables');
//     })->name('admin.tables');
//     Route::get('/ui-elements', function () {
//         return view('admin.ui-elements');
//     })->name('admin.ui-elements');
// });

// Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
//     Route::resource('users', UserController::class);
//     Route::resource('roles', RoleController::class);
//     Route::resource('permissions', PermissionController::class);
// });

// require __DIR__.'/auth.php';

// Route::get('/admin/risk/context', [RiskController::class, 'context'])->name('admin.risk.context');
// Route::get('/admin/risk/identification', [RiskController::class, 'identification'])->name('admin.risk.identification');
// Route::get('/admin/risk/analysis', [RiskController::class, 'analysis'])->name('admin.risk.analysis');
// Route::get('/admin/risk/evaluation', [RiskController::class, 'evaluation'])->name('admin.risk.evaluation');
// Route::get('/admin/risk/action_plan', [RiskController::class, 'actionPlan'])->name('admin.risk.action_plan');