<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

#[Signature('notify:whatsapp {message? : Optional notification text}')]
#[Description('Send a WhatsApp notification to the administrator via CallMeBot')]
class SendTaskNotification extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $phone = config('services.callmebot.phone');
        $apikey = config('services.callmebot.apikey');

        if (blank($phone) || blank($apikey)) {
            $this->warn('CallMeBot phone or API key not configured.');

            return self::FAILURE;
        }

        $message = $this->argument('message')
            ?: "✅ Chitwan Resort Task Completed:\nAll code changes, Pint formatting, test suites, and git push to main succeeded.";

        $this->info("Sending WhatsApp notification to {$phone}...");

        try {
            $response = Http::timeout(15)->get('https://api.callmebot.com/whatsapp.php', [
                'phone' => $phone,
                'text' => $message,
                'apikey' => $apikey,
            ]);

            $body = $response->body();

            if (str_contains(strtolower($body), 'error') || str_contains(strtolower($body), 'invalid')) {
                $this->error("CallMeBot returned an issue: {$body}");
                Log::warning('CallMeBot notification warning', ['response' => $body]);

                return self::FAILURE;
            }

            $this->info('WhatsApp notification sent successfully!');

            return self::SUCCESS;
        } catch (\Throwable $e) {
            $this->error("Failed to connect to CallMeBot: {$e->getMessage()}");
            Log::error('CallMeBot dispatch exception', ['exception' => $e]);

            return self::FAILURE;
        }
    }
}
