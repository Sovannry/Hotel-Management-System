<label>Room number</label><input name="room_number" value="{{ old('room_number',$room->room_number ?? '') }}" required>
<label>Room type</label><select name="room_type_id" required><option value="">Choose room type</option>@foreach($roomTypes as $type)<option value="{{ $type->id }}" @selected(old('room_type_id',$room->room_type_id ?? '')==$type->id)>{{ $type->name }}</option>@endforeach</select>
<label>Floor</label><input type="number" min="0" name="floor" value="{{ old('floor',$room->floor ?? 1) }}" required>
<label>Price per night ($)</label><input type="number" step="0.01" min="0" name="price" value="{{ old('price',$room->price ?? '') }}" required>
<label>Status</label><select name="status" required>@foreach(['available','occupied','maintenance'] as $s)<option value="{{ $s }}" @selected(old('status',$room->status ?? 'available')==$s)>{{ ucfirst($s) }}</option>@endforeach</select>
<label>Description</label><textarea name="description" rows="3">{{ old('description',$room->description ?? '') }}</textarea>
<div class="form-actions"><button class="btn btn-primary">Save Room</button><a class="btn btn-light" href="{{ route('rooms.index') }}">Cancel</a></div>
