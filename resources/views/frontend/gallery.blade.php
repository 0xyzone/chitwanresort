@extends('frontend.layouts.app')

@section('title', 'Photo & Video Gallery | Sishwar Chitwan Tiger Resort')
@section('meta_description', 'Browse photos of wildlife, rooms, Narayani river sunsets, and resort grounds at Sishwar Chitwan Tiger Resort.')

@section('content')

<!-- Header Banner -->
<div class="bg-stone-900 text-white py-16 relative overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-25">
        <img src="https://images.unsplash.com/photo-1575550959106-5a7defe28b56?auto=format&fit=crop&w=2000&q=80" alt="Resort Gallery" class="w-full h-full object-cover">
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-xs font-bold uppercase tracking-widest text-orange-400 mb-2 block">Moments Captured</span>
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold font-serif-title mb-4">Resort & Wildlife Gallery</h1>
        <p class="max-w-xl mx-auto text-stone-300 text-sm sm:text-base">
            Take a visual tour through our riverside sanctuaries, Sal forest sunsets, and the untamed wildlife of Chitwan.
        </p>
    </div>
</div>

<section class="py-16 bg-[#faf8f5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Filter Category Tabs -->
        <div class="flex flex-wrap items-center justify-center gap-2 mb-12">
            <a href="{{ route('gallery.index') }}" 
               class="px-5 py-2.5 rounded-full text-xs font-semibold tracking-wide transition {{ empty($category) || $category === 'all' ? 'bg-orange-600 text-white shadow-sm' : 'bg-white text-stone-700 hover:bg-stone-100 border border-stone-200' }}">
                All Photos ({{ $items->count() }})
            </a>
            <a href="{{ route('gallery.index', ['category' => 'wildlife_safari']) }}" 
               class="px-5 py-2.5 rounded-full text-xs font-semibold tracking-wide transition {{ $category === 'wildlife_safari' ? 'bg-orange-600 text-white shadow-sm' : 'bg-white text-stone-700 hover:bg-stone-100 border border-stone-200' }}">
                Wildlife & Safari
            </a>
            <a href="{{ route('gallery.index', ['category' => 'rooms']) }}" 
               class="px-5 py-2.5 rounded-full text-xs font-semibold tracking-wide transition {{ $category === 'rooms' ? 'bg-orange-600 text-white shadow-sm' : 'bg-white text-stone-700 hover:bg-stone-100 border border-stone-200' }}">
                Rooms & Suites
            </a>
            <a href="{{ route('gallery.index', ['category' => 'resort_grounds']) }}" 
               class="px-5 py-2.5 rounded-full text-xs font-semibold tracking-wide transition {{ $category === 'resort_grounds' ? 'bg-orange-600 text-white shadow-sm' : 'bg-white text-stone-700 hover:bg-stone-100 border border-stone-200' }}">
                Resort Grounds & River
            </a>
            <a href="{{ route('gallery.index', ['category' => 'dining']) }}" 
               class="px-5 py-2.5 rounded-full text-xs font-semibold tracking-wide transition {{ $category === 'dining' ? 'bg-orange-600 text-white shadow-sm' : 'bg-white text-stone-700 hover:bg-stone-100 border border-stone-200' }}">
                Dining & Bar
            </a>
            <a href="{{ route('gallery.index', ['category' => 'events']) }}" 
               class="px-5 py-2.5 rounded-full text-xs font-semibold tracking-wide transition {{ $category === 'events' ? 'bg-orange-600 text-white shadow-sm' : 'bg-white text-stone-700 hover:bg-stone-100 border border-stone-200' }}">
                Events & Culture
            </a>
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse($items as $item)
                <div class="relative group rounded-3xl overflow-hidden bg-stone-100 border border-stone-200/80 shadow-xs hover:shadow-xl transition-all duration-300">
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-72 object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6 text-white">
                        <span class="text-[10px] uppercase font-bold tracking-widest text-orange-400 mb-1">
                            {{ ucwords(str_replace('_', ' ', $item->category)) }}
                        </span>
                        <h3 class="text-base font-bold font-serif-title mb-1 leading-snug">
                            {{ $item->title }}
                        </h3>
                        @if($item->caption)
                            <p class="text-xs text-stone-300 line-clamp-2">
                                {{ $item->caption }}
                            </p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16">
                    <p class="text-stone-500">No photos found in this category.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
