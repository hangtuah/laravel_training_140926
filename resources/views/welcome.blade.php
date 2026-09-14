@extends('layouts.app')

@section('content')
    <!-- ============ HERO SECTION ============ -->
    <section id="home" class="relative overflow-hidden bg-gradient-to-b from-slate-50 to-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16 lg:py-24 grid lg:grid-cols-2 gap-14 items-center">

            <!-- Left -->
            <div class="fade-in">
                <span class="inline-flex items-center gap-2 text-xs font-semibold text-blue-700 bg-blue-50 px-3 py-1.5 rounded-full">
                    <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                    Campus Room Booking Made Simple
                </span>

                <h1 class="mt-5 text-4xl sm:text-5xl font-bold text-slate-900 leading-tight tracking-tight">
                    Find a Room.<br>
                    <span class="text-blue-700">Book Your Space.</span>
                </h1>

                <p class="mt-5 text-slate-500 text-base sm:text-lg leading-relaxed max-w-lg">
                    Search discussion rooms and meeting spaces across the building, check real-time availability, and secure your slot in seconds.
                </p>

                <div class="mt-8 flex flex-wrap items-center gap-4">
                    <a href="#availability"
                       class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-medium px-6 py-3.5 rounded-lg transition-colors shadow-sm">
                        <i data-lucide="calendar-plus" class="w-4.5 h-4.5"></i>
                        Book a Room
                    </a>
                    <a href="#schedule"
                       class="inline-flex items-center gap-2 text-slate-700 hover:text-blue-700 font-medium px-6 py-3.5 rounded-lg border border-slate-200 hover:border-blue-200 transition-colors">
                        <i data-lucide="calendar-days" class="w-4.5 h-4.5"></i>
                        View Schedule
                    </a>
                </div>

                <div class="mt-10 flex items-center gap-8 text-slate-400 text-sm">
                    <div class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-blue-600"></i>
                        Real-time availability
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-blue-600"></i>
                        Instant confirmation
                    </div>
                </div>
            </div>

            <!-- Right: UI Mockup -->
            <div class="relative fade-in">
                <div class="absolute -top-6 -right-6 w-40 h-40 bg-blue-100 rounded-full blur-3xl opacity-60"></div>
                <div class="absolute -bottom-8 -left-8 w-40 h-40 bg-indigo-100 rounded-full blur-3xl opacity-50"></div>

                <div class="relative bg-white border border-slate-100 rounded-2xl shadow-xl p-6 max-w-sm mx-auto">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-slate-900">Discussion Room 02</p>
                            <p class="text-xs text-slate-400 mt-0.5">Level 2 &middot; Capacity 8</p>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                            <i data-lucide="door-open" class="w-5 h-5 text-blue-700"></i>
                        </div>
                    </div>

                    <div class="mt-5 pt-5 border-t border-slate-100">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-3">Today</p>

                        <div class="space-y-2.5">
                            <div class="flex items-center justify-between bg-slate-50 rounded-lg px-3.5 py-2.5">
                                <span class="text-sm text-slate-500">10:00 AM - 12:00 PM</span>
                                <span class="text-xs font-medium text-rose-600 bg-rose-50 px-2.5 py-1 rounded-full">Booked</span>
                            </div>
                            <div class="flex items-center justify-between bg-slate-50 rounded-lg px-3.5 py-2.5">
                                <span class="text-sm text-slate-700">12:00 PM - 02:00 PM</span>
                                <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">Available</span>
                            </div>
                            <div class="flex items-center justify-between bg-slate-50 rounded-lg px-3.5 py-2.5">
                                <span class="text-sm text-slate-700">02:00 PM - 04:00 PM</span>
                                <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">Available</span>
                            </div>
                        </div>
                    </div>

                    <button class="mt-5 w-full bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium py-3 rounded-lg transition-colors">
                        Reserve This Room
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ QUICK AVAILABILITY / SEARCH ============ -->
    <section id="availability" class="max-w-7xl mx-auto px-6 lg:px-8 -mt-4 lg:-mt-10 relative z-10">
        <div class="bg-white border border-slate-100 rounded-2xl shadow-lg p-6 sm:p-8">
            <div class="flex items-center gap-2 mb-6">
                <i data-lucide="search" class="w-5 h-5 text-blue-700"></i>
                <h2 class="text-lg font-semibold text-slate-900">Check Room Availability</h2>
            </div>

            <form class="grid sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <div class="lg:col-span-1">
                    <label class="block text-xs font-medium text-slate-500 mb-1.5">Date</label>
                    <input type="date"
                           class="w-full border border-slate-200 rounded-lg px-3.5 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition">
                </div>
                <div class="lg:col-span-1">
                    <label class="block text-xs font-medium text-slate-500 mb-1.5">Start Time</label>
                    <input type="time"
                           class="w-full border border-slate-200 rounded-lg px-3.5 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition">
                </div>
                <div class="lg:col-span-1">
                    <label class="block text-xs font-medium text-slate-500 mb-1.5">End Time</label>
                    <input type="time"
                           class="w-full border border-slate-200 rounded-lg px-3.5 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition">
                </div>
                <div class="lg:col-span-1">
                    <label class="block text-xs font-medium text-slate-500 mb-1.5">Participants</label>
                    <input type="number" min="1" placeholder="e.g. 6"
                           class="w-full border border-slate-200 rounded-lg px-3.5 py-2.5 text-sm text-slate-700 placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition">
                </div>
                <div class="lg:col-span-1 flex items-end">
                    <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition-colors">
                        <i data-lucide="search" class="w-4 h-4"></i>
                        Check Availability
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- ============ AVAILABLE ROOMS ============ -->
    <section id="rooms" class="max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-28">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-xs font-semibold text-blue-700 bg-blue-50 px-3 py-1.5 rounded-full">Available Now</span>
            <h2 class="mt-4 text-3xl font-bold text-slate-900">Rooms Ready to Book</h2>
            <p class="mt-3 text-slate-500">Browse discussion rooms and meeting spaces across the building, each equipped for focused, productive sessions.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Room 1 -->
            <div class="group bg-white border border-slate-100 rounded-2xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-start justify-between">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                        <i data-lucide="door-open" class="w-6 h-6 text-blue-700"></i>
                    </div>
                    <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">Available</span>
                </div>
                <h3 class="mt-5 font-semibold text-slate-900 text-lg">Discussion Room 01</h3>
                <p class="text-sm text-slate-400 mt-0.5">Level 1</p>

                <div class="mt-4 flex items-center gap-2 text-sm text-slate-500">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    Capacity 6
                </div>
                <div class="mt-3 flex flex-wrap gap-2">
                    <span class="inline-flex items-center gap-1.5 text-xs text-slate-500 bg-slate-50 px-2.5 py-1.5 rounded-lg">
                        <i data-lucide="presentation" class="w-3.5 h-3.5"></i> Whiteboard
                    </span>
                    <span class="inline-flex items-center gap-1.5 text-xs text-slate-500 bg-slate-50 px-2.5 py-1.5 rounded-lg">
                        <i data-lucide="monitor" class="w-3.5 h-3.5"></i> Display
                    </span>
                </div>
                <a href="#" class="mt-6 inline-flex items-center gap-1.5 text-sm font-medium text-blue-700 group-hover:gap-2.5 transition-all">
                    View Room <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <!-- Room 2 -->
            <div class="group bg-white border border-slate-100 rounded-2xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-start justify-between">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                        <i data-lucide="door-open" class="w-6 h-6 text-blue-700"></i>
                    </div>
                    <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">Available</span>
                </div>
                <h3 class="mt-5 font-semibold text-slate-900 text-lg">Discussion Room 02</h3>
                <p class="text-sm text-slate-400 mt-0.5">Level 2</p>

                <div class="mt-4 flex items-center gap-2 text-sm text-slate-500">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    Capacity 8
                </div>
                <div class="mt-3 flex flex-wrap gap-2">
                    <span class="inline-flex items-center gap-1.5 text-xs text-slate-500 bg-slate-50 px-2.5 py-1.5 rounded-lg">
                        <i data-lucide="tv" class="w-3.5 h-3.5"></i> Smart TV
                    </span>
                    <span class="inline-flex items-center gap-1.5 text-xs text-slate-500 bg-slate-50 px-2.5 py-1.5 rounded-lg">
                        <i data-lucide="presentation" class="w-3.5 h-3.5"></i> Whiteboard
                    </span>
                </div>
                <a href="#" class="mt-6 inline-flex items-center gap-1.5 text-sm font-medium text-blue-700 group-hover:gap-2.5 transition-all">
                    View Room <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <!-- Room 3 -->
            <div class="group bg-white border border-slate-100 rounded-2xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-start justify-between">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                        <i data-lucide="building-2" class="w-6 h-6 text-blue-700"></i>
                    </div>
                    <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">Available</span>
                </div>
                <h3 class="mt-5 font-semibold text-slate-900 text-lg">Meeting Room A</h3>
                <p class="text-sm text-slate-400 mt-0.5">Level 3</p>

                <div class="mt-4 flex items-center gap-2 text-sm text-slate-500">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    Capacity 12
                </div>
                <div class="mt-3 flex flex-wrap gap-2">
                    <span class="inline-flex items-center gap-1.5 text-xs text-slate-500 bg-slate-50 px-2.5 py-1.5 rounded-lg">
                        <i data-lucide="projector" class="w-3.5 h-3.5"></i> Projector
                    </span>
                    <span class="inline-flex items-center gap-1.5 text-xs text-slate-500 bg-slate-50 px-2.5 py-1.5 rounded-lg">
                        <i data-lucide="video" class="w-3.5 h-3.5"></i> Video Conference
                    </span>
                </div>
                <a href="#" class="mt-6 inline-flex items-center gap-1.5 text-sm font-medium text-blue-700 group-hover:gap-2.5 transition-all">
                    View Room <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

        </div>
    </section>

    <!-- ============ SCHEDULE / CALENDAR PREVIEW ============ -->
    <section id="schedule" class="bg-slate-50 border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-28">
            <div class="grid lg:grid-cols-2 gap-12 items-center">

                <div>
                    <span class="text-xs font-semibold text-blue-700 bg-blue-100/60 px-3 py-1.5 rounded-full">Weekly Overview</span>
                    <h2 class="mt-4 text-3xl font-bold text-slate-900">See the Whole Week at a Glance</h2>
                    <p class="mt-3 text-slate-500 leading-relaxed max-w-md">
                        A clear schedule view shows every booking across all rooms, so you can plan around existing sessions and pick the best time slot.
                    </p>
                    <a href="#" class="mt-6 inline-flex items-center gap-2 text-blue-700 font-medium hover:gap-2.5 transition-all">
                        View Full Schedule <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>

                <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-5 overflow-x-auto">
                    <div class="grid grid-cols-5 gap-3 min-w-[480px]">

                        <div class="text-center">
                            <p class="text-xs font-semibold text-slate-400 pb-3 border-b border-slate-100">Mon</p>
                            <div class="mt-3 space-y-2">
                                <div class="bg-blue-50 text-blue-700 text-[11px] font-medium rounded-lg px-2 py-2 text-left">
                                    <p class="font-semibold">10:00</p>
                                    <p class="text-slate-500 font-normal">Discussion Room 01</p>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <p class="text-xs font-semibold text-slate-400 pb-3 border-b border-slate-100">Tue</p>
                            <div class="mt-3 space-y-2">
                                <div class="bg-indigo-50 text-indigo-700 text-[11px] font-medium rounded-lg px-2 py-2 text-left">
                                    <p class="font-semibold">14:00</p>
                                    <p class="text-slate-500 font-normal">Meeting Room A</p>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <p class="text-xs font-semibold text-slate-400 pb-3 border-b border-slate-100">Wed</p>
                            <div class="mt-3 space-y-2">
                                <div class="bg-slate-50 text-slate-300 text-[11px] rounded-lg px-2 py-2">
                                    &mdash;
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <p class="text-xs font-semibold text-slate-400 pb-3 border-b border-slate-100">Thu</p>
                            <div class="mt-3 space-y-2">
                                <div class="bg-blue-50 text-blue-700 text-[11px] font-medium rounded-lg px-2 py-2 text-left">
                                    <p class="font-semibold">09:30</p>
                                    <p class="text-slate-500 font-normal">Discussion Room 02</p>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <p class="text-xs font-semibold text-slate-400 pb-3 border-b border-slate-100">Fri</p>
                            <div class="mt-3 space-y-2">
                                <div class="bg-indigo-50 text-indigo-700 text-[11px] font-medium rounded-lg px-2 py-2 text-left">
                                    <p class="font-semibold">15:00</p>
                                    <p class="text-slate-500 font-normal">Meeting Room A</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ HOW IT WORKS ============ -->
    <section id="how-it-works" class="max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-28">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-xs font-semibold text-blue-700 bg-blue-50 px-3 py-1.5 rounded-full">Simple Process</span>
            <h2 class="mt-4 text-3xl font-bold text-slate-900">How It Works</h2>
        </div>

        <div class="grid sm:grid-cols-3 gap-8">

            <div class="text-center px-4">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-blue-50 flex items-center justify-center relative">
                    <i data-lucide="door-open" class="w-6 h-6 text-blue-700"></i>
                    <span class="absolute -top-2 -right-2 w-6 h-6 bg-blue-700 text-white text-xs font-semibold rounded-full flex items-center justify-center">1</span>
                </div>
                <h3 class="mt-5 font-semibold text-slate-900">Choose a Room</h3>
                <p class="mt-2 text-sm text-slate-500">Browse rooms based on capacity and facilities.</p>
            </div>

            <div class="text-center px-4">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-blue-50 flex items-center justify-center relative">
                    <i data-lucide="calendar-clock" class="w-6 h-6 text-blue-700"></i>
                    <span class="absolute -top-2 -right-2 w-6 h-6 bg-blue-700 text-white text-xs font-semibold rounded-full flex items-center justify-center">2</span>
                </div>
                <h3 class="mt-5 font-semibold text-slate-900">Select Date &amp; Time</h3>
                <p class="mt-2 text-sm text-slate-500">Pick an available slot that suits your schedule.</p>
            </div>

            <div class="text-center px-4">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-blue-50 flex items-center justify-center relative">
                    <i data-lucide="check-circle" class="w-6 h-6 text-blue-700"></i>
                    <span class="absolute -top-2 -right-2 w-6 h-6 bg-blue-700 text-white text-xs font-semibold rounded-full flex items-center justify-center">3</span>
                </div>
                <h3 class="mt-5 font-semibold text-slate-900">Confirm Booking</h3>
                <p class="mt-2 text-sm text-slate-500">Get instant confirmation for your reservation.</p>
            </div>

        </div>
    </section>

    <!-- ============ FEATURE / BENEFIT ============ -->
    <section class="bg-slate-900">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16">
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">

                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                        <i data-lucide="radar" class="w-5 h-5 text-cyan-400"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-medium text-sm">Real-time Availability</h4>
                        <p class="text-slate-400 text-xs mt-1">See open slots instantly.</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                        <i data-lucide="mouse-pointer-click" class="w-5 h-5 text-cyan-400"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-medium text-sm">Easy Booking</h4>
                        <p class="text-slate-400 text-xs mt-1">Reserve a room in a few clicks.</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                        <i data-lucide="calendar-days" class="w-5 h-5 text-cyan-400"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-medium text-sm">Clear Schedule</h4>
                        <p class="text-slate-400 text-xs mt-1">View bookings across the week.</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                        <i data-lucide="info" class="w-5 h-5 text-cyan-400"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-medium text-sm">Room Information</h4>
                        <p class="text-slate-400 text-xs mt-1">Capacity and facilities at a glance.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ============ CALL TO ACTION ============ -->
    <section class="max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-24">
        <div class="bg-gradient-to-br from-blue-700 to-slate-900 rounded-2xl px-6 sm:px-12 py-14 text-center">
            <h2 class="text-2xl sm:text-3xl font-bold text-white max-w-xl mx-auto">
                Need a space for your next discussion?
            </h2>
            <p class="mt-3 text-blue-100 max-w-md mx-auto text-sm sm:text-base">
                Check availability now and secure your room in minutes.
            </p>
            <a href="#availability"
               class="mt-7 inline-flex items-center gap-2 bg-white hover:bg-slate-100 text-blue-700 font-medium px-6 py-3.5 rounded-lg transition-colors">
                <i data-lucide="search" class="w-4.5 h-4.5"></i>
                Find a Room
            </a>
        </div>
    </section>
@endsection
