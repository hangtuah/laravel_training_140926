{{--
    Shared room fields.
    Expects: $room (Room|null), $submitLabel (string)
--}}
@php
    $inputClass = 'w-full border rounded-lg px-3.5 py-2.5 text-sm text-slate-700 placeholder-slate-300 focus:outline-none focus:ring-2 transition';
    $validClass = 'border-slate-200 focus:ring-blue-100 focus:border-blue-400';
    $invalidClass = 'border-rose-300 bg-rose-50/40 focus:ring-rose-100 focus:border-rose-400';

    // old() returns the submitted string ("0"/"1") after a failed validation;
    // otherwise fall back to the room's value, or Active for a new room.
    $selectedStatus = (string) old('is_active', $room ? (int) $room->is_active : 1);
@endphp

@if ($errors->any())
    <div role="alert" class="mb-6 flex items-start gap-3 bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3.5 rounded-xl">
        <i data-lucide="alert-circle" class="w-5 h-5 shrink-0 mt-0.5"></i>
        <p class="text-sm font-medium">Please fix the highlighted fields and try again.</p>
    </div>
@endif

<div class="grid sm:grid-cols-2 gap-5">

    {{-- Name --}}
    <div class="sm:col-span-2">
        <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">
            Room Name <span class="text-rose-500">*</span>
        </label>
        <input type="text"
               id="name"
               name="name"
               value="{{ old('name', $room?->name) }}"
               maxlength="255"
               required
               placeholder="e.g. Discussion Room 02"
               @error('name') aria-invalid="true" aria-describedby="name-error" @enderror
               class="{{ $inputClass }} {{ $errors->has('name') ? $invalidClass : $validClass }}">
        @error('name')
            <p id="name-error" class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Location --}}
    <div>
        <label for="location" class="block text-sm font-medium text-slate-700 mb-1.5">
            Location
        </label>
        <input type="text"
               id="location"
               name="location"
               value="{{ old('location', $room?->location) }}"
               maxlength="255"
               placeholder="e.g. Level 2, Block A"
               @error('location') aria-invalid="true" aria-describedby="location-error" @enderror
               class="{{ $inputClass }} {{ $errors->has('location') ? $invalidClass : $validClass }}">
        @error('location')
            <p id="location-error" class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Capacity --}}
    <div>
        <label for="capacity" class="block text-sm font-medium text-slate-700 mb-1.5">
            Capacity <span class="text-rose-500">*</span>
        </label>
        <input type="number"
               id="capacity"
               name="capacity"
               value="{{ old('capacity', $room?->capacity) }}"
               min="1"
               step="1"
               required
               placeholder="e.g. 8"
               @error('capacity') aria-invalid="true" aria-describedby="capacity-error" @enderror
               class="{{ $inputClass }} {{ $errors->has('capacity') ? $invalidClass : $validClass }}">
        @error('capacity')
            <p id="capacity-error" class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Facilities --}}
    <div class="sm:col-span-2">
        <label for="facilities" class="block text-sm font-medium text-slate-700 mb-1.5">
            Facilities
        </label>
        <textarea id="facilities"
                  name="facilities"
                  rows="4"
                  placeholder="e.g. Whiteboard, TV screen, HDMI cable"
                  aria-describedby="facilities-help @error('facilities') facilities-error @enderror"
                  @error('facilities') aria-invalid="true" @enderror
                  class="{{ $inputClass }} {{ $errors->has('facilities') ? $invalidClass : $validClass }}">{{ old('facilities', $room?->facilities) }}</textarea>
        <p id="facilities-help" class="mt-1.5 text-xs text-slate-400">Optional. List the equipment available in this room.</p>
        @error('facilities')
            <p id="facilities-error" class="mt-1 text-xs text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Status --}}
    <div>
        <label for="is_active" class="block text-sm font-medium text-slate-700 mb-1.5">
            Status <span class="text-rose-500">*</span>
        </label>
        <select id="is_active"
                name="is_active"
                required
                @error('is_active') aria-invalid="true" aria-describedby="is_active-error" @enderror
                class="{{ $inputClass }} bg-white {{ $errors->has('is_active') ? $invalidClass : $validClass }}">
            <option value="1" @selected($selectedStatus === '1')>Active</option>
            <option value="0" @selected($selectedStatus === '0')>Inactive</option>
        </select>
        @error('is_active')
            <p id="is_active-error" class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
        @enderror
    </div>

</div>

{{-- Actions --}}
<div class="mt-8 pt-6 border-t border-slate-100 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
    <a href="{{ route('rooms.index') }}"
       class="inline-flex items-center justify-center text-sm font-medium text-slate-700 px-5 py-2.5 rounded-lg border border-slate-200 hover:bg-slate-50 transition-colors">
        Cancel
    </a>

    <button type="submit"
            :disabled="submitting"
            class="inline-flex items-center justify-center gap-2 bg-blue-700 hover:bg-blue-800 disabled:opacity-60 text-white text-sm font-medium px-5 py-2.5 rounded-lg shadow-sm transition-colors">
        <i data-lucide="save" class="w-4 h-4"></i>
        {{ $submitLabel }}
    </button>
</div>
