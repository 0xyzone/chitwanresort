@extends('frontend.layouts.app')

@section('title', $activity->title . ' | Sishwar Chitwan Tiger Resort')
@section('meta_description', $activity->excerpt)

@section('content')

<!-- Header -->
<div class="bg-[#14281d] text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('activities.index') }}" class="text-xs font-semibold text-orange-400 hover:underline mb-2 inline-flex items-center gap-1">
            ← Back to All Safari Activities
        </a>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mt-2">
            <div>
                <h1 class="text-3xl sm:text-4xl font-bold font-serif-title">{{ $activity->title }}</h1>
                <p class="text-stone-300 text-sm mt-1">
                    ⏱️ {{ $activity->duration }} • {{ $activity->difficulty }}
                </p>
            </div>
            @if($activity->price_per_person)
                <div class="text-left md:text-right">
                    <span class="text-xs text-stone-400 block uppercase font-medium">Rate per person</span>
                    <span class="text-3xl font-bold text-orange-400 font-serif-title">NPR {{ number_format($activity->price_per_person) }}</span>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
        <!-- Left: 2 Columns - Media & Itinerary -->
        <div class="lg:col-span-2 space-y-10">
            <div class="rounded-3xl overflow-hidden shadow-lg border border-stone-200">
                <img src="{{ $activity->featured_image_url }}" alt="{{ $activity->title }}" class="w-full h-96 sm:h-[480px] object-cover">
            </div>

            <div class="bg-white p-8 rounded-3xl border border-stone-200/80 shadow-xs">
                <h2 class="text-2xl font-bold font-serif-title text-stone-900 mb-4">Expedition Overview</h2>
                <div class="prose prose-stone text-sm leading-relaxed text-stone-600 space-y-4">
                    <p class="text-base font-medium text-stone-800">{{ $activity->excerpt }}</p>
                    <div class="pt-2">{!! nl2br(e($activity->description)) !!}</div>
                </div>
            </div>
        </div>

        <!-- Right: 1 Column - Quick WhatsApp Reservation Box -->
        <div class="sticky top-28 bg-white p-8 rounded-3xl border-2 border-orange-500/20 shadow-xl space-y-6">
            <div>
                <span class="text-xs font-bold text-orange-600 uppercase tracking-wider block mb-1">Book This Activity</span>
                <h3 class="text-xl font-bold font-serif-title text-stone-900">{{ $activity->title }}</h3>
                @if($activity->price_per_person)
                    <div class="mt-2 text-2xl font-bold text-stone-900 font-serif-title">
                        NPR {{ number_format($activity->price_per_person) }} <span class="text-xs text-stone-500 font-normal">/ person</span>
                    </div>
                @endif
            </div>

            <div class="space-y-3 text-xs text-stone-600 border-t border-b border-stone-100 py-4">
                <div class="flex justify-between">
                    <span>Duration:</span>
                    <span class="font-bold text-stone-900">{{ $activity->duration }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Experience Type:</span>
                    <span class="font-bold text-stone-900">{{ $activity->difficulty }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Includes:</span>
                    <span class="font-bold text-stone-900">Certified Naturalist Guide</span>
                </div>
            </div>

            <a href="https://wa.me/9779749382246?text=Namaste%20Sishwar%20Resort%20Desk%2C%20I%20would%20like%20to%20reserve%20the%20{{ urlencode($activity->title) }}." 
               target="_blank" 
               class="w-full py-4 px-6 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-md transition flex items-center justify-center gap-2">
                <span>Reserve on WhatsApp (+977 9749382246)</span>
            </a>

            <a href="{{ route('contact') }}" class="block text-center text-xs text-stone-600 hover:text-stone-900 font-medium">
                Or submit an email inquiry →
            </a>
        </div>
    </div>
</div>

@endsection
