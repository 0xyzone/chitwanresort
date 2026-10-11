<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    public function getWhatsAppUrlAttribute(): ?string
    {
        if (blank($this->phone)) {
            return null;
        }

        $phone = preg_replace('/[^0-9]/', '', (string) $this->phone);
        if (str_starts_with($phone, '0')) {
            $phone = '977'.substr($phone, 1);
        } elseif (! str_starts_with($phone, '977') && strlen($phone) === 10) {
            $phone = '977'.$phone;
        }

        $text = "Namaste {$this->name}! Greetings from Sishwar Chitwan Tiger Resort.\n\n"
            ."Thank you for reaching out regarding '{$this->subject}'. We received your message and would love to help you plan your stay with us.";

        return 'https://wa.me/'.$phone.'?text='.urlencode($text);
    }
}
