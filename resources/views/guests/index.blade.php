@extends('layouts.app')
@section('title','Guests') @section('page-heading','Guest Management')
@section('content')
<div class="page-toolbar"><form class="search-form" method="GET"><input name="search" value="{{ request('search') }}" placeholder="Search guest name, email or phone..."><button class="btn btn-light">Search</button></form><a class="btn btn-primary" href="{{ route('guests.create') }}">+ Add Guest</a></div>
<div class="panel"><div class="table-wrap"><table><thead><tr><th>Guest Name</th><th>Email</th><th>Phone</th><th>Gender</th><th>Bookings</th><th>Actions</th></tr></thead><tbody>
@forelse($guests as $guest)<tr><td class="strong">{{ $guest->full_name }}</td><td>{{ $guest->email ?? '—' }}</td><td>{{ $guest->phone }}</td><td>{{ $guest->gender ? ucfirst($guest->gender) : '—' }}</td><td>{{ $guest->bookings_count }}</td><td class="actions"><a class="action-edit" href="{{ route('guests.edit',$guest) }}">Edit</a><form method="POST" action="{{ route('guests.destroy',$guest) }}" onsubmit="return confirm('Delete this guest?')">@csrf @method('DELETE')<button class="action-delete">Delete</button></form></td></tr>
@empty<tr><td colspan="6" class="empty">No guests found.</td></tr>@endforelse
</tbody></table></div><div class="pagination">{{ $guests->links() }}</div></div>
@endsection
