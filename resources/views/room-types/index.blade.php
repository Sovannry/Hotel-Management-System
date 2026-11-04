@extends('layouts.app')
@section('title','Room Types') @section('page-heading','Room Types')
@section('content')
<div class="page-toolbar"><form class="search-form" method="GET"><input name="search" value="{{ request('search') }}" placeholder="Search room type name..."><button class="btn btn-light">Search</button></form><a class="btn btn-primary" href="{{ route('room-types.create') }}">+ Add Room Type</a></div>
<div class="panel"><div class="table-wrap"><table><thead><tr><th>Name</th><th>Base Price / Night</th><th>Capacity</th><th>Rooms</th><th>Description</th><th>Actions</th></tr></thead><tbody>
@forelse($roomTypes as $type)<tr><td class="strong">{{ $type->name }}</td><td>${{ number_format($type->base_price,2) }}</td><td>{{ $type->capacity }} guests</td><td>{{ $type->rooms_count }}</td><td>{{ Str::limit($type->description,45) }}</td><td class="actions"><a class="action-edit" href="{{ route('room-types.edit',$type) }}">Edit</a><form method="POST" action="{{ route('room-types.destroy',$type) }}" onsubmit="return confirm('Delete this room type?')">@csrf @method('DELETE')<button class="action-delete">Delete</button></form></td></tr>
@empty<tr><td colspan="6" class="empty">No room types found.</td></tr>@endforelse
</tbody></table></div><div class="pagination">{{ $roomTypes->links() }}</div></div>
@endsection
