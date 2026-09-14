    <!-- ============ FOOTER ============ -->
    <footer class="border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-6">

                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-700 to-slate-900 flex items-center justify-center">
                        <i data-lucide="calendar-check" class="w-4 h-4 text-white"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-slate-900 text-sm">RoomBook</p>
                        <p class="text-xs text-slate-400">Discussion Room Booking System</p>
                    </div>
                </div>

                <nav class="flex items-center gap-6 text-sm text-slate-500">
                    <a href="{{ url('/') }}#rooms" class="hover:text-blue-700 transition-colors">Rooms</a>
                    <a href="{{ url('/') }}#schedule" class="hover:text-blue-700 transition-colors">Schedule</a>
                    <a href="{{ url('/') }}#how-it-works" class="hover:text-blue-700 transition-colors">Booking Guide</a>
                </nav>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 text-center text-xs text-slate-400">
                &copy; 2026 RoomBook. All rights reserved.
            </div>
        </div>
    </footer>
