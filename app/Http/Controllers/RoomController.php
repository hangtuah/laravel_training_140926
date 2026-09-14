<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();

        return view('rooms.index', compact('rooms'));
    }

    public function add()
    {
        return view('rooms.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'capacity' => 'required|integer|min:1',
            'facilities' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $room = new Room();

        $room->name = $request->name;
        $room->location = $request->location;
        $room->capacity = $request->capacity;
        $room->facilities = $request->facilities;
        $room->is_active = $request->is_active;

        $room->save();

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Room added successfully.');
    }

    public function edit($room_id)
    {
        $room = Room::findOrFail($room_id);

        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, $room_id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'capacity' => 'required|integer|min:1',
            'facilities' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $room = Room::findOrFail($room_id);

        $room->name = $request->name;
        $room->location = $request->location;
        $room->capacity = $request->capacity;
        $room->facilities = $request->facilities;
        $room->is_active = $request->is_active;

        $room->save();

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Room updated successfully.');
    }

    public function destroy($room_id)
    {
        $room = Room::findOrFail($room_id);

        $room->delete();

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Room deleted successfully.');
    }
}
