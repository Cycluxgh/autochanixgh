<?php

namespace App\Console\Commands;

use App\Models\Insurance;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendSMSInsuranceReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:insurance-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send insurance renewal reminders to customers nearing expiration via sms';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Define how many days ahead to remind
        $daysAhead = 7;

        // Fetch insurances expiring within next 7 days
        $insurances = Insurance::with(['customer', 'company'])
            ->whereBetween('expiration', [now(), now()->addDays($daysAhead)])
            ->get();

        if ($insurances->isEmpty()) {
            $this->info('No insurance policies require reminders today.');
            return 0;
        }

        $this->info("Sending reminders for {$insurances->count()} insured vehicles...");

        // Prepare base message
        $messageTemplate = "Reminder: Your insurance policy will expire soon. Renew before :date to stay covered. - Autochanix";

        // Process in chunks to avoid overloading API
        $insurances->chunk(50)->each(function ($chunk) use ($messageTemplate, $daysAhead) {
            // Collect phone numbers from either customer or company
            $recipients = $chunk->map(function ($insurance) {
                return $insurance->customer?->phone ?? $insurance->company?->phone;
            })->filter()->unique()->values()->toArray();

            if (empty($recipients)) {
                Log::warning('No valid phone numbers found for reminder chunk.');
                return;
            }

            // Create dynamic message
            $message = str_replace(':date', now()->addDays($daysAhead)->format('M d, Y'), $messageTemplate);

            try {
                $response = Http::asForm()->post(config('app.mnotify_base_url') . '/api/sms/quick', [
                    'key' => config('app.mnotify_key'),
                    'recipient' => $recipients,
                    'sender' => 'Tailorinhub',
                    'message' => $message,
                ]);

                if ($response->failed()) {
                    Log::error('Failed to send insurance reminders', [
                        'response' => $response->body(),
                        'recipients' => $recipients,
                    ]);
                } else {
                    Log::info('Insurance reminders sent successfully.', [
                        'count' => count($recipients),
                        'recipients' => $recipients,
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('Exception while sending insurance reminders', [
                    'error' => $e->getMessage(),
                ]);
            }
        });

        $this->info('All reminders processed successfully.');
        return 0;
    }


}
