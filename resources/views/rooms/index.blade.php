<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Rooms</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <div class="max-w-6xl mx-auto px-6 py-10">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Rooms
                </h1>

                <p class="text-gray-500 mt-1">
                    Manage discussion rooms and meeting rooms.
                </p>
            </div>

            <a href="{{ route('rooms.add') }}"
               class="bg-blue-600 text-white px-5 py-2.5 rounded-lg hover:bg-blue-700">
                Add Room
            </a>
        </div>


        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif


        {{-- Rooms Table --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="text-left px-6 py-4">#</th>
                        <th class="text-left px-6 py-4">Room</th>
                        <th class="text-left px-6 py-4">Location</th>
                        <th class="text-left px-6 py-4">Capacity</th>
                        <th class="text-left px-6 py-4">Facilities</th>
                        <th class="text-left px-6 py-4">Status</th>
                        <th class="text-right px-6 py-4">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @forelse ($rooms as $room)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $room->name }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $room->location ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $room->capacity }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $room->facilities ?? '-' }}
                            </td>

                            <td class="px-6 py-4">

                                @if ($room->is_active)
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                        Active
                                    </span>
                                @else
                                    <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm">
                                        Inactive
                                    </span>
                                @endif

                            </td>

                            <td class="px-6 py-4 text-right">

                                <a href="{{ route('rooms.edit', $room->id) }}"
                                   class="text-blue-600 hover:underline mr-4">
                                    Edit
                                </a>

                                <form action="{{ route('rooms.destroy', $room->id) }}"
                                      method="POST"
                                      class="inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="text-red-600 hover:underline"
                                            onclick="return confirm('Delete this room?')">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7"
                                class="px-6 py-12 text-center text-gray-500">

                                No rooms available.

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</body>
</html>
