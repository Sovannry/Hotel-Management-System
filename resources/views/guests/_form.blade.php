<label>Full name</label><input name="full_name" value="{{ old('full_name',$guest->full_name ?? '') }}" required>
<label>Email</label><input type="email" name="email" value="{{ old('email',$guest->email ?? '') }}">
<label>Phone number</label><input name="phone" value="{{ old('phone',$guest->phone ?? '') }}" required>
<label>Gender</label><select name="gender"><option value="">Select gender</option>@foreach(['male','female','other'] as $g)<option value="{{ $g }}" @selected(old('gender',$guest->gender ?? '')==$g)>{{ ucfirst($g) }}</option>@endforeach</select>
<label>Identity number</label><input name="identity_number" value="{{ old('identity_number',$guest->identity_number ?? '') }}">
<label>Address</label><textarea name="address" rows="3">{{ old('address',$guest->address ?? '') }}</textarea>
<div class="form-actions"><button class="btn btn-primary">Save Guest</button><a class="btn btn-light" href="{{ route('guests.index') }}">Cancel</a></div>
