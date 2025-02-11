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
        Route::get('/dashboard', Company\Dashboard\Index::class)->name('dashboard');

        Route::get('/eventos', Company\Events\Index::class)->name('events.index');
        Route::get('/eventos/{event}/edit', Company\Events\Edit::class)->name('events.edit');

        Route::get('/eventos/funcionarios', Company\Events\Employees::class)->name('events.employees');
        Route::get('/eventos/visitantes', Company\Events\Visitors::class)->name('events.visitors');
        Route::get('/eventos/expositores', Company\Events\Exhibitors::class)->name('events.exhibitors');

        Route::get('/funcionarios', Company\Employees\Index::class)->name('employees.index');
        Route::get('/funcionarios/create', Company\Employees\Create::class)->name('employees.create');

        Route::get('/visitantes', Company\Visitors\Index::class)->name('visitors.index');
        Route::get('/visitantes/create', Company\Visitors\Create::class)->name('visitors.create');

        Route::get('/expositores', Company\Exhibitors\Index::class)->name('exhibitors.index');
        Route::get('/expositores/create', Company\Exhibitors\Create::class)->name('exhibitors.create');

        Route::get('/perfil', Company\Profile::class)->name('profile');
        Route::get('/meu-perfil', Company\MyProfile::class)->name('my-profile');
        Route::get('/acessos', Company\Access\Index::class)->name('access.index');
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
