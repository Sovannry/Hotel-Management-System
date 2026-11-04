@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-heading', 'Dashboard Overview')
@section('content')
<div class="welcome-panel"><div><p class="eyebrow">OVERVIEW</p><h1>Welcome to GrandStay</h1><p>Here is what's happening at your hotel today.</p></div><div class="welcome-icon">✦</div></div>
<div class="stats-grid">
    <div class="stat-card"><div class="stat-top"><span>Total Rooms</span><span class="stat-icon">▣</span></div><strong>{{ $roomCount }}</strong><small>Registered rooms</small></div>
    <div class="stat-card"><div class="stat-top"><span>Available Rooms</span><span class="stat-icon green">✓</span></div><strong>{{ $availableCount }}</strong><small>Ready for guests</small></div>
    <div class="stat-card"><div class="stat-top"><span>Total Guests</span><span class="stat-icon purple">♙</span></div><strong>{{ $guestCount }}</strong><small>Guest records</small></div>
    <div class="stat-card"><div class="stat-top"><span>Total Bookings</span><span class="stat-icon gold">▧</span></div><strong>{{ $bookingCount }}</strong><small>All booking records</small></div>
</div>
<div class="panel"><div class="panel-heading"><div><h3>Recent Bookings</h3><p class="muted">The latest reservations in your system</p></div><a class="btn btn-primary" href="{{ route('bookings.create') }}">+ New Booking</a></div>
<div class="table-wrap"><table><thead><tr><th>Booking ID</th><th>Guest</th><th>Room</th><th>Check In</th><th>Check Out</th><th>Status</th></tr></thead><tbody>
@forelse($recentBookings as $booking)<tr><td class="strong">{{ $booking->booking_code }}</td><td>{{ $booking->guest->full_name }}</td><td>{{ $booking->room->room_number }}</td><td>{{ $booking->check_in->format('d M Y') }}</td><td>{{ $booking->check_out->format('d M Y') }}</td><td><span class="status {{ $booking->status }}">{{ str_replace('_',' ', ucfirst($booking->status)) }}</span></td></tr>
@empty<tr><td colspan="6" class="empty">No bookings yet. Create your first booking.</td></tr>@endforelse
</tbody></table></div></div>
@endsection
