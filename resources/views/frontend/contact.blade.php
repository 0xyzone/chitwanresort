@extends('frontend.layouts.app')

@section('title', 'Contact Us & Location | Sishwar Chitwan Tiger Resort')
@section('meta_description', 'Get in touch with Sishwar Chitwan Tiger Resort in Devchuli-17, Piprahar, Nawalparasi. Call 078-545455 or 9749382246, or book directly via WhatsApp.')

@section('content')

<!-- Header Banner -->
<div class="bg-stone-900 text-white py-16 relative overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-25">
        <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=2000&q=80" alt="Resort Reception & Grounds" class="w-full h-full object-cover">
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-xs font-bold uppercase tracking-widest text-orange-400 mb-2 block">Reach Out</span>
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold font-serif-title mb-4">Contact & Location</h1>
        <p class="max-w-xl mx-auto text-stone-300 text-sm sm:text-base">
            We are situated by the serene Narayani River in Piprahar, Devchuli. Connect with us for bookings, safaris, or custom retreat packages.
        </p>
    </div>
</div>

<section class="py-16 bg-[#faf8f5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if(session('success'))
            <div class="mb-10 p-5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start gap-3 shadow-xs">
                <svg class="w-6 h-6 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <h4 class="font-bold text-sm">Message Sent Successfully!</h4>
                    <p class="text-xs sm:text-sm text-emerald-700 mt-1">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Contact Details & Map (Left 5 Cols) -->
            <div class="lg:col-span-5 space-y-8">
                
                <!-- Quick Contact Cards -->
                <div class="bg-white rounded-3xl p-8 border border-stone-200/80 shadow-xs space-y-6">
                    <h3 class="text-xl font-bold font-serif-title text-stone-900 border-b border-stone-100 pb-4">Resort Information</h3>
                    
                    <div class="space-y-5">
                        <!-- Location -->
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <span class="text-xs uppercase font-bold tracking-wider text-stone-400 block">Location</span>
                                <p class="text-stone-800 font-semibold text-sm mt-0.5">Devchuli-17, Piprahar, Nawalparasi / Chitwan, Nepal</p>
                                <p class="text-stone-500 text-xs mt-0.5">Along the Narayani River corridor</p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <span class="text-xs uppercase font-bold tracking-wider text-stone-400 block">Phone Lines</span>
                                <div class="flex flex-col gap-1 mt-0.5">
                                    <a href="tel:078545455" class="text-stone-800 font-semibold text-sm hover:text-orange-600 transition">078-545455 (Front Desk)</a>
                                    <a href="tel:9749382246" class="text-stone-800 font-semibold text-sm hover:text-orange-600 transition">+977 9749382246 (Direct / Mobile)</a>
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <span class="text-xs uppercase font-bold tracking-wider text-stone-400 block">Email Inquiries</span>
                                <a href="mailto:info@chitwantigerresorts.com" class="text-stone-800 font-semibold text-sm hover:text-orange-600 transition mt-0.5 block">
                                    info@chitwantigerresorts.com
                                </a>
                            </div>
                        </div>

                        <!-- WhatsApp Action -->
                        <div class="pt-4 border-t border-stone-100">
                            <a href="https://wa.me/9779749382246?text={{ urlencode('Hello Sishwar Chitwan Tiger Resort! I would like to inquire about room availability and safari packages.') }}" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="w-full inline-flex items-center justify-center gap-2.5 py-3 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                                </svg>
                                <span>Instant WhatsApp Chat</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Google Map Locator Container -->
                <div class="bg-white rounded-3xl p-4 border border-stone-200/80 shadow-xs overflow-hidden">
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
                <div class="bg-white rounded-3xl p-8 sm:p-10 border border-stone-200/80 shadow-xs">
                    <span class="text-xs font-bold uppercase tracking-wider text-orange-600 block mb-1">Send a Message</span>
                    <h2 class="text-2xl sm:text-3xl font-bold font-serif-title text-stone-900 mb-2">How Can We Help You?</h2>
                    <p class="text-stone-600 text-sm mb-8">
                        Whether you are planning a jungle safari tour, corporate seminar, or a family weekend retreat, our team is ready to assist you.
                    </p>

                    <form action="{{ route('inquiry.submit') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Full Name & Phone -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1.5">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       required 
                                       placeholder="e.g. Ramesh Adhikari"
                                       class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm text-stone-800 transition @error('name') border-red-500 @enderror">
                                @error('name')
                                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1.5">
                                    Phone / WhatsApp Number
                                </label>
                                <input type="tel" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone') }}" 
                                       placeholder="e.g. 9841234567"
                                       class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm text-stone-800 transition @error('phone') border-red-500 @enderror">
                                @error('phone')
                                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email & Subject -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1.5">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required 
                                       placeholder="e.g. ramesh@example.com"
                                       class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm text-stone-800 transition @error('email') border-red-500 @enderror">
                                @error('email')
                                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="subject" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1.5">
                                    Subject / Inquiry Type
                                </label>
                                <input type="text" 
                                       id="subject" 
                                       name="subject" 
                                       value="{{ old('subject') }}" 
                                       placeholder="e.g. Jungle Safari Package or Group Booking"
                                       class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm text-stone-800 transition @error('subject') border-red-500 @enderror">
                                @error('subject')
                                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1.5">
                                Your Message or Special Requests <span class="text-red-500">*</span>
                            </label>
                            <textarea id="message" 
                                      name="message" 
                                      rows="5" 
                                      required 
                                      placeholder="Let us know your estimated travel dates, number of guests, or any questions regarding safari activities..."
                                      class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm text-stone-800 transition @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                            @error('message')
                                <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" 
                                    class="w-full py-4 px-6 rounded-xl bg-orange-600 hover:bg-orange-700 text-white font-bold text-sm tracking-wide shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2 group">
                                <span>Send Inquiry</span>
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                            <p class="text-[11px] text-stone-400 text-center mt-3">
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
