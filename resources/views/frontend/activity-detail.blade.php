@extends('frontend.layouts.app')

@section('title', $activity->title . ' | Sishwar Chitwan Tiger Resort')
@section('meta_description', $activity->excerpt)

@section('content')

<!-- Header -->
<div class="bg-[#14281d] text-white py-16 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <a href="{{ route('activities.index') }}" class="text-xs font-semibold uppercase tracking-widest text-[#f08235] hover:underline mb-3 inline-flex items-center gap-1.5 transition">
            ← Back to Safari Expeditions
        </a>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mt-2">
            <div>
                <h1 class="text-3xl sm:text-5xl font-normal font-serif-luxury text-white">{{ $activity->title }}</h1>
                <p class="text-stone-300 text-xs sm:text-sm mt-2 font-light">
                    ⏱️ {{ $activity->duration }} • {{ $activity->difficulty }}
                </p>
            </div>
            @if($activity->price_per_person)
                <div class="text-left md:text-right bg-white/10 backdrop-blur-md p-5 rounded-2xl border border-white/10">
                    <span class="text-[11px] text-stone-300 block uppercase font-bold tracking-wider">Per Person</span>
                    <span class="text-3xl font-normal text-amber-200 font-serif-luxury">NPR {{ number_format($activity->price_per_person) }}</span>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 bg-[#fcfbf9]">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        <!-- Left: 7 Columns - Media & Itinerary -->
        <div class="lg:col-span-7 space-y-10">
            <div class="rounded-3xl overflow-hidden luxury-shadow border border-[#eae4d8] group">
                <img src="{{ $activity->featured_image_url }}" alt="{{ $activity->title }}" class="w-full h-96 sm:h-[480px] object-cover group-hover:scale-105 transition-transform duration-700">
            </div>

            <div class="bg-white p-8 sm:p-10 rounded-3xl border border-[#eae4d8] luxury-shadow">
                <span class="text-xs font-bold uppercase tracking-widest text-[#c25e19] mb-2 block">Expedition Details</span>
                <h2 class="text-2xl sm:text-3xl font-normal font-serif-luxury text-stone-900 mb-6">Program & Nature Highlights</h2>
                <div class="prose prose-stone text-sm sm:text-base leading-relaxed text-stone-600 font-light space-y-4">
                    <p class="text-base sm:text-lg font-medium text-stone-800 font-serif-luxury leading-relaxed">{{ $activity->excerpt }}</p>
                    <div class="pt-2 text-stone-600 leading-relaxed font-light">{!! nl2br(e($activity->description)) !!}</div>
                </div>
            </div>
        </div>

        <!-- Right: 5 Columns - Quick WhatsApp Reservation Box -->
        <div class="lg:col-span-5 sticky top-28 bg-white p-8 rounded-3xl border border-[#eae4d8] luxury-shadow space-y-6">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-[#c25e19] block mb-1">Direct Safari Inquiry</span>
                <h3 class="text-2xl font-normal font-serif-luxury text-stone-900">{{ $activity->title }}</h3>
                @if($activity->price_per_person)
                    <div class="mt-2 text-2xl font-normal text-stone-900 font-serif-luxury">
                        NPR {{ number_format($activity->price_per_person) }} <span class="text-xs text-stone-500 font-light">/ person</span>
                    </div>
                @endif
            </div>

            <div class="space-y-3 text-xs sm:text-sm text-stone-600 border-t border-b border-[#eae4d8] py-5 font-light">
                <div class="flex items-center gap-3">
                    <span class="text-[#c25e19]">✓</span>
                    <span>Certified wildlife naturalist guide included</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-[#c25e19]">✓</span>
                    <span>Safety briefing and national park buffer permit</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-[#c25e19]">✓</span>
                    <span>Complimentary mineral water and binoculars on request</span>
                </div>
            </div>

            <a href="https://wa.me/9779749382246?text=Namaste%2C%20I%20would%20like%20to%20book%20the%20{{ urlencode($activity->title) }}%20experience%20at%20Sishwar%20Chitwan%20Tiger%20Resort."
               target="_blank"
               class="w-full py-4 px-6 rounded-2xl bg-emerald-700 hover:bg-emerald-800 text-white font-semibold text-xs uppercase tracking-widest shadow-md transition-all flex items-center justify-center gap-2">
                <span>Reserve on WhatsApp</span>
                <span>→</span>
            </a>

            <div class="text-center pt-2">
                <a href="tel:078545455" class="text-xs text-stone-500 hover:text-[#c25e19] font-medium transition">
                    📞 Front Desk: 078-545455 / 9749382246
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
