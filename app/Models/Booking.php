<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'check_in_date' => 'date',
            'check_out_date' => 'date',
            'adults' => 'integer',
            'children' => 'integer',
            'total_amount' => 'decimal:2',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Booking $booking): void {
            if (blank($booking->booking_code)) {
                $booking->booking_code = 'SCTR-'.strtoupper(Str::random(6));
            }
        });
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function getNightsAttribute(): int
    {
        if ($this->check_in_date && $this->check_out_date) {
            return max(1, $this->check_in_date->diffInDays($this->check_out_date));
        }

        return 1;
    }

    public function getWhatsAppUrlAttribute(): string
    {
        $phone = preg_replace('/[^0-9]/', '', (string) $this->guest_phone);
        if (str_starts_with($phone, '0')) {
            $phone = '977'.substr($phone, 1);
        } elseif (! str_starts_with($phone, '977') && strlen($phone) === 10) {
            $phone = '977'.$phone;
        }

        $text = "Namaste {$this->guest_name}! Greetings from Sishwar Chitwan Tiger Resort (Devchuli, Nawalpur).\n\n"
            ."We have received your reservation #{$this->booking_code} for {$this->room?->name}.\n"
            ."Dates: {$this->check_in_date?->format('M d, Y')} to {$this->check_out_date?->format('M d, Y')}.\n"
            .'Status: '.ucfirst($this->status).".\n\n"
            .'How may we assist you with arrival pickup or jungle safari activities?';

        return 'https://wa.me/'.$phone.'?text='.urlencode($text);
    }
}
