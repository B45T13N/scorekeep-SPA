<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocalTeamController;
use App\Http\Controllers\VolunteerController;

Route::get('matchs/{localTeamId}', [GameController::class, 'index'])->name('games.index');
Route::post('volunteers/store', [VolunteerController::class, 'store'])->name('volunteers.store');
Route::get('/teams', [LocalTeamController::class, 'index'])->name('teams.index');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/matchs', [DashboardController::class, 'matchsIndex'])->name('dashboard.matchs.index');
    Route::get('/dashboard/matchs/add', [DashboardController::class, 'addMatch'])->name('dashboard.match.add');
    Route::post('/dashboard/matchs/add', [DashboardController::class, 'storeMatch'])->name('dashboard.match.store');
    Route::get('/dashboard/matchs/{uuid}', [DashboardController::class, 'matchShow'])->name('dashboard.match.show');
    Route::patch('/dashboard/matchs/{uuid}', [DashboardController::class, 'matchEdit'])->name('dashboard.match.edit');
    Route::patch('/dashboard/matchs/cancel/{uuid}', [DashboardController::class, 'matchCancel'])->name('dashboard.match.cancel');
    Route::patch('/dashboard/matchs/confirm/{uuid}', [DashboardController::class, 'matchConfirm'])->name('dashboard.match.confirm');
    Route::delete('/dashboard/matchs/{uuid}', [DashboardController::class, 'matchDelete'])->name('dashboard.match.delete');
    Route::get('/dashboard/volunteers', [DashboardController::class, 'volunteers'])->name('dashboard.volunteers');
    Route::post('/dashboard/volunteers', [DashboardController::class, 'storeVolunteers'])->name('dashboard.volunteers.store');
});
