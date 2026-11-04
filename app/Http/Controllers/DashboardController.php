<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;
use App\Models\RoomType;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'roomCount' => Room::count(),
            'guestCount' => Guest::count(),
            'bookingCount' => Booking::count(),
            'availableCount' => Room::where('status', 'available')->count(),
            'recentBookings' => Booking::with(['guest', 'room'])->latest()->take(6)->get(),
        ]);
    }
}
