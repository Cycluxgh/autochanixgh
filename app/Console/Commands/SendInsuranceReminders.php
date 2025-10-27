<?php

namespace App\Console\Commands;

use App\InsuranceReminder;
use App\Mail\SendInsuranceReminder;
use App\Models\Insurance;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendInsuranceReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insurance:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send insurance renewal reminders to customers nearing expiration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $insurances = Insurance::whereBetween('expiration', [now(), now()->addDays(7)])->get();

        if ($insurances->isEmpty()) {
            $this->info('No insurance policies require reminders today.');
            return 0;
        }

        $this->info("Sending reminders for {$insurances->count()} insurance policies...");

        foreach ($insurances as $insurance) {
            $recipient = $insurance->customer?->email ?? $insurance->company?->email;

            if ($recipient) {
                Mail::to($recipient)->send(new SendInsuranceReminder($insurance));
                $this->line("Sent reminder to: {$recipient}");
            } else {
                $this->warn("No recipient email for insurance ID: {$insurance->id}");
            }
        }

        Log::info("Insurance reminders sent successfully.", ['count' => $insurances->count()]);
        $this->info('Done!');

        return 0;
    }
}
