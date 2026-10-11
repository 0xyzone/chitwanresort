@extends('frontend.layouts.app')

@section('title', 'Sishwar Chitwan Tiger Resort | Best Resort in Chitwan & Nawalpur, Nepal')
@section('meta_description', 'Welcome to Sishwar Chitwan Tiger Resort in Devchuli, Nawalparasi. Authentic luxury rooms from NPR 2,500, Narayani River boating, Jeep safari, and wildlife peace.')

@section('content')

<!-- 1. Hero Section with Interactive Highlights, Featured Cards & Availability Engine -->
<section class="relative bg-stone-950 text-white min-h-[92vh] flex items-center justify-center overflow-hidden">
    <!-- Hero Background Image & Atmospheric Lighting -->
    <div class="absolute inset-0 z-0 overflow-hidden">
        <img src="https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?auto=format&fit=crop&w=2200&q=85" 
             alt="Chitwan National Park Riverbank & Safari Wilderness" 
             class="w-full h-full object-cover object-center filter brightness-[0.38] animate-ken-burns">
        <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/45 to-stone-950/75"></div>
    </div>

    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 text-center">
        
        <!-- Live Location & River Status Badge -->
        <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-white/15 backdrop-blur-md border border-white/25 text-amber-300 text-xs sm:text-sm font-bold tracking-wider uppercase mb-6 shadow-md animate-float-gentle">
            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
            <span>Piprahar, Devchuli-17 • Narayani Riverfront • Chitwan Buffer Zone</span>
        </div>

        <!-- Headline in Poppins (Bold & Modern) -->
        <h1 class="text-3xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-white mb-5 leading-tight tracking-tight">
            Where Raw Wildlife Meets <br class="hidden sm:inline" />
            <span class="text-[#f08235]">
                Peaceful Riverfront Hospitality
            </span>
        </h1>

        <!-- Subheadline (Senior-Friendly High Contrast) -->
        <p class="max-w-3xl mx-auto text-stone-100 text-base sm:text-lg md:text-xl font-normal mb-8 leading-relaxed">
            Escape the busy tourist streets. Relax beside the tranquil Narayani River in Piprahar, Devchuli, with clean comfortable rooms from 
            <strong class="font-bold text-amber-300">NPR 2,500</strong>, guided Rhino Jeep safaris, and authentic Tharu hospitality.
        </p>

        <!-- Interactive Quick Highlight Pills (Clickable Category Badges) -->
        <div class="flex flex-wrap items-center justify-center gap-2.5 sm:gap-3 mb-10 max-w-4xl mx-auto">
            <a href="{{ route('activities.index') }}" 
               class="px-4 py-2 rounded-xl bg-white/10 hover:bg-[#c25e19] text-white text-xs sm:text-sm font-bold border border-white/20 transition-all flex items-center gap-2 group">
                <span class="text-base">🦏</span>
                <span>Chitwan Jeep Safari</span>
            </a>
            <a href="{{ route('activities.index') }}" 
               class="px-4 py-2 rounded-xl bg-white/10 hover:bg-[#c25e19] text-white text-xs sm:text-sm font-bold border border-white/20 transition-all flex items-center gap-2 group">
                <span class="text-base">🛶</span>
                <span>Narayani River Boating</span>
            </a>
            <a href="{{ route('rooms.index') }}" 
               class="px-4 py-2 rounded-xl bg-white/10 hover:bg-[#c25e19] text-white text-xs sm:text-sm font-bold border border-white/20 transition-all flex items-center gap-2 group">
                <span class="text-base">🛏️</span>
                <span>Rooms From NPR 2,500</span>
            </a>
            <a href="{{ route('activities.index') }}" 
               class="px-4 py-2 rounded-xl bg-white/10 hover:bg-[#c25e19] text-white text-xs sm:text-sm font-bold border border-white/20 transition-all flex items-center gap-2 group">
                <span class="text-base">🪘</span>
                <span>Tharu Culture & Cuisine</span>
            </a>
            <a href="tel:078545455" 
               class="px-4 py-2 rounded-xl bg-emerald-700/80 hover:bg-emerald-600 text-white text-xs sm:text-sm font-bold border border-emerald-400/30 transition-all flex items-center gap-2">
                <span class="text-base">📞</span>
                <span>Call Desk: 078-545455</span>
            </a>
        </div>

        <!-- 3 Interactive Highlight / Action Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10 text-left">
            <!-- Card 1: Featured Room Spotlight -->
            <div class="p-5 rounded-2xl bg-white/15 backdrop-blur-md border border-white/20 hover:border-amber-300 transition-all group flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-xs uppercase font-bold text-amber-300">Popular Room</span>
                        <span class="text-xs bg-black/60 px-2 py-0.5 rounded-md font-bold text-white">River View</span>
                    </div>
                    <h4 class="text-base sm:text-lg font-bold text-white group-hover:text-amber-300 transition">Deluxe King with Balcony</h4>
                    <p class="text-xs text-stone-200 mt-1">King bed, private riverbank balcony & breakfast included.</p>
                </div>
                <div class="pt-4 mt-3 border-t border-white/15 flex items-center justify-between">
                    <span class="text-base font-black text-amber-300">NPR 4,500 <span class="text-[11px] font-normal text-stone-300">/ night</span></span>
                    <a href="{{ route('rooms.index') }}" class="text-xs font-bold text-white bg-[#c25e19] px-3 py-1.5 rounded-lg hover:bg-[#d96b20] transition">
                        Reserve →
                    </a>
                </div>
            </div>

            <!-- Card 2: Safari Adventure Spotlight -->
            <div class="p-5 rounded-2xl bg-white/15 backdrop-blur-md border border-white/20 hover:border-amber-300 transition-all group flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-xs uppercase font-bold text-amber-300">Buffer Zone Safari</span>
                        <span class="text-xs bg-emerald-800/80 px-2 py-0.5 rounded-md font-bold text-white">Daily Trips</span>
                    </div>
                    <h4 class="text-base sm:text-lg font-bold text-white group-hover:text-amber-300 transition">One-Horned Rhino Jeep Tour</h4>
                    <p class="text-xs text-stone-200 mt-1">Certified naturalist guided safari in Chitwan National Park.</p>
                </div>
                <div class="pt-4 mt-3 border-t border-white/15 flex items-center justify-between">
                    <span class="text-xs text-stone-300 font-semibold">Morning & Sunset Trips</span>
                    <a href="{{ route('activities.index') }}" class="text-xs font-bold text-white bg-white/20 px-3 py-1.5 rounded-lg hover:bg-white/30 transition">
                        Itinerary →
                    </a>
                </div>
            </div>

            <!-- Card 3: 1-Tap Telephone Hotline -->
            <div class="p-5 rounded-2xl bg-emerald-900/60 backdrop-blur-md border border-emerald-400/30 transition-all flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-xs uppercase font-bold text-emerald-300">Direct Inquiries</span>
                        <span class="text-xs bg-emerald-800 px-2 py-0.5 rounded-md font-bold text-white">24/7 Desk</span>
                    </div>
                    <h4 class="text-base sm:text-lg font-bold text-white">Instant Telephone Help</h4>
                    <p class="text-xs text-stone-200 mt-1">Talk with our front desk staff directly for special rates.</p>
                </div>
                <div class="pt-4 mt-3 border-t border-white/15 flex items-center gap-2">
                    <a href="tel:078545455" class="flex-1 py-1.5 text-center bg-white text-stone-900 rounded-lg text-xs font-bold hover:bg-stone-100 transition">
                        078-545455
                    </a>
                    <a href="tel:9749382246" class="flex-1 py-1.5 text-center bg-[#c25e19] text-white rounded-lg text-xs font-bold hover:bg-[#d96b20] transition">
                        9749382246
                    </a>
                </div>
            </div>
        </div>

        <!-- Check Availability Engine Card -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-2xl border-2 border-stone-200 max-w-4xl mx-auto text-left">
            <h3 class="text-stone-900 font-bold text-base sm:text-lg mb-4 flex items-center gap-2">
                <span>📅</span>
                <span>Check Room Availability & Direct Rates</span>
            </h3>
            <form action="{{ route('rooms.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 items-end">
                <div>
                    <label class="block text-xs sm:text-sm font-bold uppercase tracking-wider text-stone-800 mb-1.5">Check-In</label>
                    <input type="date" name="check_in" value="{{ now()->format('Y-m-d') }}" min="{{ now()->format('Y-m-d') }}" class="w-full px-4 py-3 rounded-xl border-2 border-stone-300 text-base text-stone-900 font-semibold focus:ring-2 focus:ring-[#c25e19] focus:border-[#c25e19] transition">
                </div>
                <div>
                    <label class="block text-xs sm:text-sm font-bold uppercase tracking-wider text-stone-800 mb-1.5">Check-Out</label>
                    <input type="date" name="check_out" value="{{ now()->addDays(2)->format('Y-m-d') }}" min="{{ now()->addDay()->format('Y-m-d') }}" class="w-full px-4 py-3 rounded-xl border-2 border-stone-300 text-base text-stone-900 font-semibold focus:ring-2 focus:ring-[#c25e19] focus:border-[#c25e19] transition">
                </div>
                <div>
                    <label class="block text-xs sm:text-sm font-bold uppercase tracking-wider text-stone-800 mb-1.5">Room Type</label>
                    <select name="category" class="w-full px-4 py-3 rounded-xl border-2 border-stone-300 text-base text-stone-900 font-semibold focus:ring-2 focus:ring-[#c25e19] focus:border-[#c25e19] transition">
                        <option value="">All Room Types</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="w-full py-3.5 px-4 rounded-xl bg-stone-900 hover:bg-[#c25e19] text-white font-bold text-base transition-all shadow-md active:scale-95">
                        Search Rooms
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>

