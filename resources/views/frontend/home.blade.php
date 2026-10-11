@extends('frontend.layouts.app')

@section('title', 'Sishwar Chitwan Tiger Resort | Best Resort in Chitwan & Nawalpur, Nepal')
@section('meta_description', 'Welcome to Sishwar Chitwan Tiger Resort in Devchuli, Nawalparasi. Authentic luxury rooms from NPR 2,500, Narayani River boating, Jeep safari, and wildlife peace.')

@section('content')

<!-- 1. Hero Section with Interactive Availability Bar -->
<section class="relative bg-stone-900 text-white min-h-[85vh] flex items-center justify-center overflow-hidden">
    <!-- Hero Background Image & Gradient Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?auto=format&fit=crop&w=2000&q=85" 
             alt="Chitwan National Park Safari Wilderness" 
             class="w-full h-full object-cover object-center filter brightness-[0.45] scale-105 animate-pulse-slow">
        <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-900/40 to-stone-950/70"></div>
    </div>

    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <!-- Pill Badge -->
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-orange-400 text-xs sm:text-sm font-semibold tracking-wide uppercase mb-6">
            <span>🌿 Serenity by the Narayani River & Chitwan National Park</span>
        </div>

        <!-- Headline -->
        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold font-serif-title tracking-tight text-white mb-6 leading-[1.15]">
            Where Raw Wildlife Meets <br class="hidden sm:inline" />
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 via-amber-300 to-orange-500">
                Peaceful Riverfront Hospitality
            </span>
        </h1>

        <!-- Subheadline -->
        <p class="max-w-2xl mx-auto text-stone-300 text-base sm:text-lg md:text-xl font-normal mb-10 leading-relaxed">
            Escape the crowded hubs. Discover tranquil Sal forests, direct Narayani riverbank breezes, 
            luxurious rooms starting at <strong>NPR 2,500</strong>, and unforgettable Rhino Jeep Safaris in Piprahar, Devchuli.
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16">
            <a href="{{ route('rooms.index') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-orange-600 hover:bg-orange-500 text-white font-bold text-base shadow-lg shadow-orange-600/30 hover:scale-105 transition-all">
                Explore Rooms & Rates (NPR)
            </a>
            <a href="{{ route('activities.index') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-white/10 hover:bg-white/20 backdrop-blur-md text-white font-semibold text-base border border-white/20 transition-all flex items-center justify-center gap-2">
                <span>Safari & River Activities</span>
                <span>→</span>
            </a>
        </div>

        <!-- Check Availability Floating Card -->
        <div class="bg-white/95 backdrop-blur-xl rounded-2xl p-5 sm:p-6 shadow-2xl border border-white/30 text-stone-800 max-w-4xl mx-auto text-left">
            <form action="{{ route('rooms.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 items-end">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-600 mb-1.5">Check-In</label>
                    <input type="date" name="check_in" value="{{ now()->format('Y-m-d') }}" min="{{ now()->format('Y-m-d') }}" class="w-full px-3.5 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-orange-500 focus:outline-hidden">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-600 mb-1.5">Check-Out</label>
                    <input type="date" name="check_out" value="{{ now()->addDays(2)->format('Y-m-d') }}" min="{{ now()->addDay()->format('Y-m-d') }}" class="w-full px-3.5 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-orange-500 focus:outline-hidden">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-600 mb-1.5">Room Category</label>
                    <select name="category" class="w-full px-3.5 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-orange-500 focus:outline-hidden">
                        <option value="">All Room Types</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="w-full py-2.5 rounded-xl bg-stone-900 hover:bg-orange-600 text-white font-bold text-sm transition-all shadow-md">
                        Check Availability
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- 2. Resort Introduction & Statistics -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Info -->
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-orange-600 mb-2 block">
                    Welcome to Devchuli, Nawalparasi
                </span>
                <h2 class="text-3xl sm:text-4xl font-bold font-serif-title text-stone-900 tracking-tight mb-6">
                    A Riverside Sanctuary by Chitwan's Untouched Horizon
                </h2>
                <p class="text-stone-600 leading-relaxed mb-6">
                    Located at <strong>Piprahar, Devchuli-17</strong>, Sishwar Chitwan Tiger Resort (SCTR) introduces visitors to the true wilderness of the Chitwan National Park buffer zone without the hustle and noise of commercial tourist streets.
                </p>
                <p class="text-stone-600 leading-relaxed mb-8">
                    Wake up to the melodies of Siberian migratory birds, watch One-Horned Rhinos drinking at the Narayani riverbank, and relax with authentic Tharu cuisine made from organic farm produce.
                </p>

                <!-- Highlights Bullet List -->
                <div class="grid grid-cols-2 gap-4 text-sm font-semibold text-stone-800 mb-8">
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-xs">✓</span>
                        Narayani Riverfront
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-xs">✓</span>
                        Licensed Safari Guides
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-xs">✓</span>
                        Seminar & Event Hall
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-xs">✓</span>
                        Airport Pickup & Drop
                    </div>
                </div>

                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-sm font-bold text-orange-600 hover:text-orange-700">
                    <span>Contact Resort Desk (078-545455 / 9749382246)</span>
                    <span>→</span>
                </a>
            </div>

            <!-- Right Visual Collage -->
            <div class="grid grid-cols-2 gap-4">
                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=700&q=80" alt="Resort Night View" class="rounded-2xl shadow-md object-cover h-64 w-full">
                <img src="https://images.unsplash.com/photo-1575550959106-5a7defe28b56?auto=format&fit=crop&w=700&q=80" alt="Rhino Safari" class="rounded-2xl shadow-md object-cover h-64 w-full mt-6">
                <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?auto=format&fit=crop&w=700&q=80" alt="King Size Room" class="rounded-2xl shadow-md object-cover h-64 w-full -mt-6">
                <img src="https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=700&q=80" alt="River Boating" class="rounded-2xl shadow-md object-cover h-64 w-full">
            </div>
        </div>
    </div>
