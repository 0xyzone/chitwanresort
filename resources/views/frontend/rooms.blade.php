@extends('frontend.layouts.app')

@section('title', 'Rooms & Suites | Sishwar Chitwan Tiger Resort')
@section('meta_description', 'Discover our luxury King Size rooms, Deluxe Rooms, and Balcony Suites starting from NPR 2,500 in Devchuli, Nawalparasi.')

@section('content')

<!-- Banner Header -->
<div class="bg-stone-900 text-white py-16 relative overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-25">
        <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=2000&q=80" alt="Resort Accommodations" class="w-full h-full object-cover">
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-xs font-bold uppercase tracking-widest text-orange-400 mb-2 block">Accommodations</span>
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold font-serif-title mb-4">Rooms & Suites</h1>
        <p class="max-w-xl mx-auto text-stone-300 text-sm sm:text-base">
            Serenity by the Narayani River. Select from our comfortable Deluxe rooms to expansive Riverfront Balcony suites.
        </p>
    </div>
</div>

<!-- Main Catalog Container -->
<section class="py-16 bg-[#faf8f5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Category Filter Tabs -->
        <div class="flex flex-wrap items-center justify-center gap-2 mb-12">
            <a href="{{ route('rooms.index') }}" 
               class="px-5 py-2.5 rounded-full text-xs font-semibold tracking-wide transition {{ empty($categorySlug) ? 'bg-orange-600 text-white shadow-sm' : 'bg-white text-stone-700 hover:bg-stone-100 border border-stone-200' }}">
                All Rooms ({{ $rooms->count() }})
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('rooms.index', ['category' => $cat->slug]) }}" 
                   class="px-5 py-2.5 rounded-full text-xs font-semibold tracking-wide transition {{ $categorySlug === $cat->slug ? 'bg-orange-600 text-white shadow-sm' : 'bg-white text-stone-700 hover:bg-stone-100 border border-stone-200' }}">
                    {{ $cat->name }} ({{ $cat->rooms_count }})
                </a>
            @endforeach
        </div>

        <!-- Room Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($rooms as $room)
                <div class="bg-white rounded-2xl overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col group border border-stone-200/80">
                    <!-- Photo Header -->
                    <div class="relative h-64 overflow-hidden bg-stone-100">
                        <img src="{{ $room->featured_image_url }}" alt="{{ $room->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-3 left-3 flex flex-col gap-1.5">
                            <span class="px-2.5 py-1 rounded-lg bg-stone-900/80 backdrop-blur-md text-white text-xs font-semibold">
                                {{ $room->view_type }}
                            </span>
                        </div>
                        <div class="absolute bottom-3 right-3 px-3.5 py-1.5 rounded-xl bg-white/95 backdrop-blur-md shadow-sm text-right">
                            <span class="text-[10px] text-stone-500 block uppercase font-medium">Nightly Rate</span>
                            <span class="text-xl font-bold text-orange-600 font-serif-title">NPR {{ number_format($room->base_price) }}</span>
                        </div>
                    </div>

                    <!-- Room Information -->
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <span class="text-xs font-semibold text-orange-600 uppercase tracking-wider block mb-1">
                                {{ $room->category?->name ?? 'Standard' }}
                            </span>
                            <h3 class="text-xl font-bold font-serif-title text-stone-900 mb-2 group-hover:text-orange-600 transition-colors">
                                <a href="{{ route('rooms.show', $room->slug) }}">{{ $room->name }}</a>
                            </h3>
                            <p class="text-stone-600 text-xs sm:text-sm line-clamp-3 mb-4 leading-relaxed">
                                {{ $room->description }}
                            </p>

                            <!-- Specifications -->
                            <div class="grid grid-cols-2 gap-2 text-xs text-stone-500 pb-4 mb-4 border-b border-stone-100 font-medium">
                                <div>👥 {{ $room->capacity_adults }} Adults, {{ $room->capacity_children }} Ch.</div>
                                <div>🛏️ {{ $room->bed_type }}</div>
                                @if($room->room_size)
                                    <div>📐 {{ $room->room_size }}</div>
                                @endif
                                <div>🍳 Breakfast Included</div>
                            </div>

                            <!-- Amenity Badges (First 3) -->
                            @if(!empty($room->amenities))
                                <div class="flex flex-wrap gap-1.5 mb-6">
                                    @foreach(array_slice($room->amenities, 0, 3) as $amenity)
                                        <span class="px-2 py-0.5 rounded-md bg-stone-100 text-stone-600 text-[11px]">
                                            ✓ {{ $amenity }}
                                        </span>
                                    @endforeach
                                    @if(count($room->amenities) > 3)
                                        <span class="px-2 py-0.5 rounded-md bg-stone-50 text-stone-400 text-[11px]">
                                            +{{ count($room->amenities) - 3 }} more
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <!-- Action Button -->
                        <div class="pt-2">
                            <a href="{{ route('rooms.show', $room->slug) }}" class="block w-full text-center py-3 px-4 rounded-xl bg-orange-600 hover:bg-orange-700 text-white font-bold text-xs tracking-wider transition-colors shadow-xs">
                                Check Availability & Book
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16">
                    <p class="text-stone-500 text-base">No rooms found in this category.</p>
                    <a href="{{ route('rooms.index') }}" class="mt-4 inline-block text-sm font-semibold text-orange-600 hover:underline">View All Rooms</a>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
