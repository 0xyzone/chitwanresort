@extends('frontend.layouts.app')

@section('title', 'Photo & Video Gallery | Sishwar Chitwan Tiger Resort')
@section('meta_description', 'Browse photos of wildlife, rooms, Narayani river sunsets, and resort grounds at Sishwar Chitwan Tiger Resort.')

@section('content')

<!-- Header Banner -->
<div class="bg-[#14281d] text-white py-20 relative overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-20">
        <img src="https://images.unsplash.com/photo-1575550959106-5a7defe28b56?auto=format&fit=crop&w=2200&q=80" alt="Resort Gallery" class="w-full h-full object-cover">
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-xs font-bold uppercase tracking-widest text-[#f08235] mb-2 block">Moments Captured</span>
        <h1 class="text-4xl sm:text-6xl font-normal font-serif-luxury mb-4">Resort & Wildlife Gallery</h1>
        <p class="max-w-xl mx-auto text-stone-300 text-sm sm:text-base font-light">
            Take a visual tour through our riverside sanctuaries, Sal forest sunsets, and the untamed wildlife of Chitwan.
        </p>
    </div>
</div>

<section class="py-20 bg-[#fcfbf9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Filter Category Tabs -->
        <div class="flex flex-wrap items-center justify-center gap-2 mb-16">
            <a href="{{ route('gallery.index') }}" 
               class="px-6 py-2.5 rounded-full text-xs font-semibold tracking-wider uppercase transition-all duration-300 {{ empty($category) || $category === 'all' ? 'bg-[#c25e19] text-white shadow-md' : 'bg-white text-stone-700 hover:bg-[#faf7f2] border border-[#eae4d8]' }}">
                All Photos ({{ $items->count() }})
            </a>
            <a href="{{ route('gallery.index', ['category' => 'wildlife_safari']) }}" 
               class="px-6 py-2.5 rounded-full text-xs font-semibold tracking-wider uppercase transition-all duration-300 {{ $category === 'wildlife_safari' ? 'bg-[#c25e19] text-white shadow-md' : 'bg-white text-stone-700 hover:bg-[#faf7f2] border border-[#eae4d8]' }}">
                Wildlife & Safari
            </a>
            <a href="{{ route('gallery.index', ['category' => 'rooms']) }}" 
               class="px-6 py-2.5 rounded-full text-xs font-semibold tracking-wider uppercase transition-all duration-300 {{ $category === 'rooms' ? 'bg-[#c25e19] text-white shadow-md' : 'bg-white text-stone-700 hover:bg-[#faf7f2] border border-[#eae4d8]' }}">
                Rooms & Suites
            </a>
            <a href="{{ route('gallery.index', ['category' => 'resort_grounds']) }}" 
               class="px-6 py-2.5 rounded-full text-xs font-semibold tracking-wider uppercase transition-all duration-300 {{ $category === 'resort_grounds' ? 'bg-[#c25e19] text-white shadow-md' : 'bg-white text-stone-700 hover:bg-[#faf7f2] border border-[#eae4d8]' }}">
                Resort Grounds & River
            </a>
            <a href="{{ route('gallery.index', ['category' => 'dining']) }}" 
               class="px-6 py-2.5 rounded-full text-xs font-semibold tracking-wider uppercase transition-all duration-300 {{ $category === 'dining' ? 'bg-[#c25e19] text-white shadow-md' : 'bg-white text-stone-700 hover:bg-[#faf7f2] border border-[#eae4d8]' }}">
                Dining & Bar
            </a>
            <a href="{{ route('gallery.index', ['category' => 'events']) }}" 
               class="px-6 py-2.5 rounded-full text-xs font-semibold tracking-wider uppercase transition-all duration-300 {{ $category === 'events' ? 'bg-[#c25e19] text-white shadow-md' : 'bg-white text-stone-700 hover:bg-[#faf7f2] border border-[#eae4d8]' }}">
                Events & Culture
            </a>
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @forelse($items as $item)
                <div class="relative group rounded-3xl overflow-hidden bg-stone-100 border border-[#eae4d8] luxury-shadow luxury-card-hover">
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#14281d]/90 via-[#14281d]/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-7 text-white">
                        <span class="text-[10px] uppercase font-bold tracking-widest text-amber-300 mb-1">
                            {{ ucwords(str_replace('_', ' ', $item->category)) }}
                        </span>
                        <h3 class="text-xl font-normal font-serif-luxury leading-snug">
                            {{ $item->title }}
                        </h3>
                        @if($item->caption)
                            <p class="text-xs text-stone-300 line-clamp-2 mt-1 font-light">
                                {{ $item->caption }}
                            </p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16 bg-white rounded-3xl border border-[#eae4d8]">
                    <span class="text-4xl block mb-2">📸</span>
                    <h3 class="text-lg font-bold text-stone-800 font-serif-luxury">No photos currently in this gallery category</h3>
                    <p class="text-xs text-stone-500 mt-1">Please select another category or check back soon.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>

@endsection
