@extends('frontend.layouts.app')

@section('title', $room->name . ' | Sishwar Chitwan Tiger Resort')
@section('meta_description', 'Book ' . $room->name . ' at Sishwar Chitwan Tiger Resort, Devchuli. Starting from NPR ' . number_format($room->base_price) . ' per night with breakfast included.')

@section('content')

<!-- Room Detail Header -->
<div class="bg-[#14281d] text-white py-16 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <a href="{{ route('rooms.index') }}" class="text-xs font-semibold uppercase tracking-widest text-[#f08235] hover:underline mb-3 inline-flex items-center gap-1.5 transition">
                    ← Back to All Accommodations
                </a>
                <h1 class="text-3xl sm:text-5xl font-normal font-serif-luxury text-white mt-1">{{ $room->name }}</h1>
                <p class="text-stone-300 text-xs sm:text-sm mt-2 font-light">
                    {{ $room->category?->name }} • {{ $room->view_type }} • {{ $room->bed_type }}
                </p>
            </div>
            <div class="text-left md:text-right bg-white/10 backdrop-blur-md p-5 rounded-2xl border border-white/10">
                <span class="text-[11px] text-stone-300 block uppercase font-bold tracking-wider">Nightly Rate</span>
                <span class="text-3xl font-normal text-amber-200 font-serif-luxury">NPR {{ number_format($room->base_price) }}</span>
                <span class="text-[11px] text-stone-300 block mt-0.5">Taxes & Breakfast included</span>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 bg-[#fcfbf9]">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        
        <!-- Left: 7 Columns - Media, Story, Amenities, Policies -->
        <div class="lg:col-span-7 space-y-10">
            <!-- Featured Main Photo -->
            <div class="rounded-3xl overflow-hidden luxury-shadow border border-[#eae4d8] group">
                <img src="{{ $room->featured_image_url }}" alt="{{ $room->name }}" class="w-full h-96 sm:h-[480px] object-cover group-hover:scale-105 transition-transform duration-700">
            </div>

            <!-- Gallery Thumbnails (if available) -->
            @if(!empty($room->gallery))
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @foreach($room->gallery as $pic)
                        <div class="rounded-2xl overflow-hidden border border-[#eae4d8] shadow-xs group">
                            <img src="{{ $pic }}" alt="Room Gallery" class="h-36 w-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Room Description -->
            <div class="bg-white p-8 sm:p-10 rounded-3xl border border-[#eae4d8] luxury-shadow">
                <span class="text-xs font-bold uppercase tracking-widest text-[#c25e19] mb-2 block">Room Overview</span>
                <h2 class="text-2xl sm:text-3xl font-normal font-serif-luxury text-stone-900 mb-4">Space & Ambiance</h2>
                <div class="prose prose-stone text-sm sm:text-base leading-relaxed text-stone-600 font-light">
                    <p>{{ $room->description }}</p>
                </div>

                <!-- Specs Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-8 pt-8 border-t border-[#eae4d8] text-center">
                    <div class="p-4 rounded-2xl bg-[#faf7f2] border border-[#eae4d8]">
                        <span class="text-[10px] text-stone-500 uppercase tracking-wider block mb-1">Max Capacity</span>
                        <span class="font-bold text-stone-900 text-xs sm:text-sm">👥 {{ $room->capacity_adults + $room->capacity_children }} Guests</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-[#faf7f2] border border-[#eae4d8]">
                        <span class="text-[10px] text-stone-500 uppercase tracking-wider block mb-1">Bed Setup</span>
                        <span class="font-bold text-stone-900 text-xs sm:text-sm">🛏️ {{ $room->bed_type }}</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-[#faf7f2] border border-[#eae4d8]">
                        <span class="text-[10px] text-stone-500 uppercase tracking-wider block mb-1">Window View</span>
                        <span class="font-bold text-stone-900 text-xs sm:text-sm">🌄 {{ $room->view_type }}</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-[#faf7f2] border border-[#eae4d8]">
                        <span class="text-[10px] text-stone-500 uppercase tracking-wider block mb-1">Room Area</span>
                        <span class="font-bold text-stone-900 text-xs sm:text-sm">📐 {{ $room->room_size ?? 'Spacious' }}</span>
                    </div>
                </div>
            </div>

            <!-- Amenities & Services -->
            <div class="bg-white p-8 sm:p-10 rounded-3xl border border-[#eae4d8] luxury-shadow">
                <span class="text-xs font-bold uppercase tracking-widest text-[#c25e19] mb-2 block">Included Privileges</span>
                <h2 class="text-2xl font-normal font-serif-luxury text-stone-900 mb-6">Room Amenities</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs sm:text-sm text-stone-700">
                    @forelse(($room->amenities ?? []) as $amenity)
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#faf7f2] border border-[#eae4d8]/80">
                            <span class="text-emerald-700 font-bold">✓</span>
                            <span class="font-medium">{{ $amenity }}</span>
                        </div>
                    @empty
                        <div class="p-3 rounded-xl bg-[#faf7f2] border border-[#eae4d8] text-xs">Standard resort amenities included</div>
                    @endforelse
                </div>
            </div>

            <!-- Stay Policies -->
            <div class="bg-white p-8 sm:p-10 rounded-3xl border border-[#eae4d8] luxury-shadow space-y-4">
                <span class="text-xs font-bold uppercase tracking-widest text-[#c25e19] block">Guest Guidelines</span>
                <h3 class="text-2xl font-normal font-serif-luxury text-stone-900">Resort & Check-in Policies</h3>
                <ul class="space-y-2.5 text-xs sm:text-sm text-stone-600 font-light">
                    <li class="flex items-start gap-2">
                        <span class="text-[#c25e19]">🕐</span>
                        <span><strong>Check-in:</strong> 12:00 PM onwards | <strong>Check-out:</strong> 11:00 AM</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-[#c25e19]">🥗</span>
                        <span>Complimentary breakfast served daily at our Narayani dining terrace.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-[#c25e19]">🌿</span>
                        <span>Chitwan National Park buffer zone rules apply. Respect local flora and wildlife.</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Right: 5 Columns - Interactive Alpine Reservation Card -->
        <div class="lg:col-span-5 sticky top-28" x-data="{
            pricePerNight: {{ (float) $room->base_price }},
            checkIn: '{{ now()->format('Y-m-d') }}',
            checkOut: '{{ now()->addDays(2)->format('Y-m-d') }}',
            get nights() {
                if (!this.checkIn || !this.checkOut) return 1;
                let d1 = new Date(this.checkIn);
                let d2 = new Date(this.checkOut);
                let diff = Math.ceil((d2 - d1) / (1000 * 60 * 60 * 24));
                return diff > 0 ? diff : 1;
            },
            get totalAmount() {
                return this.nights * this.pricePerNight;
            }
        }">
            <div class="bg-white p-8 rounded-3xl border border-[#eae4d8] luxury-shadow">
                <div class="pb-6 mb-6 border-b border-[#eae4d8] flex items-center justify-between">
                    <div>
                        <span class="text-xs text-stone-500 uppercase tracking-widest font-semibold block">Reserve Directly</span>
                        <span class="text-2xl font-normal text-stone-900 font-serif-luxury">NPR {{ number_format($room->base_price) }}</span>
                        <span class="text-xs text-stone-500 font-light">/ night</span>
                    </div>
                    <span class="px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-[11px] font-bold uppercase tracking-wider">
                        Best Rate Direct
                    </span>
                </div>

                <!-- Reservation Form -->
                <form action="{{ route('booking.submit') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1">Check-In</label>
                            <input type="date" name="check_in_date" x-model="checkIn" min="{{ now()->format('Y-m-d') }}" required class="w-full px-3 py-2.5 rounded-xl border border-stone-200 text-xs font-medium focus:ring-2 focus:ring-[#c25e19] focus:outline-hidden">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1">Check-Out</label>
                            <input type="date" name="check_out_date" x-model="checkOut" min="{{ now()->addDay()->format('Y-m-d') }}" required class="w-full px-3 py-2.5 rounded-xl border border-stone-200 text-xs font-medium focus:ring-2 focus:ring-[#c25e19] focus:outline-hidden">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1">Adults</label>
                            <input type="number" name="adults" value="2" min="1" max="{{ $room->capacity_adults }}" required class="w-full px-3 py-2.5 rounded-xl border border-stone-200 text-xs focus:ring-2 focus:ring-[#c25e19] focus:outline-hidden">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1">Children</label>
                            <input type="number" name="children" value="0" min="0" max="{{ $room->capacity_children }}" class="w-full px-3 py-2.5 rounded-xl border border-stone-200 text-xs focus:ring-2 focus:ring-[#c25e19] focus:outline-hidden">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1">Guest Full Name</label>
                        <input type="text" name="guest_name" required placeholder="e.g. Aarav Sharma" class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-xs focus:ring-2 focus:ring-[#c25e19] focus:outline-hidden">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1">WhatsApp / Phone Number</label>
                        <input type="tel" name="guest_phone" required placeholder="e.g. 9841234567" class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-xs focus:ring-2 focus:ring-[#c25e19] focus:outline-hidden">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1">Email Address</label>
                        <input type="email" name="guest_email" required placeholder="e.g. aarav@example.com" class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-xs focus:ring-2 focus:ring-[#c25e19] focus:outline-hidden">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1">Special Requests (Optional)</label>
                        <textarea name="special_requests" rows="2" placeholder="Jeep safari timing, airport pickup, dietary notes..." class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-xs focus:ring-2 focus:ring-[#c25e19] focus:outline-hidden"></textarea>
                    </div>

                    <!-- Price Estimate Breakdown -->
                    <div class="p-4 rounded-2xl bg-[#faf7f2] border border-[#eae4d8] text-xs space-y-2">
                        <div class="flex justify-between text-stone-600">
                            <span>NPR {{ number_format($room->base_price) }} × <span x-text="nights"></span> night(s)</span>
                            <span class="font-bold text-stone-900">NPR <span x-text="totalAmount.toLocaleString()"></span></span>
                        </div>
                        <div class="flex justify-between text-stone-600">
                            <span>Breakfast & Wi-Fi</span>
                            <span class="text-emerald-700 font-semibold">FREE</span>
                        </div>
                        <div class="pt-2 border-t border-[#eae4d8] flex justify-between font-bold text-stone-900 text-sm">
                            <span>Estimated Total:</span>
                            <span class="text-[#c25e19] font-serif-luxury text-base">NPR <span x-text="totalAmount.toLocaleString()"></span></span>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 px-4 rounded-xl bg-[#c25e19] hover:bg-[#d96b20] text-white font-semibold text-xs uppercase tracking-widest shadow-md hover:shadow-lg transition active:scale-98">
                        Submit Direct Reservation Request
                    </button>
                    <p class="text-[11px] text-center text-stone-400">
                        ⚡ Instant confirmation code issued. No advance credit card required.
                    </p>
                </form>

                <!-- Front Desk Hotline -->
                <div class="mt-6 pt-6 border-t border-[#eae4d8] text-center">
                    <span class="text-[11px] text-stone-500 block mb-1">Prefer instant telephone booking?</span>
                    <a href="tel:9749382246" class="text-xs font-bold text-[#c25e19] hover:underline">📞 Call 9749382246 / 078-545455</a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
