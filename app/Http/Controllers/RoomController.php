<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $rooms = Room::with('roomType')
            ->when($request->search, fn($q, $s) => $q->where('room_number', 'like', "%{$s}%"))
            ->when($request->status, fn($q, $s) => $q->where('status', $s))
            ->when($request->room_type_id, fn($q, $id) => $q->where('room_type_id', $id))
            ->latest()->paginate(10)->withQueryString();
        $roomTypes = RoomType::orderBy('name')->get();
        return view('rooms.index', compact('rooms', 'roomTypes'));
    }

    public function create()
    {
        $roomTypes = RoomType::orderBy('name')->get();
        return view('rooms.create', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'room_number' => ['required', 'string', 'max:20', 'unique:rooms,room_number'],
            'room_type_id' => ['required', 'exists:room_types,id'],
            'floor' => ['required', 'integer', 'min:0'],
            'status' => ['required', Rule::in(['available', 'occupied', 'maintenance'])],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
        ]);
        Room::create($data);
        return redirect()->route('rooms.index')->with('success', 'Room created.');
    }

    public function edit(Room $room)
    {
        $roomTypes = RoomType::orderBy('name')->get();
        return view('rooms.edit', compact('room', 'roomTypes'));
    }

    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'room_number' => ['required', 'string', 'max:20', Rule::unique('rooms')->ignore($room->id)],
            'room_type_id' => ['required', 'exists:room_types,id'],
            'floor' => ['required', 'integer', 'min:0'],
            'status' => ['required', Rule::in(['available', 'occupied', 'maintenance'])],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
        ]);
        $room->update($data);
        return redirect()->route('rooms.index')->with('success', 'Room updated.');
    }

    public function destroy(Room $room)
    {
        if ($room->bookings()->exists()) return back()->with('error', 'This room has booking records and cannot be deleted.');
        $room->delete();
        return back()->with('success', 'Room deleted.');
    }
}
