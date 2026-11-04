<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Register | GrandStay</title>@vite('resources/css/hotel.css')</head>
<body class="auth-page"><div class="auth-card"><a class="brand auth-brand" href="/"><span class="brand-mark">G</span><span>GrandStay<small>HOTEL MANAGEMENT</small></span></a><p class="eyebrow">GET STARTED</p><h1>Create an account</h1><p class="muted">Register to access the hotel dashboard.</p>
<form method="POST" action="{{ route('register.store') }}">@csrf
<label>Full name</label><input name="name" value="{{ old('name') }}" placeholder="Your name" required>
<label>Email address</label><input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
<label>Password</label><input type="password" name="password" placeholder="At least 8 characters" required>
<label>Confirm password</label><input type="password" name="password_confirmation" placeholder="Repeat password" required>
@if($errors->any())<div class="form-error">{{ $errors->first() }}</div>@endif
<button class="btn btn-primary full" type="submit">Create Account</button></form><p class="auth-switch">Already registered? <a href="{{ route('login') }}">Sign in</a></p></div></body></html>
