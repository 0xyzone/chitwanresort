@extends('frontend.layouts.app')

@section('title', 'Rooms & Suites | Sishwar Chitwan Tiger Resort')
@section('meta_description', 'Discover our luxury King Size rooms, Deluxe Rooms, and Balcony Suites starting from NPR 2,500 in Devchuli, Nawalparasi.')

@section('content')

<!-- Header Banner -->
<div class="bg-[#14281d] text-white py-20 relative overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-20">
        <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=2200&q=80" alt="Resort Accommodations" class="w-full h-full object-cover">
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-xs font-bold uppercase tracking-widest text-[#f08235] mb-2 block">Accommodations</span>
        <h1 class="text-4xl sm:text-6xl font-black mb-4 tracking-tight">Rooms & Suites</h1>
        <p class="max-w-xl mx-auto text-stone-300 text-sm sm:text-base font-normal">
            Serenity by the Narayani River. Select from our comfortable Deluxe rooms to expansive Riverfront Balcony suites.
        </p>
    </div>
</div>

<!-- Main Catalog Container -->
<section class="py-20 bg-[#fcfbf9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Category Filter Tabs -->
        <div class="flex flex-wrap items-center justify-center gap-2 mb-16">
            <a href="{{ route('rooms.index') }}" 
               class="px-6 py-2.5 rounded-full text-xs font-bold tracking-wider uppercase transition-all duration-300 {{ empty($categorySlug) ? 'bg-[#c25e19] text-white shadow-md' : 'bg-white text-stone-700 hover:bg-[#faf7f2] border border-[#eae4d8]' }}">
                All Rooms ({{ $rooms->count() }})
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('rooms.index', ['category' => $cat->slug]) }}" 
                   class="px-6 py-2.5 rounded-full text-xs font-bold tracking-wider uppercase transition-all duration-300 {{ $categorySlug === $cat->slug ? 'bg-[#c25e19] text-white shadow-md' : 'bg-white text-stone-700 hover:bg-[#faf7f2] border border-[#eae4d8]' }}">
                    {{ $cat->name }} ({{ $cat->rooms_count }})
                </a>
            @endforeach
        </div>

        <!-- Room Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($rooms as $room)
                <div class="bg-white rounded-3xl overflow-hidden luxury-shadow luxury-card-hover transition-all duration-500 flex flex-col group border border-[#eae4d8]">
                    <!-- Photo Header -->
                    <div class="relative h-64 overflow-hidden bg-stone-100">
                        <img src="{{ $room->featured_image_url }}" alt="{{ $room->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 rounded-full bg-[#14281d]/85 backdrop-blur-md text-white text-[11px] font-bold uppercase tracking-wider">
                                {{ $room->view_type }}
                            </span>
                        </div>
                        <div class="absolute bottom-4 right-4 px-4 py-2 rounded-2xl bg-white/95 backdrop-blur-md shadow-md text-right border border-white/60">
                            <span class="text-[10px] text-stone-500 block uppercase font-bold tracking-wider">Nightly Rate</span>
                            <span class="text-xl font-extrabold text-[#c25e19] tracking-tight">NPR {{ number_format($room->base_price) }}</span>
                        </div>
                    </div>

                    <!-- Room Information -->
                    <div class="p-7 flex-grow flex flex-col justify-between">
                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-widest text-[#c25e19] block mb-1">
                                {{ $room->category?->name ?? 'Resort Suite' }}
                            </span>
                            <h3 class="text-2xl font-bold text-stone-900 mb-2 group-hover:text-[#c25e19] transition-colors tracking-tight">
                                <a href="{{ route('rooms.show', $room->slug) }}">{{ $room->name }}</a>
                            </h3>
                            <p class="text-stone-500 text-xs sm:text-sm line-clamp-2 leading-relaxed mb-5 font-normal">
                                {{ $room->short_description ?? 'Designed with natural wood interiors, en-suite modern bath, and refreshing views of the resort grounds.' }}
                            </p>

                            <!-- Room Amenities Pills -->
                            @if(!empty($room->amenities))
                                <div class="flex flex-wrap gap-1.5 mb-6">
                                    @foreach(array_slice($room->amenities, 0, 4) as $amenity)
                                        <span class="px-2.5 py-1 rounded-lg bg-[#faf7f2] border border-[#eae4d8] text-[11px] text-stone-600 font-semibold">
                                            ✓ {{ $amenity }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Card Footer -->
                        <div class="pt-5 border-t border-[#eae4d8] flex items-center justify-between">
                            <div class="text-xs text-stone-500 font-semibold">
                                👥 Max {{ $room->max_adults }} Adults
                            </div>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('rooms.show', $room->slug) }}" class="text-xs uppercase tracking-wider font-bold text-stone-600 hover:text-[#c25e19] transition">
                                    Specs
                                </a>
                                <a href="{{ route('rooms.show', $room->slug) }}" class="px-4 py-2 rounded-xl bg-[#c25e19] hover:bg-[#d96b20] text-white text-xs font-bold uppercase tracking-wider transition-all duration-300 shadow-xs">
                                    Reserve
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16 bg-white rounded-3xl border border-[#eae4d8]">
                    <span class="text-4xl block mb-2">🌿</span>
                    <h3 class="text-lg font-bold text-stone-800">No rooms found in this category</h3>
                    <p class="text-xs text-stone-500 mt-1">Please explore other room categories or contact our front desk.</p>
                    <a href="{{ route('rooms.index') }}" class="mt-4 inline-block px-5 py-2 rounded-xl bg-[#14281d] text-white text-xs uppercase font-bold">View All Rooms</a>
                </div>
            @endforelse
        </div>

    </div>
</section>

@endsection
