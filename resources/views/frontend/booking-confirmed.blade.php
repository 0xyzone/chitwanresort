@extends('frontend.layouts.app')

@section('title', 'Reservation Received | Sishwar Chitwan Tiger Resort')

@section('content')

<div class="py-16 sm:py-24 bg-[#faf8f5]">
    <div class="max-w-2xl mx-auto px-4 sm:px-6">
        <div class="bg-white p-8 sm:p-12 rounded-3xl border border-stone-200 shadow-xl text-center">
            
            <!-- Success Icon -->
            <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-4xl mx-auto mb-6 shadow-inner">
                ✓
            </div>

            <span class="text-xs font-bold uppercase tracking-widest text-orange-600 block mb-2">
                Reservation Request Received
            </span>
            <h1 class="text-3xl sm:text-4xl font-bold font-serif-title text-stone-900 mb-3">
                Namaste, {{ $booking->guest_name }}!
            </h1>
            <p class="text-stone-600 text-sm sm:text-base mb-8">
                Your direct reservation request has been registered in our resort system. 
                Our front desk team will contact you shortly to confirm your arrival and finalize details.
            </p>

            <!-- Booking Summary Box -->
            <div class="bg-stone-50 border border-stone-200/80 rounded-2xl p-6 text-left space-y-3 mb-8">
                <div class="flex justify-between items-center pb-3 border-b border-stone-200">
                    <span class="text-xs text-stone-500 uppercase font-semibold">Booking Reference</span>
                    <span class="text-base font-bold text-orange-600 font-mono tracking-wider">{{ $booking->booking_code }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-stone-600">Reserved Room:</span>
                    <span class="font-bold text-stone-900">{{ $booking->room?->name }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-stone-600">Check-In:</span>
                    <span class="font-bold text-stone-900">{{ $booking->check_in_date->format('M d, Y') }} (12:00 PM)</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-stone-600">Check-Out:</span>
                    <span class="font-bold text-stone-900">{{ $booking->check_out_date->format('M d, Y') }} (11:00 AM)</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-stone-600">Duration & Guests:</span>
                    <span class="font-bold text-stone-900">{{ $booking->nights }} Night(s), {{ $booking->adults }} Adults</span>
                </div>
                <div class="flex justify-between items-center pt-3 border-t border-stone-200 font-bold">
                    <span class="text-stone-800">Total Payable at Resort:</span>
                    <span class="text-xl text-orange-600 font-serif-title">NPR {{ number_format($booking->total_amount) }}</span>
                </div>
            </div>

            <!-- WhatsApp Direct Confirmation Button -->
            <div class="space-y-3">
                <a href="{{ $booking->whatsapp_url }}" target="_blank" class="w-full py-4 px-6 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-md hover:shadow-lg transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    <span>Instant Confirm on WhatsApp Desk</span>
                </a>
                <a href="{{ route('home') }}" class="block text-center text-xs text-stone-500 hover:text-stone-800 transition py-2">
                    Return to Homepage
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
