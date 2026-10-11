<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sishwar Chitwan Tiger Resort | Devchuli, Nawalparasi, Nepal')</title>
    <meta name="description" content="@yield('meta_description', 'Experience peace and safari wilderness at Sishwar Chitwan Tiger Resort in Devchuli, Nawalparasi. Serenity by Narayani River & Chitwan National Park.')">

    <!-- Google Fonts: Cormorant Garamond (Headings) & Plus Jakarta Sans (Body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-serif-title, .font-serif-luxury {
            font-family: 'Cormorant Garamond', Georgia, serif;
            letter-spacing: -0.015em;
        }
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        }
    </style>
</head>
<body class="bg-[#fcfbf9] text-[#2c332d] font-sans antialiased selection:bg-[#c25e19] selection:text-white flex flex-col min-h-screen" x-data="{ mobileNav: false }">

    <!-- Top Announcement Bar -->
    <div class="bg-[#14281d] text-stone-300 text-xs py-2 px-4 border-b border-white/10">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center space-x-4">
                <span class="flex items-center gap-1.5 text-stone-300 font-medium tracking-wide">
                    <svg class="w-3.5 h-3.5 text-[#f08235]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                    Devchuli-17, Piprahar, Nawalparasi, Nepal
                </span>
                <span class="hidden md:inline-block text-stone-600">/</span>
                <span class="hidden md:flex items-center gap-1.5 text-stone-300">
                    <svg class="w-3.5 h-3.5 text-[#f08235]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                    </svg>
                    info@chitwantigerresorts.com
                </span>
            </div>
            <div class="flex items-center space-x-4 text-xs font-medium">
                <a href="tel:078545455" class="hover:text-[#f08235] transition-colors">Front Desk: 078-545455</a>
                <span class="text-stone-600">•</span>
                <a href="tel:9749382246" class="text-[#f08235] font-semibold hover:underline">9749382246</a>
                <a href="{{ url('/mukhiyadwar') }}" class="ml-2 px-2.5 py-0.5 rounded-full bg-white/10 text-stone-300 hover:text-white hover:bg-white/20 text-[11px] border border-white/10 transition">
                    Staff Portal
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-[#eae4d8]/80 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3.5 group">
                <div class="w-11 h-11 rounded-2xl bg-[#14281d] border border-amber-600/30 flex items-center justify-center text-xl shadow-md group-hover:scale-105 transition-transform duration-300">
                    🐅
                </div>
                <div>
                    <span class="block text-xl font-bold font-serif-title tracking-tight text-[#14281d] group-hover:text-[#c25e19] transition-colors">
                        Sishwar Chitwan Tiger Resort
                    </span>
                    <span class="block text-[10.5px] uppercase tracking-widest text-stone-500 font-medium">
                        Devchuli, Piprahar • Narayani Riverbank
                    </span>
                </div>
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden lg:flex items-center gap-8 font-medium text-xs tracking-wider uppercase text-stone-600">
                <a href="{{ route('home') }}" class="hover:text-[#c25e19] transition-colors py-1 relative {{ request()->routeIs('home') ? 'text-[#c25e19] font-bold after:content-[\'\'] after:absolute after:bottom-0 after:left-0 after:right-0 after:h-[2px] after:bg-[#c25e19]' : '' }}">
                    Home
                </a>
                <a href="{{ route('rooms.index') }}" class="hover:text-[#c25e19] transition-colors py-1 relative {{ request()->routeIs('rooms.*') ? 'text-[#c25e19] font-bold after:content-[\'\'] after:absolute after:bottom-0 after:left-0 after:right-0 after:h-[2px] after:bg-[#c25e19]' : '' }}">
                    Rooms & Suites
                </a>
                <a href="{{ route('activities.index') }}" class="hover:text-[#c25e19] transition-colors py-1 relative {{ request()->routeIs('activities.*') ? 'text-[#c25e19] font-bold after:content-[\'\'] after:absolute after:bottom-0 after:left-0 after:right-0 after:h-[2px] after:bg-[#c25e19]' : '' }}">
                    Safaris & Activities
                </a>
                <a href="{{ route('gallery.index') }}" class="hover:text-[#c25e19] transition-colors py-1 relative {{ request()->routeIs('gallery.*') ? 'text-[#c25e19] font-bold after:content-[\'\'] after:absolute after:bottom-0 after:left-0 after:right-0 after:h-[2px] after:bg-[#c25e19]' : '' }}">
                    Gallery
                </a>
                <a href="{{ route('contact') }}" class="hover:text-[#c25e19] transition-colors py-1 relative {{ request()->routeIs('contact') ? 'text-[#c25e19] font-bold after:content-[\'\'] after:absolute after:bottom-0 after:left-0 after:right-0 after:h-[2px] after:bg-[#c25e19]' : '' }}">
                    Contact Us
                </a>
            </nav>

            <!-- Book CTA -->
            <div class="hidden sm:flex items-center gap-3">
                <a href="https://wa.me/9779749382246?text=Namaste%2C%20I%20would%20like%20to%20inquire%20about%20booking%20at%20Sishwar%20Chitwan%20Tiger%20Resort." 
                   target="_blank" 
                   class="p-2.5 rounded-full text-emerald-700 hover:bg-emerald-50 transition border border-emerald-200" 
                   title="Instant WhatsApp Inquiries">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                    </svg>
                </a>
                <a href="{{ route('rooms.index') }}" class="px-5 py-2.5 rounded-xl bg-[#c25e19] hover:bg-[#d96b20] text-white font-semibold text-xs uppercase tracking-wider shadow-sm hover:shadow-md transition-all active:scale-95 flex items-center gap-2">
                    <span>Reserve a Room</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <button type="button" class="lg:hidden p-2 rounded-lg text-stone-700 hover:bg-stone-100" @click="mobileNav = !mobileNav">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileNav" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="mobileNav" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div x-show="mobileNav" x-collapse class="lg:hidden border-t border-[#eae4d8] bg-white px-4 pt-3 pb-6 space-y-3">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-stone-800 hover:bg-[#faf7f2] hover:text-[#c25e19]">Home</a>
            <a href="{{ route('rooms.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-stone-800 hover:bg-[#faf7f2] hover:text-[#c25e19]">Rooms & Suites</a>
            <a href="{{ route('activities.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-stone-800 hover:bg-[#faf7f2] hover:text-[#c25e19]">Safaris & Activities</a>
            <a href="{{ route('gallery.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-stone-800 hover:bg-[#faf7f2] hover:text-[#c25e19]">Gallery</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-stone-800 hover:bg-[#faf7f2] hover:text-[#c25e19]">Contact Us</a>
            <div class="pt-4 border-t border-stone-100 flex flex-col gap-2">
                <a href="{{ route('rooms.index') }}" class="w-full text-center py-3 rounded-xl bg-[#c25e19] text-white text-xs uppercase tracking-wider font-semibold">Reserve Room Now</a>
                <a href="https://wa.me/9779749382246" target="_blank" class="w-full text-center py-3 rounded-xl bg-emerald-700 text-white text-xs uppercase tracking-wider font-semibold">WhatsApp Desk (+977 9749382246)</a>
            </div>
        </div>
    </header>

    <!-- Global Toast Alert (if flashed) -->
    @if(session('success'))
        <div class="max-w-4xl mx-auto mt-4 px-4" x-data="{ show: true }" x-show="show">
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-3">
                    <span class="text-xl">🌿</span>
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
                <button type="button" @click="show = false" class="text-emerald-700 hover:text-emerald-900 text-lg">&times;</button>
            </div>
        </div>
    @endif

    <!-- Main Page Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Floating WhatsApp Action Widget -->
    <a href="https://wa.me/9779749382246?text=Namaste%20Sishwar%20Chitwan%20Tiger%20Resort%20team%2C%20I%20am%20interested%20in%20room%20booking%20and%20safari%20packages."
       target="_blank"
       class="fixed bottom-6 right-6 z-50 bg-emerald-700 hover:bg-emerald-800 text-white p-3.5 rounded-full shadow-lg hover:shadow-2xl hover:scale-105 transition-all flex items-center gap-2 group border border-emerald-500/30"
       title="Quick Chat with Resort Front Desk">
        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
        </svg>
        <span class="max-w-0 overflow-hidden whitespace-nowrap group-hover:max-w-xs transition-all duration-300 text-xs font-semibold uppercase tracking-wider pr-1">Chat on WhatsApp</span>
    </a>

    <!-- Footer -->
    <footer class="bg-[#14281d] text-stone-300 pt-20 pb-14 border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 pb-14 border-b border-white/10">
                <!-- Col 1: About -->
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 rounded-xl bg-[#c25e19] flex items-center justify-center text-white text-lg">🐅</div>
                        <span class="text-xl font-bold font-serif-title text-white">Sishwar Chitwan Tiger Resort</span>
                    </div>
                    <p class="text-stone-400 text-xs sm:text-sm leading-relaxed mb-6 font-normal">
                        Nestled beside the tranquil Narayani River in Devchuli, Nawalparasi. Experience raw jungle safari adventures, authentic Tharu culture, and warm Nepali hospitality.
                    </p>
                    <div class="text-[11px] text-[#f08235] font-semibold tracking-widest uppercase">
                        Serenity by the Narayani & Chitwan Park
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div>
                    <h4 class="text-white font-semibold text-xs uppercase tracking-widest mb-5 border-l-2 border-[#c25e19] pl-3">Navigation</h4>
                    <ul class="space-y-3 text-xs sm:text-sm text-stone-400">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Resort Overview</a></li>
                        <li><a href="{{ route('rooms.index') }}" class="hover:text-white transition">Rooms & Pricing (NPR)</a></li>
                        <li><a href="{{ route('activities.index') }}" class="hover:text-white transition">Jeep Safaris & Boating</a></li>
                        <li><a href="{{ route('gallery.index') }}" class="hover:text-white transition">Photo & Video Gallery</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">Directions & Inquiry</a></li>
                    </ul>
                </div>

                <!-- Col 3: Experiences -->
                <div>
                    <h4 class="text-white font-semibold text-xs uppercase tracking-widest mb-5 border-l-2 border-[#c25e19] pl-3">Safari Experiences</h4>
                    <ul class="space-y-3 text-xs sm:text-sm text-stone-400">
                        <li>🦏 Chitwan Jeep Safari</li>
                        <li>🛶 Narayani River Scenic Boating</li>
                        <li>🦅 Dawn Bird Watching Walks</li>
                        <li>🪘 Tharu Stick Dance & Bonfire</li>
                        <li>🌿 Buffer Zone Nature Trails</li>
                    </ul>
                </div>

                <!-- Col 4: Contact & Location -->
                <div>
                    <h4 class="text-white font-semibold text-xs uppercase tracking-widest mb-5 border-l-2 border-[#c25e19] pl-3">Resort Desk</h4>
                    <div class="space-y-3.5 text-xs sm:text-sm text-stone-400">
                        <p class="flex items-start gap-2.5">
                            <span class="text-[#f08235]">📍</span>
                            <span>Devchuli-17, Piprahar, Nawalparasi (Chitwan Valley), Nepal</span>
                        </p>
                        <p class="flex items-center gap-2.5">
                            <span class="text-[#f08235]">📞</span>
                            <span>078-545455 / 9749382246</span>
                        </p>
                        <p class="flex items-center gap-2.5">
                            <span class="text-[#f08235]">✉️</span>
                            <span>info@chitwantigerresorts.com</span>
                        </p>
                        <div class="pt-2">
                            <a href="{{ route('contact') }}" class="inline-block text-xs font-semibold px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-stone-200 border border-white/10 transition">
                                View Map & Directions →
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="pt-8 flex flex-col sm:flex-row justify-between items-center text-xs text-stone-500 gap-4">
                <p>© 2026 Sishwar Chitwan Tiger Resort (SCTR). All rights reserved.</p>
                <div class="flex items-center space-x-6">
                    <a href="{{ route('rooms.index') }}" class="hover:text-stone-300">Bookings Policy</a>
                    <a href="{{ route('contact') }}" class="hover:text-stone-300">Contact Support</a>
                    <a href="{{ url('/mukhiyadwar') }}" class="hover:text-[#f08235] font-medium">Panel Login</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
