@extends('layouts.app')

@section('title', 'Add Room - RoomBook')
@section('body-class', 'bg-slate-50 text-slate-800 antialiased')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">

        {{-- Page Header --}}
        <a href="{{ route('rooms.index') }}"
           class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-500 hover:text-blue-700 transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Back to Rooms
        </a>

        <div class="mt-5 mb-8">
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Add Room</h1>
            <p class="mt-2 text-slate-500">Register a new discussion or meeting room for booking.</p>
        </div>

        {{-- Form Card --}}
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 sm:p-8">
            <form action="{{ route('rooms.store') }}"
                  method="POST"
                  x-data="{ submitting: false }"
                  @submit="submitting = true"
                  @pageshow.window="submitting = false">
                @csrf

                @include('rooms._form', ['room' => null, 'submitLabel' => 'Save Room'])
            </form>
        </div>

    </div>
@endsection
