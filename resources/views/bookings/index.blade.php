@extends('layouts.app')
@section('title','Bookings') @section('page-heading','Booking Management')
@section('content')
<div class="page-toolbar"><form class="search-form filters" method="GET"><input name="search" value="{{ request('search') }}" placeholder="Search booking code or guest name..."><select name="status"><option value="">All statuses</option>@foreach(['pending','confirmed','checked_in','checked_out','cancelled'] as $s)<option value="{{ $s }}" @selected(request('status')==$s)>{{ str_replace('_',' ',ucfirst($s)) }}</option>@endforeach</select><button class="btn btn-light">Filter</button></form><a class="btn btn-primary" href="{{ route('bookings.create') }}">+ New Booking</a></div>
<div class="panel"><div class="table-wrap"><table><thead><tr><th>Booking ID</th><th>Guest</th><th>Room</th><th>Stay</th><th>Total</th><th>Status</th><th>Actions</th></tr></thead><tbody>
@forelse($bookings as $booking)<tr><td class="strong">{{ $booking->booking_code }}</td><td>{{ $booking->guest->full_name }}</td><td>{{ $booking->room->room_number }}</td><td>{{ $booking->check_in->format('d M') }} – {{ $booking->check_out->format('d M Y') }}</td><td>${{ number_format($booking->total_amount,2) }}</td><td><span class="status {{ $booking->status }}">{{ str_replace('_',' ',ucfirst($booking->status)) }}</span></td><td class="actions"><a class="action-edit" href="{{ route('bookings.edit',$booking) }}">Edit</a><form method="POST" action="{{ route('bookings.destroy',$booking) }}" onsubmit="return confirm('Delete this booking?')">@csrf @method('DELETE')<button class="action-delete">Delete</button></form></td></tr>
@empty<tr><td colspan="7" class="empty">No bookings found.</td></tr>@endforelse
</tbody></table></div><div class="pagination">{{ $bookings->links() }}</div></div>
@endsection
