<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TechnicienController;
use App\Http\Controllers\CommentaireController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/api/supervision', [App\Http\Controllers\SupervisionController::class, 'store']);

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    

// Routes profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes étudiant
Route::middleware(['auth', 'role:etudiant'])->group(function () {
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
});

// Routes communes — APRÈS create pour éviter le conflit
Route::middleware('auth')->group(function () {
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/commentaires', [CommentaireController::class, 'store'])->name('commentaires.store');
});

// Routes technicien
Route::middleware(['auth', 'role:technicien'])->group(function () {
    Route::get('/technicien/tickets', [TechnicienController::class, 'index'])->name('technicien.index');
    Route::patch('/technicien/tickets/{ticket}', [TechnicienController::class, 'updateStatut'])->name('technicien.updateStatut');
});

require __DIR__.'/auth.php';