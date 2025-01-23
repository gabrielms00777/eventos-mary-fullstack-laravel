<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');
Volt::route('/admin/users', 'users.index');

Route::middleware(['auth'])->group(function () {

    /**
     * Rotas do Administrador (Admin)
     * Prefixo: /admin
     * Nomeação: admin.*
     */
    Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {
        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
        Route::view('/events', 'admin.events.index')->name('events.index');
        Route::view('/events/create', 'admin.events.create')->name('events.create');
        Route::view('/events/{uuid}/edit', 'admin.events.edit')->name('events.edit');
        Route::view('/reports', 'admin.reports.index')->name('reports.index');
    });

    /**
     * Rotas do Dono do Evento (Event Owner)
     * Prefixo: /event-owner/{uuid}
     * Nomeação: event_owner.*
     */
    Route::prefix('event-owner/{uuid}')->name('event_owner.')->middleware(['event_owner'])->group(function () {
        Route::view('/dashboard', 'event_owner.dashboard')->name('dashboard');
        Route::view('/participants', 'event_owner.participants.index')->name('participants.index');
        Route::view('/participants/create', 'event_owner.participants.create')->name('participants.create');
        Route::view('/qrcode', 'event_owner.qrcode')->name('qrcode');
    });

    /**
     * Rotas do Funcionário (Funcionario)
     * Prefixo: /funcionario/{uuid}
     * Nomeação: funcionario.*
     */
    Route::prefix('funcionario/{uuid}')->name('funcionario.')->middleware(['funcionario'])->group(function () {
        Route::view('/dashboard', 'funcionario.dashboard')->name('dashboard');
        Route::view('/checkin', 'funcionario.checkin')->name('checkin');
        Route::view('/manual-checkin', 'funcionario.manual_checkin')->name('manual.checkin');
    });
});
