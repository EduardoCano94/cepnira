<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ValidacionController;

// Redirigir raíz al login
Route::get('/', fn() => redirect()->route('login'));

// Rutas de autenticación (login/logout)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    $credentials = request()->only('email', 'password');

    if (auth()->attempt($credentials)) {
        request()->session()->regenerate();
        return redirect()->route('dashboard');
    }

    return back()->withErrors(['email' => 'Credenciales incorrectas.']);
})->name('login.post');

Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

// Rutas protegidas
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Secretaria, subdirector y director pueden gestionar alumnos
    Route::middleware('rol:secretaria,subdirector,director')->group(function () {
        Route::get('alumnos/{alumno}/print', [AlumnoController::class, 'print'])->name('alumnos.print');
Route::resource('alumnos', AlumnoController::class);
    });

    // Solo director y subdirector validan expedientes
    Route::middleware('rol:director,subdirector')->group(function () {
        Route::get('/validacion', [ValidacionController::class, 'index'])->name('validacion.index');
        Route::post('/validacion/validar', [ValidacionController::class, 'validar'])->name('validacion.validar');
        Route::post('/validacion/rechazar', [ValidacionController::class, 'rechazar'])->name('validacion.rechazar');
    });

});