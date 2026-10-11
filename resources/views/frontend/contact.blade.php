@extends('frontend.layouts.app')

@section('title', 'Contact Us & Location | Sishwar Chitwan Tiger Resort')
@section('meta_description', 'Get in touch with Sishwar Chitwan Tiger Resort in Devchuli-17, Piprahar, Nawalparasi. Call 078-545455 or 9749382246, or book directly via WhatsApp.')

@section('content')

<!-- Header Banner -->
<div class="bg-[#14281d] text-white py-20 relative overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-20">
        <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=2200&q=80" alt="Resort Reception & Grounds" class="w-full h-full object-cover">
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-xs font-bold uppercase tracking-widest text-[#f08235] mb-2 block">Reach Out</span>
        <h1 class="text-4xl sm:text-6xl font-normal font-serif-luxury mb-4">Contact & Location</h1>
        <p class="max-w-xl mx-auto text-stone-300 text-sm sm:text-base font-light">
            We are situated by the serene Narayani River in Piprahar, Devchuli. Connect with us for bookings, safaris, or custom retreat packages.
        </p>
    </div>
</div>

<section class="py-20 bg-[#fcfbf9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if(session('success'))
            <div class="mb-10 p-5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start gap-3 shadow-xs">
                <span class="text-xl">🌿</span>
                <div>
                    <h4 class="font-bold text-sm">Message Sent Successfully!</h4>
                    <p class="text-xs sm:text-sm text-emerald-700 mt-0.5">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Contact Details & Map (Left 5 Cols) -->
            <div class="lg:col-span-5 space-y-8">
                
                <!-- Quick Contact Cards -->
                <div class="bg-white rounded-3xl p-8 sm:p-10 border border-[#eae4d8] luxury-shadow space-y-6">
                    <span class="text-xs font-bold uppercase tracking-widest text-[#c25e19] block">Front Desk</span>
                    <h3 class="text-2xl font-normal font-serif-luxury text-stone-900 border-b border-[#eae4d8] pb-4">Resort Information</h3>
                    
                    <div class="space-y-6">
                        <!-- Location -->
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-2xl bg-[#faf7f2] border border-[#eae4d8] text-[#c25e19] flex items-center justify-center flex-shrink-0">
                                📍
                            </div>
                            <div>
                                <span class="text-[11px] uppercase font-bold tracking-wider text-stone-400 block">Location</span>
                                <p class="text-stone-800 font-semibold text-sm mt-0.5">Devchuli-17, Piprahar, Nawalparasi / Chitwan, Nepal</p>
                                <p class="text-stone-500 text-xs mt-0.5 font-light">Along the Narayani River corridor</p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-2xl bg-[#faf7f2] border border-[#eae4d8] text-[#c25e19] flex items-center justify-center flex-shrink-0">
                                📞
                            </div>
                            <div>
                                <span class="text-[11px] uppercase font-bold tracking-wider text-stone-400 block">Phone Lines</span>
                                <div class="flex flex-col gap-1 mt-0.5">
                                    <a href="tel:078545455" class="text-stone-800 font-semibold text-sm hover:text-[#c25e19] transition">078-545455 (Front Desk)</a>
                                    <a href="tel:9749382246" class="text-stone-800 font-semibold text-sm hover:text-[#c25e19] transition">+977 9749382246 (Direct / Mobile)</a>
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-2xl bg-[#faf7f2] border border-[#eae4d8] text-[#c25e19] flex items-center justify-center flex-shrink-0">
                                ✉️
                            </div>
                            <div>
                                <span class="text-[11px] uppercase font-bold tracking-wider text-stone-400 block">Email Inquiries</span>
                                <a href="mailto:info@chitwantigerresorts.com" class="text-stone-800 font-semibold text-sm hover:text-[#c25e19] transition mt-0.5 block">
                                    info@chitwantigerresorts.com
                                </a>
                            </div>
                        </div>

                        <!-- WhatsApp Action -->
                        <div class="pt-4 border-t border-[#eae4d8]">
                            <a href="https://wa.me/9779749382246?text={{ urlencode('Hello Sishwar Chitwan Tiger Resort! I would like to inquire about room availability and safari packages.') }}" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="w-full inline-flex items-center justify-center gap-2.5 py-3.5 px-4 rounded-2xl bg-emerald-700 hover:bg-emerald-800 text-white font-semibold text-xs uppercase tracking-wider shadow-sm transition">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                                </svg>
                                <span>Instant WhatsApp Chat</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Google Map Locator Container -->
                <div class="bg-white rounded-3xl p-4 border border-[#eae4d8] luxury-shadow overflow-hidden">
                    <div class="rounded-2xl overflow-hidden aspect-video bg-stone-100">
                        <iframe 
                            src="https://maps.google.com/maps?q=Devchuli%2017%20Piprahar%20Nawalparasi&t=&z=13&ie=UTF8&iwloc=&output=embed" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Sishwar Chitwan Tiger Resort Location">
                        </iframe>
                    </div>
                    <div class="p-3 text-center">
                        <span class="text-xs text-stone-500 font-medium">Devchuli-17, Piprahar, Nawalparasi (Narayani Riverbank)</span>
                    </div>
                </div>
            </div>

            <!-- Inquiry Form (Right 7 Cols) -->
            <div class="lg:col-span-7">
                <div class="bg-white rounded-3xl p-8 sm:p-12 border border-[#eae4d8] luxury-shadow">
                    <span class="text-xs font-bold uppercase tracking-widest text-[#c25e19] block mb-1">Send a Message</span>
                    <h2 class="text-2xl sm:text-4xl font-normal font-serif-luxury text-stone-900 mb-2">How Can We Help You?</h2>
                    <p class="text-stone-500 text-xs sm:text-sm mb-8 font-light">
                        Whether you are planning a jungle safari tour, corporate retreat, or a family weekend escape, our team is ready to assist you.
                    </p>

                    <form action="{{ route('inquiry.submit') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Full Name & Phone -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block text-[11px] font-bold uppercase tracking-wider text-stone-700 mb-1.5">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       required 
                                       placeholder="e.g. Ramesh Adhikari"
                                       class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#c25e19] focus:outline-hidden text-xs sm:text-sm text-stone-800 transition @error('name') border-red-500 @enderror">
                                @error('name')
                                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-[11px] font-bold uppercase tracking-wider text-stone-700 mb-1.5">
                                    Phone / WhatsApp Number
                                </label>
                                <input type="tel" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone') }}" 
                                       placeholder="e.g. 9841234567"
                                       class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#c25e19] focus:outline-hidden text-xs sm:text-sm text-stone-800 transition @error('phone') border-red-500 @enderror">
                                @error('phone')
                                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email & Subject -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="email" class="block text-[11px] font-bold uppercase tracking-wider text-stone-700 mb-1.5">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required 
                                       placeholder="e.g. ramesh@example.com"
                                       class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#c25e19] focus:outline-hidden text-xs sm:text-sm text-stone-800 transition @error('email') border-red-500 @enderror">
                                @error('email')
                                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="subject" class="block text-[11px] font-bold uppercase tracking-wider text-stone-700 mb-1.5">
                                    Subject / Inquiry Type
                                </label>
                                <input type="text" 
                                       id="subject" 
                                       name="subject" 
                                       value="{{ old('subject') }}" 
                                       placeholder="e.g. Jungle Safari Package or Group Booking"
                                       class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#c25e19] focus:outline-hidden text-xs sm:text-sm text-stone-800 transition @error('subject') border-red-500 @enderror">
                                @error('subject')
                                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-[11px] font-bold uppercase tracking-wider text-stone-700 mb-1.5">
                                Your Message or Special Requests <span class="text-red-500">*</span>
                            </label>
                            <textarea id="message" 
                                      name="message" 
                                      rows="5" 
                                      required 
                                      placeholder="Let us know your estimated travel dates, number of guests, or questions regarding safari packages..."
                                      class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#c25e19] focus:outline-hidden text-xs sm:text-sm text-stone-800 transition @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                            @error('message')
                                <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" 
                                    class="w-full py-4 px-6 rounded-2xl bg-[#c25e19] hover:bg-[#d96b20] text-white font-semibold text-xs uppercase tracking-widest shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2 group">
                                <span>Send Inquiry</span>
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                            <p class="text-[11px] text-stone-400 text-center mt-3 font-light">
                                We respect your privacy. Our front desk typically replies within 2–4 hours.
                            </p>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
