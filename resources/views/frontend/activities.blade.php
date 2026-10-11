@extends('frontend.layouts.app')

@section('title', 'Safari & Experiences | Sishwar Chitwan Tiger Resort')
@section('meta_description', 'Experience One-Horned Rhino Jeep safaris, tranquil Narayani River boating, and bird watching at Sishwar Chitwan Tiger Resort.')

@section('content')

<!-- Header Banner -->
<div class="bg-[#14281d] text-white py-16 relative overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-20">
        <img src="https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?auto=format&fit=crop&w=2000&q=80" alt="Safari Expeditions" class="w-full h-full object-cover">
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-xs font-bold uppercase tracking-widest text-orange-400 mb-2 block">Jungle & Culture</span>
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold font-serif-title mb-4">Safari & River Expeditions</h1>
        <p class="max-w-xl mx-auto text-stone-300 text-sm sm:text-base">
            Led by senior certified naturalists into the buffer zone of Chitwan National Park and the banks of the Narayani River.
        </p>
    </div>
</div>

<section class="py-16 bg-[#faf8f5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($activities as $act)
                <div class="bg-white rounded-3xl overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 border border-stone-200/80 flex flex-col sm:flex-row group">
                    <!-- Photo Column -->
                    <div class="sm:w-2/5 h-60 sm:h-auto relative overflow-hidden bg-stone-100 shrink-0">
                        <img src="{{ $act->featured_image_url }}" alt="{{ $act->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @if($act->price_per_person)
                            <div class="absolute bottom-3 left-3 px-2.5 py-1 rounded-lg bg-black/80 backdrop-blur-md text-xs font-bold text-orange-400">
                                NPR {{ number_format($act->price_per_person) }} / pers.
                            </div>
                        @endif
                    </div>

                    <!-- Details Column -->
                    <div class="p-6 sm:p-8 flex-grow flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 text-xs text-stone-500 mb-2 font-medium">
                                <span>⏱️ {{ $act->duration }}</span>
                                <span>•</span>
                                <span class="px-2 py-0.5 rounded-sm bg-orange-50 text-orange-700 font-semibold">{{ $act->difficulty }}</span>
                            </div>
                            <h3 class="text-xl font-bold font-serif-title text-stone-900 mb-3 group-hover:text-orange-600 transition-colors">
                                <a href="{{ route('activities.show', $act->slug) }}">{{ $act->title }}</a>
                            </h3>
                            <p class="text-stone-600 text-xs sm:text-sm leading-relaxed mb-6">
                                {{ $act->excerpt }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-stone-100 flex items-center justify-between">
                            <a href="{{ route('activities.show', $act->slug) }}" class="text-xs font-bold text-orange-600 hover:text-orange-700 inline-flex items-center gap-1">
                                <span>Read Full Itinerary</span>
                                <span>→</span>
                            </a>
                            <a href="https://wa.me/9779749382246?text=Namaste%2C%20I%20would%20like%20to%20book%20the%20{{ urlencode($act->title) }}%20activity." target="_blank" class="px-3 py-1.5 rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-100 text-xs font-semibold transition">
                                Book on WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
