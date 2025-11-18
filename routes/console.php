<?php

use App\InsuranceReminder;
use App\Mail\SendInsuranceReminder;
use App\Models\Insurance;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('mail:send-test', function () {
    $insurance = Insurance::firstWhere('id', 1);

    Mail::to($insurance?->customer?->email ?? $insurance?->company?->email)
        ->send(new SendInsuranceReminder($insurance));
});

Artisan::command('mail:raw-test', function () {
    Mail::raw('Testing mail', function ($message) {
        $message->to('frank@cyclux.com')
            ->subject('Test Mail');
    });
});

//Schedule::call(new InsuranceReminder())->everyMinute();
Schedule::command('sms:insurance-reminders')->everyMinute();

Schedule::command('email:insurance-reminders')
    ->daily()
    ->withoutOverlapping();

Schedule::command('sms:insurance-reminders')
    ->dailyAt('08:00') // run every day at 8 AM
    ->withoutOverlapping()
    ->onOneServer()
    ->runInBackground()
    ->sendOutputTo(storage_path('logs/insurance_reminders.log'));
