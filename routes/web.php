<?php

use App\Livewire\Customers\Create;
use App\Livewire\Customers\Edit;
use App\Livewire\Customers\Index;
use App\Livewire\Customers\Show;
use App\Livewire\Dashboard;
use App\Livewire\Profile;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('profile', Profile::class)->name('profile');
    Route::get('customers/index', Index::class)->name('customers.index');
    Route::get('customers/create', Create::class)->name('customers.create');
    Route::get('customers/{customerId}/edit', Edit::class)->name('customers.edit');
    Route::get('customers/{customerId}/show', Show::class)->name('customers.show');

    Route::get('companies/index', \App\Livewire\Companies\Index::class)->name('companies.index');
    Route::get('companies/create', \App\Livewire\Companies\Create::class)->name('companies.create');
    Route::get('companies/{companyId}/edit', \App\Livewire\Companies\Edit::class)->name('companies.edit');
    Route::get('companies/{companyId}/show', \App\Livewire\Companies\Show::class)->name('companies.show');

    Route::get('drivers/index', \App\Livewire\Drivers\Index::class)->name('drivers.index');
    Route::get('drivers/create', \App\Livewire\Drivers\Create::class)->name('drivers.create');
    Route::get('drivers/{dvlaId}/edit', \App\Livewire\Drivers\Edit::class)->name('drivers.edit');

    Route::get('diagnosis/index', \App\Livewire\Diagnosis\Index::class)->name('diagnosis.index');
    Route::get('diagnosis/create', \App\Livewire\Diagnosis\Create::class)->name('diagnosis.create');
    Route::get('diagnosis/{diagnosisId}/edit', \App\Livewire\Diagnosis\Edit::class)->name('diagnosis.edit');
    Route::get('diagnosis/{diagnosisId}/show', \App\Livewire\Diagnosis\Show::class)->name('diagnosis.show');

    Route::get('messages/create', \App\Livewire\Messages\Create::class)->name('messages.create');
});

require __DIR__.'/auth.php';