<!-- 1.5 Trust & Guest Comfort Badges Strip -->
<div class="bg-[#14281d] text-white py-6 border-y border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="flex items-center justify-center gap-3">
                <span class="text-2xl">☕</span>
                <div class="text-left">
                    <h5 class="text-xs sm:text-sm font-bold text-white leading-tight">Free Breakfast</h5>
                    <p class="text-[11px] text-stone-300 font-medium">Included with every room</p>
                </div>
            </div>
            <div class="flex items-center justify-center gap-3">
                <span class="text-2xl">🚗</span>
                <div class="text-left">
                    <h5 class="text-xs sm:text-sm font-bold text-white leading-tight">Secure Parking</h5>
                    <p class="text-[11px] text-stone-300 font-medium">Free on-site parking</p>
                </div>
            </div>
            <div class="flex items-center justify-center gap-3">
                <span class="text-2xl">📶</span>
                <div class="text-left">
                    <h5 class="text-xs sm:text-sm font-bold text-white leading-tight">High-Speed Wi-Fi</h5>
                    <p class="text-[11px] text-stone-300 font-medium">Available across resort</p>
                </div>
            </div>
            <div class="flex items-center justify-center gap-3">
                <span class="text-2xl">🛡️</span>
                <div class="text-left">
                    <h5 class="text-xs sm:text-sm font-bold text-white leading-tight">24/7 Front Desk</h5>
                    <p class="text-[11px] text-stone-300 font-medium">Always here to assist</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 2. Resort Introduction & Real Atmosphere Narrative -->
