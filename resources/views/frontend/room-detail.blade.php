@extends('frontend.layouts.app')

@section('title', $room->name . ' | Sishwar Chitwan Tiger Resort')
@section('meta_description', 'Book ' . $room->name . ' at Sishwar Chitwan Tiger Resort, Devchuli. Starting from NPR ' . number_format($room->base_price) . ' per night with breakfast included.')

@section('content')

<!-- Room Detail Header -->
<div class="bg-stone-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <a href="{{ route('rooms.index') }}" class="text-xs font-semibold text-orange-400 hover:underline mb-2 inline-flex items-center gap-1">
                    ← Back to All Rooms
                </a>
                <h1 class="text-3xl sm:text-4xl font-bold font-serif-title">{{ $room->name }}</h1>
                <p class="text-stone-400 text-sm mt-1">
                    {{ $room->category?->name }} • {{ $room->view_type }} • {{ $room->bed_type }}
                </p>
            </div>
            <div class="text-left md:text-right">
                <span class="text-xs text-stone-400 block uppercase font-medium">Nightly Rate</span>
                <span class="text-3xl font-bold text-orange-400 font-serif-title">NPR {{ number_format($room->base_price) }}</span>
                <span class="text-xs text-stone-400 block">Taxes & Breakfast included</span>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
        
        <!-- Left: 2 Columns - Media, Story, Amenities, Policies -->
        <div class="lg:col-span-2 space-y-10">
            <!-- Featured Main Photo -->
            <div class="rounded-3xl overflow-hidden shadow-lg border border-stone-200">
                <img src="{{ $room->featured_image_url }}" alt="{{ $room->name }}" class="w-full h-96 sm:h-[480px] object-cover">
            </div>

            <!-- Gallery Thumbnails (if available) -->
            @if(!empty($room->gallery))
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @foreach($room->gallery as $pic)
                        <img src="{{ $pic }}" alt="Room Gallery" class="h-36 w-full object-cover rounded-2xl border border-stone-200 hover:scale-105 transition-transform">
                    @endforeach
                </div>
            @endif

            <!-- Room Description -->
            <div class="bg-white p-8 rounded-3xl border border-stone-200/80 shadow-xs">
                <h2 class="text-2xl font-bold font-serif-title text-stone-900 mb-4">About This Room</h2>
                <div class="prose prose-stone text-sm leading-relaxed text-stone-600">
                    <p>{{ $room->description }}</p>
                </div>

                <!-- Specs Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-8 pt-8 border-t border-stone-100 text-center">
                    <div class="p-4 rounded-2xl bg-stone-50 border border-stone-100">
                        <span class="text-xs text-stone-500 uppercase block mb-1">Max Guests</span>
                        <span class="font-bold text-stone-900 text-sm">👥 {{ $room->capacity_adults + $room->capacity_children }} Persons</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-stone-50 border border-stone-100">
                        <span class="text-xs text-stone-500 uppercase block mb-1">Bed Configuration</span>
                        <span class="font-bold text-stone-900 text-sm">🛏️ {{ $room->bed_type }}</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-stone-50 border border-stone-100">
                        <span class="text-xs text-stone-500 uppercase block mb-1">Window View</span>
                        <span class="font-bold text-stone-900 text-sm">🌄 {{ $room->view_type }}</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-stone-50 border border-stone-100">
                        <span class="text-xs text-stone-500 uppercase block mb-1">Room Area</span>
                        <span class="font-bold text-stone-900 text-sm">📐 {{ $room->room_size ?? 'Spacious' }}</span>
                    </div>
                </div>
            </div>

            <!-- Amenities & Services -->
            <div class="bg-white p-8 rounded-3xl border border-stone-200/80 shadow-xs">
                <h2 class="text-2xl font-bold font-serif-title text-stone-900 mb-6">Included Amenities</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm text-stone-700">
                    @foreach($room->amenities ?? [] as $amenity)
                        <div class="flex items-center gap-2.5 p-2.5 rounded-xl bg-stone-50 border border-stone-100">
                            <span class="w-5 h-5 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-xs font-bold">✓</span>
                            <span>{{ $amenity }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Resort Policies -->
            <div class="bg-white p-8 rounded-3xl border border-stone-200/80 shadow-xs">
                <h2 class="text-2xl font-bold font-serif-title text-stone-900 mb-4">Stay Guidelines & Policies</h2>
                <div class="space-y-3 text-sm text-stone-600">
                    <p class="flex items-center gap-2">
                        <span class="font-bold text-stone-800">Check-In Time:</span>
                        <span>12:00 PM onwards</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <span class="font-bold text-stone-800">Check-Out Time:</span>
                        <span>11:00 AM</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <span class="font-bold text-stone-800">Breakfast Timing:</span>
                        <span>7:00 AM – 10:00 AM at the Riverside Dining Hall</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <span class="font-bold text-stone-800">Cancellation:</span>
                        <span>Free cancellation up to 48 hours prior to check-in. Contact reception for group amendments.</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Right: 1 Column - Instant Direct Reservation Form (Alpine-powered) -->
        <div class="sticky top-28" x-data="{
            pricePerNight: {{ $room->base_price }},
            checkIn: '{{ now()->format('Y-m-d') }}',
            checkOut: '{{ now()->addDay()->format('Y-m-d') }}',
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
            <div class="bg-white p-8 rounded-3xl border-2 border-orange-500/20 shadow-xl">
                <div class="pb-6 mb-6 border-b border-stone-100 flex items-center justify-between">
                    <div>
                        <span class="text-xs text-stone-500 uppercase tracking-wider font-semibold block">Reserve Directly</span>
                        <span class="text-2xl font-bold text-stone-900 font-serif-title">NPR {{ number_format($room->base_price) }}</span>
                        <span class="text-xs text-stone-500">/ night</span>
                    </div>
                    <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold">
                        Guaranteed Best Rate
                    </span>
                </div>

                <!-- Reservation Form -->
                <form action="{{ route('booking.submit') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold uppercase text-stone-600 mb-1">Check-In</label>
                            <input type="date" name="check_in_date" x-model="checkIn" min="{{ now()->format('Y-m-d') }}" required class="w-full px-3 py-2 rounded-xl border border-stone-300 text-xs font-medium focus:ring-2 focus:ring-orange-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-stone-600 mb-1">Check-Out</label>
                            <input type="date" name="check_out_date" x-model="checkOut" min="{{ now()->addDay()->format('Y-m-d') }}" required class="w-full px-3 py-2 rounded-xl border border-stone-300 text-xs font-medium focus:ring-2 focus:ring-orange-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold uppercase text-stone-600 mb-1">Adults</label>
                            <input type="number" name="adults" value="2" min="1" max="{{ $room->capacity_adults }}" required class="w-full px-3 py-2 rounded-xl border border-stone-300 text-xs focus:ring-2 focus:ring-orange-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-stone-600 mb-1">Children</label>
                            <input type="number" name="children" value="0" min="0" max="{{ $room->capacity_children }}" class="w-full px-3 py-2 rounded-xl border border-stone-300 text-xs focus:ring-2 focus:ring-orange-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-stone-600 mb-1">Full Name</label>
                        <input type="text" name="guest_name" required placeholder="e.g. Aarav Sharma" class="w-full px-3 py-2 rounded-xl border border-stone-300 text-xs focus:ring-2 focus:ring-orange-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-stone-600 mb-1">WhatsApp / Phone</label>
                        <input type="tel" name="guest_phone" required placeholder="e.g. 9841234567" class="w-full px-3 py-2 rounded-xl border border-stone-300 text-xs focus:ring-2 focus:ring-orange-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-stone-600 mb-1">Email Address</label>
                        <input type="email" name="guest_email" required placeholder="e.g. aarav@example.com" class="w-full px-3 py-2 rounded-xl border border-stone-300 text-xs focus:ring-2 focus:ring-orange-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-stone-600 mb-1">Special Requests (Optional)</label>
                        <textarea name="special_requests" rows="2" placeholder="Jeep safari timing, airport pickup, etc." class="w-full px-3 py-2 rounded-xl border border-stone-300 text-xs focus:ring-2 focus:ring-orange-500"></textarea>
                    </div>

                    <!-- Price Estimate Breakdown -->
                    <div class="p-4 rounded-2xl bg-stone-50 border border-stone-100 text-xs space-y-2">
                        <div class="flex justify-between text-stone-600">
                            <span>NPR {{ number_format($room->base_price) }} × <span x-text="nights"></span> night(s)</span>
                            <span class="font-bold text-stone-900">NPR <span x-text="totalAmount.toLocaleString()"></span></span>
                        </div>
                        <div class="flex justify-between text-stone-600">
                            <span>Breakfast & Wi-Fi</span>
                            <span class="text-emerald-700 font-semibold">FREE</span>
                        </div>
                        <div class="pt-2 border-t border-stone-200 flex justify-between font-bold text-stone-900 text-sm">
                            <span>Estimated Total:</span>
                            <span class="text-orange-600 font-serif-title">NPR <span x-text="totalAmount.toLocaleString()"></span></span>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3.5 px-4 rounded-xl bg-orange-600 hover:bg-orange-700 text-white font-bold text-sm tracking-wider shadow-md hover:shadow-lg transition active:scale-95">
                        Submit Direct Reservation Request
                    </button>
                    <p class="text-[11px] text-center text-stone-400">
                        ⚡ Instant confirmation code issued. No advance credit card required.
                    </p>
                </form>

                <!-- Front Desk Hotline -->
                <div class="mt-6 pt-6 border-t border-stone-100 text-center">
                    <span class="text-xs text-stone-500 block mb-1">Prefer instant telephone booking?</span>
                    <a href="tel:9749382246" class="text-xs font-bold text-orange-600 hover:underline">📞 Call 9749382246 / 078-545455</a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
