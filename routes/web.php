<?php

use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Auth::loginUsingId(1);

Route::view('/', 'home');
Volt::route('/admin/users', 'users.index');

Volt::route('/login', 'login')->name('auth.login');
Volt::route('/register', 'register')->name('auth.register');
Route::view('/eventos', 'public.events')->name('events.public');
Route::view('/eventos/{event}', 'public.event')->name('event.show');

Route::get('/logout', LogoutController::class)->name('auth.logout');

Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->name('admin.')->middleware(['role:admin'])->group(function () {
        Route::view('/', 'admin.dashboard')->name('dashboard');
        Route::view('/empresas', 'admin.companies.index')->name('companies.index');
        Route::view('/empresas/create', 'admin.companies.create')->name('companies.create');
        Route::view('/empresas/{company}/edit', 'admin.companies.edit')->name('companies.edit');
        Route::view('/eventos', 'admin.events.index')->name('events.index');
        Route::view('/eventos/create', 'admin.events.create')->name('events.create');
        Route::view('/eventos/{event}/edit', 'admin.events.edit')->name('events.edit');
        Route::view('/relatorios', 'admin.reports.index')->name('reports.index');
    });

    Route::prefix('empresa')->name('company.')->middleware(['role:company'])->group(function () {
        Route::view('/dashboard', 'company.dashboard')->name('dashboard');
        Route::view('/eventos', 'company.events.index')->name('events.index');
        Route::view('/eventos/{event}/edit', 'company.events.edit')->name('events.edit');
        Route::view('/funcionarios', 'company.employees.index')->name('employees.index');
        Route::view('/visitantes', 'company.visitors.index')->name('visitors.index');
        Route::view('/expositores', 'company.exhibitors.index')->name('exhibitors.index');
    });

    Route::prefix('funcionario')->name('employee.')->middleware(['role:employee'])->group(function () {
        Route::view('/dashboard', 'employee.dashboard')->name('dashboard');
        Route::view('/eventos', 'employee.events.index')->name('events.index');
        Route::view('/check-in', 'employee.checkin.index')->name('checkin.index');
    });

    Route::prefix('visitante')->name('visitor.')->middleware(['role:visitor'])->group(function () {
        Route::view('/dashboard', 'visitor.dashboard')->name('dashboard');
        Route::view('/meus-eventos', 'visitor.events.index')->name('events.index');
        Route::view('/check-in', 'visitor.checkin.index')->name('checkin.index');
    });
});
