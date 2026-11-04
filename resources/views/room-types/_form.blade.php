<label>Room type name</label><input name="name" value="{{ old('name', $roomType->name ?? '') }}" required>
<label>Base price per night ($)</label><input type="number" step="0.01" min="0" name="base_price" value="{{ old('base_price', $roomType->base_price ?? '') }}" required>
<label>Maximum capacity</label><input type="number" min="1" name="capacity" value="{{ old('capacity', $roomType->capacity ?? 2) }}" required>
<label>Description</label><textarea name="description" rows="3">{{ old('description', $roomType->description ?? '') }}</textarea>
<div class="form-actions"><button class="btn btn-primary">Save Room Type</button><a class="btn btn-light" href="{{ route('room-types.index') }}">Cancel</a></div>
