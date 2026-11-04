<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::with(['guest', 'room'])
            ->when($request->search, function ($q, $s) {
                $q->where('booking_code', 'like', "%{$s}%")
                  ->orWhereHas('guest', fn($g) => $g->where('full_name', 'like', "%{$s}%"));
            })
            ->when($request->status, fn($q, $s) => $q->where('status', $s))
            ->latest()->paginate(10)->withQueryString();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $guests = Guest::orderBy('full_name')->get();
        $rooms = Room::where('status', 'available')->with('roomType')->orderBy('room_number')->get();
        return view('bookings.create', compact('guests', 'rooms'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'guest_id' => ['required', 'exists:guests,id'],
            'room_id' => ['required', 'exists:rooms,id'],
            'check_in' => ['required', 'date', 'after_or_equal:today'],
            'check_out' => ['required', 'date', 'after:check_in'],
            'guests_count' => ['required', 'integer', 'min:1'],
            'status' => ['required', Rule::in(['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'])],
            'notes' => ['nullable', 'string'],
        ]);

        $room = Room::findOrFail($data['room_id']);
        if ($room->status !== 'available') return back()->withInput()->withErrors(['room_id' => 'Selected room is not available.']);

        $nights = now()->parse($data['check_in'])->diffInDays(now()->parse($data['check_out']));
        $data['booking_code'] = 'BK-' . strtoupper(Str::random(7));
        $data['user_id'] = $request->user()->id;
        $data['total_amount'] = $nights * $room->price;

        $booking = Booking::create($data);
        if (in_array($booking->status, ['confirmed', 'checked_in'])) $room->update(['status' => 'occupied']);

        return redirect()->route('bookings.index')->with('success', 'Booking created.');
    }

    public function edit(Booking $booking)
    {
        $booking->load(['guest', 'room']);
        $guests = Guest::orderBy('full_name')->get();
        $rooms = Room::with('roomType')->orderBy('room_number')->get();
        return view('bookings.edit', compact('booking', 'guests', 'rooms'));
    }

    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'guest_id' => ['required', 'exists:guests,id'],
            'room_id' => ['required', 'exists:rooms,id'],
            'check_in' => ['required', 'date'],
            'check_out' => ['required', 'date', 'after:check_in'],
            'guests_count' => ['required', 'integer', 'min:1'],
            'status' => ['required', Rule::in(['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'])],
            'notes' => ['nullable', 'string'],
        ]);
        $room = Room::findOrFail($data['room_id']);
        $nights = now()->parse($data['check_in'])->diffInDays(now()->parse($data['check_out']));
        $data['total_amount'] = $nights * $room->price;
        $booking->update($data);
        if (in_array($booking->status, ['checked_out', 'cancelled'])) $room->update(['status' => 'available']);
        elseif (in_array($booking->status, ['confirmed', 'checked_in'])) $room->update(['status' => 'occupied']);
        return redirect()->route('bookings.index')->with('success', 'Booking updated.');
    }

    public function destroy(Booking $booking)
    {
        $room = $booking->room;
        $booking->delete();
        if ($room && !$room->bookings()->whereIn('status', ['confirmed', 'checked_in'])->exists()) {
            $room->update(['status' => 'available']);
        }
        return back()->with('success', 'Booking deleted.');
    }
}
