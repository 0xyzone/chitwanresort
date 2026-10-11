@extends('frontend.layouts.app')

@section('title', 'Sishwar Chitwan Tiger Resort | Best Resort in Chitwan & Nawalpur, Nepal')
@section('meta_description', 'Welcome to Sishwar Chitwan Tiger Resort in Devchuli, Nawalparasi. Authentic luxury rooms from NPR 2,500, Narayani River boating, Jeep safari, and wildlife peace.')

@section('content')

<!-- 1. Hero Section with Luxury Editorial Typography & Floating Availability Bar -->
<section class="relative bg-[#0d1a13] text-white min-h-[90vh] flex items-center justify-center overflow-hidden">
    <!-- Hero Background Image & Ken Burns Ambient Motion -->
    <div class="absolute inset-0 z-0 overflow-hidden">
        <img src="https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?auto=format&fit=crop&w=2200&q=85" 
             alt="Chitwan National Park Riverbank & Safari Wilderness" 
             class="w-full h-full object-cover object-center filter brightness-[0.42] animate-ken-burns">
        <div class="absolute inset-0 bg-gradient-to-t from-[#0a140f] via-[#14281d]/50 to-[#0a140f]/80"></div>
    </div>

    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
        <!-- Pill Badge with Subtle Float -->
        <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-[#f08235] text-xs font-semibold tracking-widest uppercase mb-8 animate-float-gentle">
            <span class="w-2 h-2 rounded-full bg-[#f08235] animate-ping"></span>
            <span>Serenity by the Narayani River & Chitwan National Park</span>
        </div>

        <!-- Headline in Cormorant Garamond -->
        <h1 class="text-4xl sm:text-6xl md:text-7xl lg:text-8xl font-normal font-serif-luxury text-white mb-6 leading-[1.08] tracking-tight">
            Where Untamed Wildlife Meets <br class="hidden sm:inline" />
            <span class="italic font-normal text-amber-200">
                Peaceful Riverfront Sanctuary
            </span>
        </h1>

        <!-- Subheadline -->
        <p class="max-w-2xl mx-auto text-stone-300 text-sm sm:text-base md:text-lg font-light mb-12 leading-relaxed">
            Escape the bustling tourist corridors. Unwind along the tranquil banks of Piprahar, Devchuli, where luxurious rooms start from 
            <strong class="font-semibold text-white">NPR 2,500</strong> and rare wildlife encounters await right at your doorstep.
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16">
            <a href="{{ route('rooms.index') }}" 
               class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-[#c25e19] hover:bg-[#d96b20] text-white font-semibold text-xs uppercase tracking-widest shadow-xl shadow-[#c25e19]/25 hover:-translate-y-0.5 transition-all duration-300">
                Explore Rooms & Rates (NPR)
            </a>
            <a href="{{ route('activities.index') }}" 
               class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-white/10 hover:bg-white/20 backdrop-blur-md text-white font-semibold text-xs uppercase tracking-widest border border-white/20 hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2">
                <span>Safari & River Excursions</span>
                <span>→</span>
            </a>
        </div>

        <!-- Check Availability Floating Card with Glassmorphic Surface -->
        <div class="glass-surface rounded-3xl p-6 sm:p-7 luxury-shadow max-w-4xl mx-auto text-left border border-white/80">
            <form action="{{ route('rooms.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 items-end">
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1.5">Check-In Date</label>
                    <input type="date" name="check_in" value="{{ now()->format('Y-m-d') }}" min="{{ now()->format('Y-m-d') }}" class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 bg-white/90 text-sm text-stone-800 focus:ring-2 focus:ring-[#c25e19] focus:outline-hidden transition">
                </div>
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1.5">Check-Out Date</label>
                    <input type="date" name="check_out" value="{{ now()->addDays(2)->format('Y-m-d') }}" min="{{ now()->addDay()->format('Y-m-d') }}" class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 bg-white/90 text-sm text-stone-800 focus:ring-2 focus:ring-[#c25e19] focus:outline-hidden transition">
                </div>
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1.5">Room Category</label>
                    <select name="category" class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 bg-white/90 text-sm text-stone-800 focus:ring-2 focus:ring-[#c25e19] focus:outline-hidden transition">
                        <option value="">All Room Types</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-[#14281d] hover:bg-[#c25e19] text-white font-semibold text-xs uppercase tracking-wider transition-all duration-300 shadow-md">
                        Check Availability
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- 2. Resort Introduction & Atmosphere Narrative -->
<section class="py-24 bg-[#fcfbf9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            
            <!-- Left Narrative (7 cols) -->
            <div class="lg:col-span-7">
                <span class="text-xs font-bold uppercase tracking-widest text-[#c25e19] mb-3 block">
                    Welcome to Devchuli-17, Piprahar
                </span>
                <h2 class="text-3xl sm:text-5xl font-normal font-serif-luxury text-[#14281d] leading-tight mb-6">
                    A Riverside Haven by Chitwan's Untouched Horizon
                </h2>
                <p class="text-stone-600 leading-relaxed text-sm sm:text-base mb-6 font-light">
                    Nestled in the pristine buffer zone of <strong>Piprahar, Devchuli</strong>, Sishwar Chitwan Tiger Resort (SCTR) offers guests an intimate, crowd-free wildlife escape. Just across the gentle currents of the Narayani River lies the UNESCO World Heritage Chitwan National Park.
                </p>
                <p class="text-stone-600 leading-relaxed text-sm sm:text-base mb-8 font-light">
                    Awaken to bird calls at sunrise, watch One-Horned Rhinos grazing on river sandbanks, and savor locally sourced Nepali cuisine prepared by experienced chefs.
                </p>

                <!-- Highlights Badges -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-8">
                    <div class="p-4 rounded-2xl bg-white border border-[#eae4d8] shadow-xs">
                        <span class="text-2xl block mb-1">🦏</span>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-stone-800">Jeep Safaris</h4>
                        <p class="text-[11px] text-stone-500 mt-0.5">Rhino & wildlife trails</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-white border border-[#eae4d8] shadow-xs">
                        <span class="text-2xl block mb-1">🛶</span>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-stone-800">River Boating</h4>
                        <p class="text-[11px] text-stone-500 mt-0.5">Sunset on Narayani</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-white border border-[#eae4d8] shadow-xs">
                        <span class="text-2xl block mb-1">🪘</span>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-stone-800">Tharu Culture</h4>
                        <p class="text-[11px] text-stone-500 mt-0.5">Folk dance & cuisine</p>
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-[#c25e19] hover:text-[#d96b20] transition group">
                        <span>Get Directions & Details</span>
                        <span class="group-hover:translate-x-1 transition-transform">→</span>
                    </a>
                    <span class="text-stone-300">|</span>
                    <span class="text-xs text-stone-500">Call Reception: <strong>078-545455</strong></span>
                </div>
            </div>

            <!-- Right Image Showcase (5 cols) -->
            <div class="lg:col-span-5 relative">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white group">
                    <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=1200&q=80" 
                         alt="Resort Courtyard and Pool" 
                         class="w-full h-[450px] object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#14281d]/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 text-white">
                        <span class="text-[11px] uppercase tracking-widest text-amber-300 font-semibold block mb-1">Narayani Sanctuary</span>
                        <h4 class="text-xl font-serif-luxury font-normal">Authentic Hospitality & Nature Combined</h4>
                    </div>
                </div>

                <!-- Overlapping Floating Experience Badge -->
                <div class="absolute -bottom-6 -left-6 bg-white p-5 rounded-2xl shadow-xl border border-[#eae4d8] flex items-center gap-4 hidden sm:flex animate-float-gentle">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-[#c25e19] flex items-center justify-center text-2xl font-bold">
                        ★
                    </div>
                    <div>
                        <span class="text-lg font-bold text-stone-900 block leading-tight">4.9 / 5.0</span>
                        <span class="text-[11px] text-stone-500 uppercase tracking-wider">Guest Satisfaction</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 3. Featured Rooms & Suites Showcase -->
<section class="py-24 bg-[#f7f4ed] border-y border-[#eae4d8]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-[#c25e19] mb-2 block">Accommodations</span>
                <h2 class="text-3xl sm:text-5xl font-normal font-serif-luxury text-[#14281d]">
                    Curated Rooms & Suites
                </h2>
                <p class="text-stone-600 text-sm sm:text-base mt-2 max-w-xl font-light">
                    Thoughtfully designed with local natural timber, plush bedding, air conditioning, and peaceful river or courtyard outlooks.
                </p>
            </div>
            <div class="mt-6 md:mt-0">
                <a href="{{ route('rooms.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white border border-[#eae4d8] text-stone-800 text-xs uppercase tracking-wider font-semibold hover:border-[#c25e19] hover:text-[#c25e19] transition shadow-xs">
                    <span>View All Accommodations</span>
                    <span>→</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($rooms as $room)
                <div class="bg-white rounded-3xl overflow-hidden luxury-shadow luxury-card-hover border border-[#eae4d8]/80 flex flex-col group">
                    <!-- Photo Header with View Badge and Price Tag -->
                    <div class="relative h-64 overflow-hidden bg-stone-100">
                        <img src="{{ $room->featured_image_url }}" 
                             alt="{{ $room->name }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 rounded-full bg-[#14281d]/85 backdrop-blur-md text-white text-[11px] font-semibold tracking-wide uppercase">
                                {{ $room->view_type }}
                            </span>
                        </div>
                        <div class="absolute bottom-4 right-4 px-4 py-2 rounded-2xl bg-white/95 backdrop-blur-md shadow-md text-right border border-white/60">
                            <span class="text-[10px] text-stone-500 block uppercase font-bold tracking-wider">Per Night</span>
                            <span class="text-xl font-normal font-serif-luxury text-[#c25e19]">NPR {{ number_format($room->base_price) }}</span>
                        </div>
                    </div>

                    <!-- Room Details -->
                    <div class="p-7 flex-grow flex flex-col justify-between">
                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-widest text-[#c25e19] block mb-1">
                                {{ $room->category?->name ?? 'Luxury Room' }}
                            </span>
                            <h3 class="text-2xl font-normal font-serif-luxury text-stone-900 mb-2 group-hover:text-[#c25e19] transition-colors">
                                <a href="{{ route('rooms.show', $room->slug) }}">{{ $room->name }}</a>
                            </h3>
                            <p class="text-stone-500 text-xs sm:text-sm line-clamp-2 leading-relaxed mb-5 font-light">
                                {{ $room->short_description ?? 'Comfortable luxury accommodation featuring king size bed, air conditioning, and garden or river vistas.' }}
                            </p>

                            <!-- Room Metadata -->
                            <div class="flex items-center gap-4 text-xs text-stone-500 mb-6 pb-6 border-b border-[#eae4d8]">
                                <span class="flex items-center gap-1.5">
                                    <span>👥</span>
                                    <span>Up to {{ $room->max_adults }} Adults</span>
                                </span>
                                <span>•</span>
                                <span class="flex items-center gap-1.5">
                                    <span>☕</span>
                                    <span>Breakfast Included</span>
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between gap-3">
                            <a href="{{ route('rooms.show', $room->slug) }}" 
                               class="text-xs uppercase tracking-widest font-bold text-stone-700 hover:text-[#c25e19] transition">
                                Details & Specs →
                            </a>
                            <a href="{{ route('rooms.show', $room->slug) }}" 
                               class="px-5 py-2.5 rounded-xl bg-[#c25e19] hover:bg-[#d96b20] text-white text-xs font-semibold uppercase tracking-wider transition-all duration-300 shadow-xs">
                                Reserve
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 text-stone-500">
                    Rooms information currently loading.
                </div>
            @endforelse
        </div>

    </div>
</section>

<!-- 4. Safari & Wilderness Experiences -->
<section class="py-24 bg-[#14281d] text-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-[#f08235] mb-2 block">
                Chitwan Wilderness
            </span>
            <h2 class="text-3xl sm:text-5xl font-normal font-serif-luxury text-white">
                Unforgettable Safari Experiences
            </h2>
            <p class="text-stone-300 text-sm sm:text-base mt-3 font-light">
                From guided jungle jeep safaris tracking One-Horned Rhinos to peaceful sunset boating down the Narayani.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($activities as $activity)
                <div class="glass-dark rounded-3xl overflow-hidden luxury-card-hover flex flex-col group border border-white/10">
                    <div class="relative h-56 overflow-hidden">
                        <img src="{{ $activity->featured_image_url }}" 
                             alt="{{ $activity->title }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        @if($activity->duration)
                            <div class="absolute top-3 left-3 px-3 py-1 rounded-full bg-black/60 backdrop-blur-md text-[10px] uppercase font-bold tracking-wider text-white">
                                ⏱ {{ $activity->duration }}
                            </div>
                        @endif
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl font-normal font-serif-luxury text-white mb-2 group-hover:text-[#f08235] transition-colors">
                                <a href="{{ route('activities.show', $activity->slug) }}">{{ $activity->title }}</a>
                            </h3>
                            <p class="text-stone-300 text-xs line-clamp-3 leading-relaxed mb-4 font-light">
                                {{ $activity->short_description ?? 'Immerse in Chitwan buffer zone flora, fauna, and local heritage with experienced nature guides.' }}
                            </p>
                        </div>
                        <a href="{{ route('activities.show', $activity->slug) }}" class="text-xs font-bold uppercase tracking-widest text-[#f08235] hover:text-amber-200 transition">
                            Learn More →
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-10 text-stone-400">
                    Safari activities information currently loading.
                </div>
            @endforelse
        </div>

    </div>
</section>

<!-- 5. Real Guest Reviews & Testimonials -->
<section class="py-24 bg-[#fcfbf9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-[#c25e19] mb-2 block">Testimonials</span>
            <h2 class="text-3xl sm:text-5xl font-normal font-serif-luxury text-[#14281d]">
                Words From Our Guests
            </h2>
            <p class="text-stone-600 text-sm sm:text-base mt-2 font-light">
                Discover what travelers appreciate most about their stay in Piprahar, Devchuli.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($testimonials as $review)
                <div class="bg-white p-8 rounded-3xl border border-[#eae4d8] luxury-shadow flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-1 text-amber-500 text-sm mb-4">
                            @for($i = 0; $i < ($review->rating ?? 5); $i++)
                                ★
                            @endfor
                        </div>
                        <p class="text-stone-700 text-sm italic font-light leading-relaxed mb-6 font-serif-luxury text-base">
                            "{{ $review->content }}"
                        </p>
                    </div>
                    <div class="pt-4 border-t border-[#eae4d8] flex items-center justify-between">
                        <div>
                            <h4 class="font-bold text-xs uppercase tracking-wider text-stone-900">{{ $review->name }}</h4>
                            <span class="text-[11px] text-stone-500">{{ $review->origin ?? 'Guest' }}</span>
                        </div>
                        <span class="text-xl">🌿</span>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-stone-500 py-8">
                    Reviews updating.
                </div>
            @endforelse
        </div>

    </div>
</section>

<!-- 6. Direct Booking Callout -->
<section class="py-20 bg-[#14281d] text-white text-center relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <span class="text-xs font-bold uppercase tracking-widest text-[#f08235] mb-3 block">Direct Reservation</span>
        <h2 class="text-3xl sm:text-5xl font-normal font-serif-luxury mb-6">
            Plan Your Chitwan Wilderness Escape
        </h2>
        <p class="text-stone-300 text-sm sm:text-base font-light max-w-xl mx-auto mb-10 leading-relaxed">
            Call our front desk directly or submit an online reservation. No prepayment credit card required to request availability.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('rooms.index') }}" class="px-8 py-4 rounded-2xl bg-[#c25e19] hover:bg-[#d96b20] text-white font-semibold text-xs uppercase tracking-widest shadow-xl transition-all">
                Book Rooms From NPR 2,500
            </a>
            <a href="tel:9749382246" class="px-8 py-4 rounded-2xl bg-white/10 hover:bg-white/20 text-white font-semibold text-xs uppercase tracking-widest border border-white/20 transition-all">
                📞 Call 9749382246 / 078-545455
            </a>
        </div>
    </div>
</section>

@endsection
