    <!-- ============ NAVBAR ============ -->
    <header x-data="{ mobileOpen: false, scrolled: false }"
            x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 10)"
            :class="scrolled ? 'shadow-sm bg-white/95' : 'bg-white/80'"
            class="sticky top-0 z-50 backdrop-blur border-b border-slate-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                <!-- Logo -->
                <a href="{{ url('/') }}#home" class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-700 to-slate-900 flex items-center justify-center">
                        <i data-lucide="calendar-check" class="w-5 h-5 text-white"></i>
                    </div>
                    <div class="leading-tight">
                        <p class="font-semibold text-slate-900 text-[15px]">RoomBook</p>
                        <p class="text-[11px] text-slate-400 -mt-0.5 hidden sm:block">Discussion Room Booking</p>
                    </div>
                </a>

                <!-- Desktop Nav -->
                <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600">
                    <a href="{{ url('/') }}#home" class="hover:text-blue-700 transition-colors">Home</a>
                    <a href="{{ url('/') }}#rooms" class="hover:text-blue-700 transition-colors">Rooms</a>
                    <a href="{{ url('/') }}#schedule" class="hover:text-blue-700 transition-colors">Schedule</a>
                    <a href="{{ url('/') }}#how-it-works" class="hover:text-blue-700 transition-colors">How It Works</a>
                </nav>

                <div class="flex items-center gap-3">
                    <a href="{{ url('/') }}#availability"
                       class="hidden sm:inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition-colors">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i>
                        Book a Room
                    </a>

                    <!-- Mobile Toggle -->
                    <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2 text-slate-600">
                        <i data-lucide="menu" class="w-6 h-6" x-show="!mobileOpen"></i>
                        <i data-lucide="x" class="w-6 h-6" x-show="mobileOpen" x-cloak></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileOpen" x-cloak x-transition class="md:hidden border-t border-slate-100 bg-white">
            <div class="px-6 py-4 flex flex-col gap-4 text-sm font-medium text-slate-600">
                <a href="{{ url('/') }}#home" @click="mobileOpen = false" class="hover:text-blue-700">Home</a>
                <a href="{{ url('/') }}#rooms" @click="mobileOpen = false" class="hover:text-blue-700">Rooms</a>
                <a href="{{ url('/') }}#schedule" @click="mobileOpen = false" class="hover:text-blue-700">Schedule</a>
                <a href="{{ url('/') }}#how-it-works" @click="mobileOpen = false" class="hover:text-blue-700">How It Works</a>
                <a href="{{ url('/') }}#availability" @click="mobileOpen = false"
                   class="inline-flex items-center justify-center gap-2 bg-blue-700 text-white font-medium px-4 py-2.5 rounded-lg">
                    Book a Room
                </a>
            </div>
        </div>
    </header>
