<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

#[Signature('notify:task {message? : Optional notification text} {--title= : Custom notification title}')]
#[Description('Send a task completion push notification to the administrator via ntfy.sh')]
class SendTaskNotification extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $server = rtrim((string) config('services.ntfy.server', 'https://ntfy.sh'), '/');
        $topic = (string) config('services.ntfy.topic', 'chitwan-resort-9802350986');

        if (blank($topic)) {
            $this->warn('ntfy topic is not configured.');

            return self::FAILURE;
        }

        $title = $this->option('title') ?: 'Chitwan Resort — Task Completed';
        $message = $this->argument('message')
            ?: 'All code changes, Pint formatting, test suites, and git push to main succeeded.';

        $this->info("Sending push notification to {$server}/{$topic}...");

        try {
            $response = Http::timeout(10)
                ->withHeaders([
                    'Title' => $title,
                    'Priority' => 'high',
                    'Tags' => 'white_check_mark,sparkles',
                    'Click' => 'https://github.com/0xyzone/chitwanresort',
                ])
                ->post("{$server}/{$topic}", $message);

            if ($response->successful()) {
                $this->info('Push notification delivered successfully via ntfy.sh!');

                return self::SUCCESS;
            }

            $this->error("ntfy returned an error: HTTP {$response->status()} - {$response->body()}");
            Log::warning('ntfy notification error', ['response' => $response->body()]);

            return self::FAILURE;
        } catch (\Throwable $e) {
            $this->error("Failed to connect to ntfy: {$e->getMessage()}");
            Log::error('ntfy dispatch exception', ['exception' => $e]);

            return self::FAILURE;
        }
    }
}
