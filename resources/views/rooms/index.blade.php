@extends('layouts.app')

@section('title', 'Rooms - RoomBook')
@section('body-class', 'bg-slate-50 text-slate-800 antialiased')

@section('content')
    @php
        $activeCount = $rooms->where('is_active', true)->count();
        $inactiveCount = $rooms->count() - $activeCount;
    @endphp

    <div x-data="{
            deleteOpen: false,
            deleteAction: '',
            deleteName: '',
            deleting: false,
            confirmDelete(action, name) {
                this.deleteAction = action;
                this.deleteName = name;
                this.deleting = false;
                this.deleteOpen = true;
                this.$nextTick(() => this.$refs.cancelDelete.focus());
            },
        }"
         @keydown.escape.window="deleteOpen = false"
         @pageshow.window="deleting = false"
         class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">

        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5 mb-8">
            <div>
                <span class="inline-flex items-center gap-2 text-xs font-semibold text-blue-700 bg-blue-50 px-3 py-1.5 rounded-full">
                    <i data-lucide="door-open" class="w-3.5 h-3.5"></i>
                    Room Management
                </span>

                <h1 class="mt-4 text-3xl font-bold text-slate-900 tracking-tight">Rooms</h1>

                <p class="mt-2 text-slate-500">
                    Manage discussion rooms and meeting rooms available for booking.
                </p>
            </div>

            <a href="{{ route('rooms.add') }}"
               class="inline-flex items-center justify-center gap-2 bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium px-5 py-3 rounded-lg shadow-sm transition-colors">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Add Room
            </a>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div x-data="{ show: true }"
                 x-show="show"
                 x-transition.opacity
                 role="status"
                 class="mb-6 flex items-start gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3.5 rounded-xl">
                <i data-lucide="check-circle-2" class="w-5 h-5 shrink-0 mt-0.5"></i>
                <p class="flex-1 text-sm font-medium">{{ session('success') }}</p>
                <button type="button"
                        @click="show = false"
                        class="p-1 -m-1 rounded-md text-emerald-600 hover:bg-emerald-100 transition-colors"
                        aria-label="Dismiss message">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        @endif

        {{-- Summary --}}
        <div class="grid grid-cols-3 gap-3 sm:gap-4 mb-6">
            <div class="bg-white border border-slate-200 rounded-xl px-4 py-4 sm:px-5">
                <p class="text-xs font-medium text-slate-500">Total Rooms</p>
                <p class="mt-1 text-2xl font-bold text-slate-900">{{ $rooms->count() }}</p>
            </div>
            <div class="bg-white border border-slate-200 rounded-xl px-4 py-4 sm:px-5">
                <p class="text-xs font-medium text-slate-500">Active</p>
                <p class="mt-1 text-2xl font-bold text-emerald-600">{{ $activeCount }}</p>
            </div>
            <div class="bg-white border border-slate-200 rounded-xl px-4 py-4 sm:px-5">
                <p class="text-xs font-medium text-slate-500">Inactive</p>
                <p class="mt-1 text-2xl font-bold text-slate-400">{{ $inactiveCount }}</p>
            </div>
        </div>

        {{-- Rooms Table (rows stack as cards below the md breakpoint) --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead class="hidden md:table-header-group bg-slate-50 border-b border-slate-200">
                    <tr class="text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                        <th scope="col" class="px-6 py-3.5 w-12">#</th>
                        <th scope="col" class="px-6 py-3.5">Room</th>
                        <th scope="col" class="px-6 py-3.5">Location</th>
                        <th scope="col" class="px-6 py-3.5">Capacity</th>
                        <th scope="col" class="px-6 py-3.5">Facilities</th>
                        <th scope="col" class="px-6 py-3.5">Status</th>
                        <th scope="col" class="px-6 py-3.5 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="block md:table-row-group divide-y divide-slate-100">
                    @forelse ($rooms as $room)
                        <tr class="flex flex-wrap gap-y-4 px-5 py-5 md:table-row md:p-0 hover:bg-slate-50/70 transition-colors">

                            <td class="hidden md:table-cell px-6 py-4 align-top text-slate-400">
                                {{ $loop->iteration }}
                            </td>

                            <td class="w-full md:w-auto md:table-cell md:px-6 md:py-4 align-top">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <div class="w-9 h-9 shrink-0 rounded-lg bg-blue-50 flex items-center justify-center">
                                            <i data-lucide="door-open" class="w-5 h-5 text-blue-700"></i>
                                        </div>
                                        <p class="font-semibold text-slate-900 break-words">{{ $room->name }}</p>
                                    </div>

                                    <div class="md:hidden shrink-0">
                                        @include('rooms._status', ['active' => $room->is_active])
                                    </div>
                                </div>
                            </td>

                            <td class="w-1/2 md:w-auto md:table-cell md:px-6 md:py-4 align-top text-slate-600">
                                <span class="md:hidden block text-xs font-medium text-slate-400 mb-1">Location</span>
                                <span class="inline-flex items-start gap-1.5">
                                    <i data-lucide="map-pin" class="w-4 h-4 mt-0.5 shrink-0 text-slate-400"></i>
                                    <span class="break-words">{{ $room->location ?: '-' }}</span>
                                </span>
                            </td>

                            <td class="w-1/2 md:w-auto md:table-cell md:px-6 md:py-4 align-top text-slate-600">
                                <span class="md:hidden block text-xs font-medium text-slate-400 mb-1">Capacity</span>
                                <span class="inline-flex items-center gap-1.5 whitespace-nowrap">
                                    <i data-lucide="users" class="w-4 h-4 text-slate-400"></i>
                                    {{ $room->capacity }} {{ Str::plural('person', $room->capacity) }}
                                </span>
                            </td>

                            <td class="w-full md:w-auto md:table-cell md:px-6 md:py-4 align-top text-slate-600 md:max-w-xs">
                                <span class="md:hidden block text-xs font-medium text-slate-400 mb-1">Facilities</span>
                                <p class="whitespace-pre-line break-words line-clamp-3" title="{{ $room->facilities }}">{{ $room->facilities ?: '-' }}</p>
                            </td>

                            <td class="hidden md:table-cell px-6 py-4 align-top">
                                @include('rooms._status', ['active' => $room->is_active])
                            </td>

                            <td class="w-full md:w-auto md:table-cell md:px-6 md:py-4 align-top">
                                <div class="flex items-center gap-2 md:justify-end">
                                    <a href="{{ route('rooms.edit', $room->id) }}"
                                       class="flex-1 md:flex-none inline-flex items-center justify-center gap-1.5 text-slate-700 hover:text-blue-700 font-medium px-3.5 py-2 rounded-lg border border-slate-200 hover:border-blue-200 hover:bg-blue-50 transition-colors">
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                        Edit
                                    </a>

                                    <button type="button"
                                            data-action="{{ route('rooms.destroy', $room->id) }}"
                                            data-name="{{ $room->name }}"
                                            @click="confirmDelete($el.dataset.action, $el.dataset.name)"
                                            class="flex-1 md:flex-none inline-flex items-center justify-center gap-1.5 text-rose-600 hover:text-rose-700 font-medium px-3.5 py-2 rounded-lg border border-rose-100 hover:border-rose-200 hover:bg-rose-50 transition-colors">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="block md:table-row">
                            <td colspan="7" class="block md:table-cell px-6 py-16 text-center">
                                <div class="mx-auto w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center">
                                    <i data-lucide="door-closed" class="w-7 h-7 text-blue-700"></i>
                                </div>

                                <h2 class="mt-5 text-lg font-semibold text-slate-900">No rooms yet</h2>

                                <p class="mt-1.5 text-slate-500 max-w-sm mx-auto">
                                    Add your first discussion or meeting room so it can be booked.
                                </p>

                                <a href="{{ route('rooms.add') }}"
                                   class="mt-6 inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium px-5 py-3 rounded-lg transition-colors">
                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                    Add Room
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Delete Confirmation Modal --}}
        <div x-show="deleteOpen"
             x-cloak
             class="fixed inset-0 z-[60] flex items-end sm:items-center justify-center p-4"
             role="dialog"
             aria-modal="true"
             aria-labelledby="delete-room-title">

            <div x-show="deleteOpen"
                 x-transition.opacity
                 @click="deleteOpen = false"
                 class="absolute inset-0 bg-slate-900/50"></div>

            <div x-show="deleteOpen"
                 x-transition
                 class="relative w-full max-w-md bg-white rounded-2xl shadow-xl p-6">
                <div class="flex items-start gap-4">
                    <div class="w-11 h-11 shrink-0 rounded-full bg-rose-50 flex items-center justify-center">
                        <i data-lucide="alert-triangle" class="w-5 h-5 text-rose-600"></i>
                    </div>

                    <div class="min-w-0">
                        <h2 id="delete-room-title" class="text-lg font-semibold text-slate-900">Delete room?</h2>
                        <p class="mt-1.5 text-sm text-slate-500">
                            <span class="font-medium text-slate-700 break-words" x-text="deleteName"></span>
                            will be permanently removed. This action cannot be undone.
                        </p>
                    </div>
                </div>

                <form method="POST" :action="deleteAction" @submit="deleting = true"
                      class="mt-6 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
                    @csrf
                    @method('DELETE')

                    <button type="button"
                            x-ref="cancelDelete"
                            @click="deleteOpen = false"
                            class="inline-flex items-center justify-center text-sm font-medium text-slate-700 px-5 py-2.5 rounded-lg border border-slate-200 hover:bg-slate-50 transition-colors">
                        Cancel
                    </button>

                    <button type="submit"
                            :disabled="deleting"
                            class="inline-flex items-center justify-center gap-2 bg-rose-600 hover:bg-rose-700 disabled:opacity-60 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition-colors">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                        Delete Room
                    </button>
                </form>
            </div>
        </div>

    </div>
@endsection
