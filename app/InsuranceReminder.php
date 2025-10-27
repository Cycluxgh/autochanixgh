<?php

namespace App;

use App\Mail\SendInsuranceReminder;
use App\Models\Insurance;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class InsuranceReminder
{
    /**
     * Create a new class instance.
     */
    public function __invoke()
    {
        $insurances = Insurance::whereBetween('expiration', [now(), now()->addDays(7)])->get();

        Log::info('Found insurances to remind', ['count' => $insurances->count()]);

        foreach ($insurances as $insurance) {
            Mail::to($insurance?->customer?->email ?? $insurance?->company?->email)
                ->send(new SendInsuranceReminder($insurance));
        }
    }
}