<section class="py-16 sm:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 sm:gap-16 items-center">
            
            <!-- Left Narrative -->
            <div class="lg:col-span-7">
                <span class="text-xs sm:text-sm font-bold uppercase tracking-wider text-[#c25e19] mb-2 block">
                    Welcome to Devchuli-17, Piprahar
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-stone-900 leading-tight mb-5 tracking-tight">
                    A Peaceful Riverside Sanctuary Along Chitwan's Horizon
                </h2>
                <p class="text-stone-700 leading-relaxed text-base sm:text-lg mb-5 font-normal">
                    Located at <strong>Piprahar, Devchuli-17, Nawalparasi</strong>, Sishwar Chitwan Tiger Resort (SCTR) offers guests an authentic, tranquil retreat beside the Narayani River and the Chitwan National Park buffer zone.
                </p>
                <p class="text-stone-700 leading-relaxed text-base sm:text-lg mb-8 font-normal">
                    Wake up to the sounds of migratory birds, spot One-Horned Rhinos on the riverbanks, and enjoy freshly cooked authentic Nepali meals made from organic local produce.
                </p>

                <!-- Highlights Badges (Senior Friendly Large Text) -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                    <div class="p-4 sm:p-5 rounded-2xl bg-[#faf7f2] border-2 border-[#eae4d8]">
                        <span class="text-3xl block mb-2">🦏</span>
                        <h4 class="text-sm font-bold text-stone-900">Jeep Safaris</h4>
                        <p class="text-xs text-stone-600 mt-1">One-Horned Rhino & wild animal sightings</p>
                    </div>
                    <div class="p-4 sm:p-5 rounded-2xl bg-[#faf7f2] border-2 border-[#eae4d8]">
                        <span class="text-3xl block mb-2">🛶</span>
                        <h4 class="text-sm font-bold text-stone-900">River Boating</h4>
                        <p class="text-xs text-stone-600 mt-1">Peaceful sunset views on the Narayani River</p>
                    </div>
                    <div class="p-4 sm:p-5 rounded-2xl bg-[#faf7f2] border-2 border-[#eae4d8]">
                        <span class="text-3xl block mb-2">🪘</span>
                        <h4 class="text-sm font-bold text-stone-900">Tharu Culture</h4>
                        <p class="text-xs text-stone-600 mt-1">Traditional Tharu dance & warm hospitality</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center gap-4 sm:gap-6 pt-2">
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-sm font-bold text-[#c25e19] hover:underline">
                        <span>View Location & Map Directions</span>
                        <span>→</span>
                    </a>
                    <span class="hidden sm:inline text-stone-400">|</span>
                    <a href="tel:078545455" class="text-sm font-bold text-stone-900 hover:text-[#c25e19]">
                        📞 Front Desk: <strong>078-545455</strong>
                    </a>
                </div>
            </div>

            <!-- Right Image Showcase -->
            <div class="lg:col-span-5 relative">
                <div class="relative rounded-3xl overflow-hidden shadow-xl border-4 border-white">
                    <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=1200&q=80" 
                         alt="Resort Courtyard and Pool" 
                         class="w-full h-80 sm:h-[420px] object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-stone-950/70 via-transparent to-transparent"></div>
                    <div class="absolute bottom-5 left-5 right-5 text-white">
                        <span class="text-xs uppercase tracking-wider text-amber-300 font-bold block">Narayani Sanctuary</span>
                        <h4 class="text-lg sm:text-xl font-bold">Serenity, Fresh Air & Nature Combined</h4>
                    </div>
                </div>

                <!-- Overlapping Floating Rating Badge -->
                <div class="absolute -bottom-5 -left-5 bg-white p-4 rounded-2xl shadow-xl border-2 border-stone-200 flex items-center gap-3 hidden sm:flex">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-[#c25e19] flex items-center justify-center text-2xl font-bold">
                        ★
                    </div>
                    <div>
                        <span class="text-lg font-black text-stone-900 block leading-tight">4.9 / 5.0</span>
                        <span class="text-xs text-stone-600 font-bold">Guest Satisfaction</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 3. Featured Rooms & Suites Showcase -->
<section class="py-16 sm:py-24 bg-[#faf7f2] border-y border-[#eae4d8]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <span class="text-xs sm:text-sm font-bold uppercase tracking-wider text-[#c25e19] mb-1.5 block">Accommodations</span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-stone-900 tracking-tight">
                    Rooms & Suites (NPR)
                </h2>
                <p class="text-stone-700 text-sm sm:text-base mt-2 max-w-xl">
                    Spacious, clean, and well-ventilated rooms with private attached bathrooms, air conditioning, and peaceful outdoor balconies.
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('rooms.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white border-2 border-stone-300 text-stone-900 text-sm font-bold hover:border-[#c25e19] hover:text-[#c25e19] transition shadow-sm">
                    <span>View All Rooms</span>
                    <span>→</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($rooms as $room)
                <div class="bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 border-2 border-[#eae4d8] flex flex-col group">
                    <!-- Photo Header -->
                    <div class="relative h-64 overflow-hidden bg-stone-100">
                        <img src="{{ $room->featured_image_url }}" 
                             alt="{{ $room->name }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1.5 rounded-full bg-stone-900/90 text-white text-xs font-bold uppercase tracking-wider">
                                {{ $room->view_type }}
                            </span>
                        </div>
                        <div class="absolute bottom-4 right-4 px-4 py-2.5 rounded-2xl bg-white shadow-lg text-right border-2 border-stone-200">
                            <span class="text-[11px] text-stone-600 block uppercase font-bold">Per Night</span>
                            <span class="text-xl sm:text-2xl font-black text-[#c25e19]">NPR {{ number_format($room->base_price) }}</span>
                        </div>
                    </div>

                    <!-- Room Details -->
                    <div class="p-6 sm:p-7 flex-grow flex flex-col justify-between">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-[#c25e19] block mb-1">
                                {{ $room->category?->name ?? 'Resort Suite' }}
                            </span>
                            <h3 class="text-xl sm:text-2xl font-bold text-stone-900 mb-2 group-hover:text-[#c25e19] transition-colors">
                                <a href="{{ route('rooms.show', $room->slug) }}">{{ $room->name }}</a>
                            </h3>
                            <p class="text-stone-600 text-sm leading-relaxed mb-4">
                                {{ $room->short_description ?? 'Comfortable, clean rooms equipped with comfortable king size bedding, private bath, and garden outlook.' }}
                            </p>

                            <!-- Metadata -->
                            <div class="flex items-center gap-3 text-xs sm:text-sm text-stone-600 mb-5 pb-5 border-b border-stone-200 font-semibold">
                                <span>👥 Up to {{ $room->max_adults }} Adults</span>
                                <span>•</span>
                                <span>☕ Breakfast Included</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between gap-3 pt-2">
                            <a href="{{ route('rooms.show', $room->slug) }}" 
                               class="text-xs sm:text-sm font-bold text-stone-700 hover:text-[#c25e19] underline">
                                Details & Photos
                            </a>
                            <a href="{{ route('rooms.show', $room->slug) }}" 
                               class="px-6 py-3 rounded-xl bg-[#c25e19] hover:bg-[#d96b20] text-white text-xs sm:text-sm font-bold uppercase tracking-wider shadow-md active:scale-95 transition">
                                Reserve
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 text-stone-500 font-medium">
                    Rooms information loading.
                </div>
            @endforelse
        </div>

    </div>
</section>

<!-- 4. Safari & Wilderness Experiences -->
<section class="py-16 sm:py-24 bg-[#14281d] text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-12 sm:mb-16">
            <span class="text-xs sm:text-sm font-bold uppercase tracking-wider text-[#f08235] mb-2 block">
                Chitwan Wilderness
            </span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-white">
                Safari & Outdoor Experiences
            </h2>
            <p class="text-stone-200 text-sm sm:text-base mt-2 font-normal">
                Safe, guided wildlife jeep safaris, river boating, and bird watching trips suitable for all family members.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($activities as $activity)
                <div class="bg-white/10 rounded-3xl overflow-hidden border border-white/15 flex flex-col group">
                    <div class="relative h-56 overflow-hidden">
                        <img src="{{ $activity->featured_image_url }}" 
                             alt="{{ $activity->title }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @if($activity->duration)
                            <div class="absolute top-3 left-3 px-3 py-1 rounded-full bg-black/80 text-xs font-bold text-white">
                                ⏱ {{ $activity->duration }}
                            </div>
                        @endif
                    </div>
                    <div class="p-5 sm:p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg sm:text-xl font-bold text-white mb-2 group-hover:text-[#f08235] transition-colors">
                                <a href="{{ route('activities.show', $activity->slug) }}">{{ $activity->title }}</a>
                            </h3>
                            <p class="text-stone-200 text-xs sm:text-sm line-clamp-3 leading-relaxed mb-4">
                                {{ $activity->short_description ?? 'Experience Chitwan National Park buffer zone nature with friendly certified guides.' }}
                            </p>
                        </div>
                        <a href="{{ route('activities.show', $activity->slug) }}" class="text-xs sm:text-sm font-bold text-[#f08235] hover:underline">
                            Read Details & Itinerary →
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-10 text-stone-300">
                    Safari activities information loading.
                </div>
            @endforelse
        </div>

    </div>
</section>

<!-- 5. Real Guest Reviews & Testimonials -->
<section class="py-16 sm:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-12 sm:mb-16">
            <span class="text-xs sm:text-sm font-bold uppercase tracking-wider text-[#c25e19] mb-1.5 block">Reviews</span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-stone-900">
                What Guests Say About Us
            </h2>
            <p class="text-stone-600 text-sm sm:text-base mt-2">
                Real feedback from visitors who stayed at our resort in Piprahar, Devchuli.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($testimonials as $review)
                <div class="bg-[#faf7f2] p-6 sm:p-8 rounded-3xl border-2 border-[#eae4d8] flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-1 text-amber-500 text-base mb-3">
                            @for($i = 0; $i < ($review->rating ?? 5); $i++)
                                ★
                            @endfor
                        </div>
                        <p class="text-stone-800 text-sm sm:text-base leading-relaxed mb-6 font-normal">
                            "{{ $review->content }}"
                        </p>
                    </div>
                    <div class="pt-4 border-t border-stone-200 flex items-center justify-between">
                        <div>
                            <h4 class="font-bold text-sm text-stone-900">{{ $review->name }}</h4>
                            <span class="text-xs text-stone-600 font-semibold">{{ $review->origin ?? 'Guest' }}</span>
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

<!-- 6. Direct Booking Callout (Senior Friendly Phone Call CTA) -->
<section class="py-16 sm:py-20 bg-[#14281d] text-white text-center">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs sm:text-sm font-bold uppercase tracking-wider text-[#f08235] mb-2 block">Direct Phone Reservation</span>
        <h2 class="text-2xl sm:text-4xl font-extrabold mb-4">
            Call Our Front Desk Directly
        </h2>
        <p class="text-stone-200 text-sm sm:text-base max-w-xl mx-auto mb-8 leading-relaxed">
            Prefer speaking directly with our front desk staff? Call anytime for instant room availability or safari advice.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="tel:078545455" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-white text-stone-900 font-bold text-base shadow-xl hover:bg-stone-100 transition">
                📞 Call 078-545455
            </a>
            <a href="tel:9749382246" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-[#c25e19] hover:bg-[#d96b20] text-white font-bold text-base shadow-xl transition">
                📱 Call Mobile: 9749382246
            </a>
        </div>
    </div>
</section>

@endsection
