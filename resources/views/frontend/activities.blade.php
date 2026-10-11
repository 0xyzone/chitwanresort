@extends('frontend.layouts.app')

@section('title', 'Safari & Experiences | Sishwar Chitwan Tiger Resort')
@section('meta_description', 'Experience One-Horned Rhino Jeep safaris, tranquil Narayani River boating, and bird watching at Sishwar Chitwan Tiger Resort.')

@section('content')

<!-- Header Banner -->
<div class="bg-[#14281d] text-white py-20 relative overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-20">
        <img src="https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?auto=format&fit=crop&w=2200&q=80" alt="Safari Expeditions" class="w-full h-full object-cover">
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-xs font-bold uppercase tracking-widest text-[#f08235] mb-2 block">Jungle & Heritage</span>
        <h1 class="text-4xl sm:text-6xl font-black mb-4 tracking-tight">Safari & River Expeditions</h1>
        <p class="max-w-xl mx-auto text-stone-300 text-sm sm:text-base font-normal">
            Led by certified resident naturalists into the quiet buffer zone of Chitwan National Park and the currents of the Narayani River.
        </p>
    </div>
</div>

<section class="py-20 bg-[#fcfbf9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($activities as $act)
                <div class="bg-white rounded-3xl overflow-hidden luxury-shadow luxury-card-hover border border-[#eae4d8] flex flex-col sm:flex-row group">
                    <!-- Photo Column -->
                    <div class="sm:w-2/5 h-64 sm:h-auto relative overflow-hidden bg-stone-100 shrink-0">
                        <img src="{{ $act->featured_image_url }}" alt="{{ $act->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        @if($act->price_per_person)
                            <div class="absolute bottom-4 left-4 px-3 py-1.5 rounded-xl bg-[#14281d]/90 backdrop-blur-md text-[11px] font-bold text-amber-300">
                                NPR {{ number_format($act->price_per_person) }} / pers.
                            </div>
                        @endif
                    </div>

                    <!-- Details Column -->
                    <div class="p-8 flex-grow flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2.5 text-xs text-stone-500 mb-3 font-semibold">
                                <span class="px-2.5 py-0.5 rounded-full bg-[#faf7f2] border border-[#eae4d8] text-[11px] text-stone-700">⏱️ {{ $act->duration }}</span>
                                <span class="px-2.5 py-0.5 rounded-full bg-amber-50 text-[#c25e19] text-[11px] font-bold uppercase tracking-wider">{{ $act->difficulty }}</span>
                            </div>
                            <h3 class="text-2xl font-bold text-stone-900 mb-3 group-hover:text-[#c25e19] transition-colors tracking-tight">
                                <a href="{{ route('activities.show', $act->slug) }}">{{ $act->title }}</a>
                            </h3>
                            <p class="text-stone-500 text-xs sm:text-sm leading-relaxed mb-6 font-normal">
                                {{ $act->excerpt }}
                            </p>
                        </div>

                        <div class="pt-5 border-t border-[#eae4d8] flex items-center justify-between">
                            <a href="{{ route('activities.show', $act->slug) }}" class="text-xs uppercase tracking-wider font-bold text-stone-800 hover:text-[#c25e19] inline-flex items-center gap-1.5 transition">
                                <span>Itinerary</span>
                                <span>→</span>
                            </a>
                            <a href="https://wa.me/9779749382246?text=Namaste%2C%20I%20would%20like%20to%20book%20the%20{{ urlencode($act->title) }}%20activity." target="_blank" class="px-4 py-2 rounded-xl bg-emerald-50 text-emerald-800 hover:bg-emerald-100 text-xs font-bold uppercase tracking-wider transition border border-emerald-200">
                                WhatsApp Desk
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