</section>

<!-- 3. Featured Rooms & Accommodation Showcase -->
<section class="py-20 bg-[#f5f2eb]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-orange-600 mb-2 block">
                Comfort & Luxury in the Woods
            </span>
            <h2 class="text-3xl sm:text-4xl font-bold font-serif-title text-stone-900 tracking-tight mb-4">
                Our Signature Accommodations
            </h2>
            <p class="text-stone-600 text-sm sm:text-base">
                Each room is thoughtfully designed with handcrafted regional woodwork, modern attached bathrooms, high-speed Wi-Fi, and plush mattresses.
            </p>
        </div>

        <!-- Room Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($rooms as $room)
                <div class="bg-white rounded-2xl overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col group border border-stone-200/80">
                    <!-- Image with Badge -->
                    <div class="relative h-64 overflow-hidden bg-stone-100">
                        <img src="{{ $room->featured_image_url }}" alt="{{ $room->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-3 left-3 flex flex-col gap-1.5">
                            <span class="px-2.5 py-1 rounded-lg bg-stone-900/80 backdrop-blur-md text-white text-xs font-semibold">
                                {{ $room->view_type }}
                            </span>
                            @if($room->is_featured)
                                <span class="px-2.5 py-1 rounded-lg bg-orange-600/90 text-white text-xs font-bold uppercase tracking-wider">
                                    Popular
                                </span>
                            @endif
                        </div>
                        <div class="absolute bottom-3 right-3 px-3 py-1.5 rounded-xl bg-white/95 backdrop-blur-md shadow-sm text-right">
                            <span class="text-xs text-stone-500 block uppercase font-medium">Per Night</span>
                            <span class="text-lg font-bold text-orange-600 font-serif-title">NPR {{ number_format($room->base_price) }}</span>
                        </div>
                    </div>

                    <!-- Room Content -->
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <span class="text-xs font-semibold text-orange-600 uppercase tracking-wider block mb-1">
                                {{ $room->category?->name ?? 'Resort Room' }}
                            </span>
                            <h3 class="text-xl font-bold font-serif-title text-stone-900 mb-2 group-hover:text-orange-600 transition-colors">
                                <a href="{{ route('rooms.show', $room->slug) }}">{{ $room->name }}</a>
                            </h3>
                            <p class="text-stone-600 text-xs sm:text-sm line-clamp-2 mb-4 leading-relaxed">
                                {{ $room->description }}
                            </p>

                            <!-- Specs -->
                            <div class="flex items-center gap-4 text-xs text-stone-500 pb-4 mb-4 border-b border-stone-100">
                                <span>👥 {{ $room->capacity_adults }} Adults, {{ $room->capacity_children }} Ch.</span>
                                <span>🛏️ {{ $room->bed_type }}</span>
                                @if($room->room_size)
                                    <span>📐 {{ $room->room_size }}</span>
                                @endif
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center gap-2 pt-2">
                            <a href="{{ route('rooms.show', $room->slug) }}" class="flex-1 text-center py-2.5 px-4 rounded-xl bg-stone-900 hover:bg-orange-600 text-white font-semibold text-xs tracking-wider transition-colors">
                                View Details & Reserve
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('rooms.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border border-stone-400 text-stone-800 font-semibold text-sm hover:bg-stone-900 hover:text-white transition">
                <span>View All Resort Suites</span>
                <span>→</span>
            </a>
        </div>
    </div>
</section>

<!-- 4. Safari & Experiences -->
<section class="py-20 bg-[#14281d] text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-orange-400 mb-2 block">
                    Jungle Expeditions & Adventures
                </span>
                <h2 class="text-3xl sm:text-4xl font-bold font-serif-title text-white tracking-tight">
                    Experience The Wild Chitwan Heart
                </h2>
            </div>
            <a href="{{ route('activities.index') }}" class="text-sm font-semibold text-orange-400 hover:text-orange-300 flex items-center gap-1.5">
                <span>See All Activities</span>
                <span>→</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($activities as $act)
                <div class="bg-stone-900/80 rounded-2xl overflow-hidden border border-stone-800 hover:border-orange-500/50 transition duration-300 group flex flex-col">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $act->featured_image_url }}" alt="{{ $act->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @if($act->price_per_person)
                            <div class="absolute bottom-2.5 right-2.5 px-2.5 py-1 rounded-lg bg-black/70 backdrop-blur-md text-xs font-bold text-orange-400">
                                NPR {{ number_format($act->price_per_person) }} / person
                            </div>
                        @endif
                    </div>
                    <div class="p-5 flex-grow flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between text-xs text-stone-400 mb-2">
                                <span>⏱️ {{ $act->duration }}</span>
                                <span class="px-2 py-0.5 rounded-sm bg-stone-800 text-stone-300">{{ $act->difficulty }}</span>
                            </div>
                            <h3 class="text-base font-bold font-serif-title text-white mb-2 group-hover:text-orange-400 transition-colors">
                                <a href="{{ route('activities.show', $act->slug) }}">{{ $act->title }}</a>
                            </h3>
                            <p class="text-stone-400 text-xs line-clamp-3 leading-relaxed mb-4">
                                {{ $act->excerpt }}
                            </p>
                        </div>
                        <a href="{{ route('activities.show', $act->slug) }}" class="text-xs font-semibold text-orange-400 hover:text-orange-300 inline-flex items-center gap-1">
                            <span>Read Itinerary</span>
                            <span>→</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 5. Resort Amenities Grid -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-orange-600 mb-2 block">
                Amenities & Services
            </span>
            <h2 class="text-3xl sm:text-4xl font-bold font-serif-title text-stone-900 tracking-tight mb-4">
                Designed for Complete Peace & Convenience
            </h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 text-center">
            <div class="p-6 rounded-2xl bg-stone-50 border border-stone-100 hover:shadow-md transition">
                <span class="text-3xl mb-3 block">🍽️</span>
                <h4 class="font-bold text-sm text-stone-800 mb-1">Restaurant & Bar</h4>
                <p class="text-xs text-stone-500">Authentic Tharu & multi-cuisine dishes</p>
            </div>
            <div class="p-6 rounded-2xl bg-stone-50 border border-stone-100 hover:shadow-md transition">
                <span class="text-3xl mb-3 block">🏛️</span>
                <h4 class="font-bold text-sm text-stone-800 mb-1">Seminar Hall</h4>
                <p class="text-xs text-stone-500">Corporate retreats & workshops</p>
            </div>
            <div class="p-6 rounded-2xl bg-stone-50 border border-stone-100 hover:shadow-md transition">
                <span class="text-3xl mb-3 block">📶</span>
                <h4 class="font-bold text-sm text-stone-800 mb-1">High-Speed Wi-Fi</h4>
                <p class="text-xs text-stone-500">Complimentary across property</p>
            </div>
            <div class="p-6 rounded-2xl bg-stone-50 border border-stone-100 hover:shadow-md transition">
                <span class="text-3xl mb-3 block">🚗</span>
                <h4 class="font-bold text-sm text-stone-800 mb-1">Ample Parking</h4>
                <p class="text-xs text-stone-500">24/7 guarded security grounds</p>
            </div>
            <div class="p-6 rounded-2xl bg-stone-50 border border-stone-100 hover:shadow-md transition">
                <span class="text-3xl mb-3 block">🚐</span>
                <h4 class="font-bold text-sm text-stone-800 mb-1">Pick & Drop</h4>
                <p class="text-xs text-stone-500">Bharatpur & Kawasoti transfers</p>
            </div>
            <div class="p-6 rounded-2xl bg-stone-50 border border-stone-100 hover:shadow-md transition">
                <span class="text-3xl mb-3 block">🔥</span>
                <h4 class="font-bold text-sm text-stone-800 mb-1">Campfire Nights</h4>
                <p class="text-xs text-stone-500">Evening Tharu cultural dances</p>
            </div>
        </div>
    </div>
</section>

<!-- 6. Real Guest Testimonials -->
<section class="py-20 bg-[#faf8f5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-orange-600 mb-2 block">
                What Our Guests Say
            </span>
            <h2 class="text-3xl sm:text-4xl font-bold font-serif-title text-stone-900 tracking-tight">
                Authentic Experiences & Memories
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($testimonials as $t)
                <div class="p-8 rounded-2xl bg-white border border-stone-200/80 shadow-xs flex flex-col justify-between">
                    <div>
                        <div class="text-amber-500 text-sm mb-4">
                            {{ str_repeat('★', $t->rating) }}
                        </div>
                        <p class="text-stone-700 text-sm italic leading-relaxed mb-6">
                            "{{ $t->review_text }}"
                        </p>
                    </div>
                    <div class="flex items-center gap-3 pt-4 border-t border-stone-100">
                        <img src="{{ $t->avatar_url }}" alt="{{ $t->guest_name }}" class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <h4 class="font-bold text-sm text-stone-900">{{ $t->guest_name }}</h4>
                            <span class="text-xs text-stone-500">{{ $t->guest_country }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 7. Call To Action Banner -->
<section class="py-16 bg-gradient-to-r from-orange-600 via-amber-600 to-orange-700 text-white text-center">
    <div class="max-w-4xl mx-auto px-4">
        <h2 class="text-3xl sm:text-4xl font-bold font-serif-title mb-4">
            Ready for Serenity by the Narayani River?
        </h2>
        <p class="text-orange-100 text-base sm:text-lg mb-8 max-w-2xl mx-auto">
            Book directly with us for guaranteed best rates, complimentary breakfast, and personalized safari planning.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('rooms.index') }}" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-white text-orange-700 font-bold text-sm shadow-md hover:bg-orange-50 transition">
                Book Your Stay Today
            </a>
            <a href="https://wa.me/9779749382246" target="_blank" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-stone-900/60 hover:bg-stone-900 text-white font-semibold text-sm border border-white/20 transition flex items-center justify-center gap-2">
                <span>WhatsApp: +977 9749382246</span>
            </a>
        </div>
    </div>
</section>

@endsection
