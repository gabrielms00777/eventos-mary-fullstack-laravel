<?php

use App\Enums\UserTypeEnum;
use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Admin;
use App\Livewire\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Auth::loginUsingId(2);

Route::view('/', 'home');

Volt::route('/login', 'login')->name('login');
Volt::route('/register', 'register')->name('auth.register');
Route::view('/eventos', 'public.events')->name('events.public');
Route::view('/eventos/{event}', 'public.event')->name('event.show');

Route::get('/logout', LogoutController::class)->name('auth.logout');

Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->name('admin.')->middleware(['role:' . UserTypeEnum::ADMIN->value])->group(function () {
        Volt::route('/dashboard', 'admin.dashboard')->name('dashboard');
        Volt::route('/users', 'admin.users.index')->name('users.index');
        Volt::route('/empresas', Admin\Companies\Index::class)->name('companies.index');
        Volt::route('/empresas/create', Admin\Companies\Create::class)->name('companies.create');
        Volt::route('/empresas/{company}/edit', Admin\Companies\Edit::class)->name('companies.edit');
        Volt::route('/eventos', 'admin.events.index')->name('events.index');
        Volt::route('/eventos/create', 'admin.events.create')->name('events.create');
        Volt::route('/eventos/{event}/edit', 'admin.events.edit')->name('events.edit');
        Volt::route('/relatorios', 'admin.reports.index')->name('reports.index');
    });

    Route::prefix('empresa')->name('company.')->middleware(['role:' . UserTypeEnum::MANAGER->value])->group(function () {
        Volt::route('/dashboard', Company\Dashboard\Index::class)->name('dashboard');
        Volt::route('/eventos', 'company.events.index')->name('events.index');
        Volt::route('/eventos/{event}/edit', 'company.events.edit')->name('events.edit');
        Volt::route('/funcionarios', 'company.employees.index')->name('employees.index');
        Volt::route('/funcionarios/create', 'company.employees.create')->name('employees.create');
        Volt::route('/visitantes', 'company.visitors.index')->name('visitors.index');
        Volt::route('/visitantes/create', 'company.visitors.create')->name('visitors.create');
        Volt::route('/expositores', 'company.exhibitors.index')->name('exhibitors.index');
        Volt::route('/expositores/create', 'company.exhibitors.create')->name('exhibitors.create');
        Volt::route('/perfil', 'company.profile')->name('profile');
    });

    Route::prefix('funcionario')->name('employee.')->middleware(['role:' . UserTypeEnum::EMPLOYEE->value])->group(function () {
        Volt::route('/dashboard', 'employee.dashboard')->name('dashboard');
        Volt::route('/eventos', 'employee.events.index')->name('events.index');
        Volt::route('/check-in', 'employee.checkin.index')->name('checkin.index');
    });

    Route::prefix('visitante')->name('visitor.')->middleware(['role:' . UserTypeEnum::VISITOR->value])->group(function () {
        Volt::route('/dashboard', 'visitor.dashboard')->name('dashboard');
        Volt::route('/meus-eventos', 'visitor.events.index')->name('events.index');
        Volt::route('/check-in', 'visitor.checkin.index')->name('checkin.index');
    });
});
