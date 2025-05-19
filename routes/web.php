<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/employees', function () {
    return view('employees.index');
})->name('employees.index');

Route::get('/employees/create', function () {
    return view('employees.create');
})->name('employees.create');

// Route pour la page "À propos"
Route::get('/about', function () {
    return view('about');
})->name('about');

// Route pour la déconnexion
Route::post('/logout', function () {
    // Logique de déconnexion
    return redirect('/');
})->name('logout');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/agents', function () {
    return view('agents.index');
})->name('agents.index');

Route::get('/modules', function () {
    return view('modules.index');
})->name('modules.index');

Route::get('/session', function () {
    return view('session.index');
})->name('session.index');

Route::get('/suivi-formation', function () {
    return view('suivi-formation.index');
})->name('suivi-formation.index');

Route::get('/suivi-qualite', function () {
    return view('suivi-qualite.index');
})->name('suivi-qualite.index');
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ModulesController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SuiviFormationController;

Route::get('/sulvi-formation', function () {
    return view('sulvi-formation.index');
})->name('sulvi-formation.index');

Route::get('/sulvi-qualite', function () {
    return view('sulvi-qualite.index');
})->name('sulvi-qualite.index');

Route::resource('services', ServiceController::class);
Route::resource('agents', AgentController::class);
Route::resource('modules', ModulesController::class);
Route::resource('session', SessionController::class);
Route::post('/session/{session}/add-agent', [SessionController::class, 'addAgent'])->name('session.add-agent');
Route::post('/session/{session}/remove-agent', [SessionController::class, 'removeAgent'])->name('session.remove-agent');
Route::get('/suivi-formation', [SuiviFormationController::class, 'index'])->name('suivi-formation.index');
Route::get('/suivi-formation/update-statuts', [SuiviFormationController::class, 'updateStatuts'])->name('suivi-formation.update-statuts');
// web.php
// web.php
use App\Http\Controllers\SuiviQualiteController;

use App\Http\Controllers\AuthController;

// Routes pour l'authentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout'); // Version GET pour faciliter le développement

// Autres routes de votre application


Route::get('/about', function () {
    return view('about');
})->name('about');

// Routes protégées
Route::middleware(['auth'])->group(function () {
    // Vos routes qui nécessitent une authentification
});
// routes/web.php

Route::resource('suivi-qualite', SuiviQualiteController::class);
// Ou vérifiez la route spécifique de mise à jour
// Dans web.php - si vous définissez les routes manuellement
// Route::get('suivi-qualite/{suiviqualite}/edit', [SuiviQualiteController::class, 'edit'])->name('suivi-qualite.edit');
// Route::put('suivi-qualite/{suiviqualite}', [SuiviQualiteController::class, 'update'])->name('suivi-qualite.update');
Route::post('/suivi-formation/update-statut/{id}', [SuiviFormationController::class, 'updateStatut'])
    ->name('suivi-formation.update-statut');
    Route::get('/gestion-rib', [App\Http\Controllers\GestionRibController::class, 'index'])->name('gestion-rib.index');
Route::post('/gestion-rib/store', [App\Http\Controllers\GestionRibController::class, 'store'])->name('gestion-rib.store');
Route::put('/gestion-rib/{id}', [App\Http\Controllers\GestionRibController::class, 'update'])->name('gestion-rib.update');
Route::delete('/gestion-rib/{id}', [App\Http\Controllers\GestionRibController::class, 'destroy'])->name('gestion-rib.destroy');
Route::resource('gestion-rib', App\Http\Controllers\GestionRibController::class);
// Ajoutez ces routes à votre fichier routes/web.php


Route::get('/api/agents', [App\Http\Controllers\SuiviCongeController::class, 'getAgents'])->name('api.agents');
Route::get('/suivi-conge', [App\Http\Controllers\SuiviCongeController::class, 'index'])->name('suivi-conge.index');
Route::post('/suivi-conge', [App\Http\Controllers\SuiviCongeController::class, 'store'])->name('suivi-conge.store');
Route::delete('/suivi-conge', [App\Http\Controllers\SuiviCongeController::class, 'destroy'])->name('suivi-conge.destroy');
Route::get('/suivi-conge/report', [App\Http\Controllers\SuiviCongeController::class, 'report'])->name('suivi-conge.report');
Route::get('/api/agents', [App\Http\Controllers\SuiviCongeController::class, 'getAgents'])->name('api.agents');
// Routes à ajouter dans routes/web.php
Route::get('/suivi-conge', [App\Http\Controllers\SuiviCongeController::class, 'index'])->name('suivi-conge.index');
Route::post('/suivi-conge/store', [App\Http\Controllers\SuiviCongeController::class, 'store'])->name('suivi-conge.store');
Route::post('/suivi-conge/destroy', [App\Http\Controllers\SuiviCongeController::class, 'destroy'])->name('suivi-conge.destroy');
Route::get('/suivi-conge/report', [App\Http\Controllers\SuiviCongeController::class, 'report'])->name('suivi-conge.report');

// Route API pour récupérer les agents
Route::get('/api/agents', [App\Http\Controllers\SuiviCongeController::class, 'getAgents']);
// Remplacer cette route
Route::get('/', function () {
    return view('home');
})->name('home');

// Par celle-ci
Route::get('/', function () {
    return redirect()->route('employees.index');
})->name('home');
// Toutes les importations d'abord
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MonthController;

// Ensuite les définitions de routes
Route::resource('employees', EmployeeController::class);
Route::post('/employees/add-month', [EmployeeController::class, 'addMonthColumn'])
    ->name('employees.add-month');
Route::get('/months/create', [MonthController::class, 'create'])->name('months.create');
Route::post('/months', [MonthController::class, 'store'])->name('months.store');
Route::get('/employees/{employee}/monthly-leave/{month}/{year}/edit', [EmployeeController::class, 'editMonthlyLeave'])
    ->name('employees.edit-monthly-leave');
Route::put('/employees/{employee}/monthly-leave', [EmployeeController::class, 'updateMonthlyLeave'])
    ->name('employees.update-monthly-leave');
   
    Route::post('suivi-conge/delete', [App\Http\Controllers\SuiviCongeController::class, 'destroy'])->name('suivi-conge.delete');