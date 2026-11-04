<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomTypeController extends Controller
{
    public function index(Request $request)
    {
        $roomTypes = RoomType::withCount('rooms')
            ->when($request->search, fn($q, $s) => $q->where('name', 'like', "%{$s}%"))
            ->latest()->paginate(10)->withQueryString();
        return view('room-types.index', compact('roomTypes'));
    }

    public function create() { return view('room-types.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:room_types,name'],
            'description' => ['nullable', 'string'],
            'base_price' => ['required', 'numeric', 'min:0'],
            'capacity' => ['required', 'integer', 'min:1'],
        ]);
        RoomType::create($data);
        return redirect()->route('room-types.index')->with('success', 'Room type created.');
    }

    public function edit(RoomType $roomType) { return view('room-types.edit', compact('roomType')); }

    public function update(Request $request, RoomType $roomType)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('room_types')->ignore($roomType->id)],
            'description' => ['nullable', 'string'],
            'base_price' => ['required', 'numeric', 'min:0'],
            'capacity' => ['required', 'integer', 'min:1'],
        ]);
        $roomType->update($data);
        return redirect()->route('room-types.index')->with('success', 'Room type updated.');
    }

    public function destroy(RoomType $roomType)
    {
        if ($roomType->rooms()->exists()) {
            return back()->with('error', 'Cannot delete a room type that is assigned to rooms.');
        }
        $roomType->delete();
        return back()->with('success', 'Room type deleted.');
    }
}
