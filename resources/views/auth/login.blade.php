<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Login | GrandStay</title>@vite('resources/css/hotel.css')</head>
<body class="auth-page"><div class="auth-card"><a class="brand auth-brand" href="/"><span class="brand-mark">G</span><span>GrandStay<small>HOTEL MANAGEMENT</small></span></a><p class="eyebrow">WELCOME BACK</p><h1>Sign in to your account</h1><p class="muted">Manage your hotel operations in one place.</p>
<form method="POST" action="{{ route('login.store') }}">@csrf
<label>Email address</label><input type="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required autofocus>
<label>Password</label><input type="password" name="password" placeholder="Enter your password" required>
<label class="check-row"><input type="checkbox" name="remember"> Remember me</label>
@if($errors->any())<div class="form-error">{{ $errors->first() }}</div>@endif
<button class="btn btn-primary full" type="submit">Sign In</button></form><p class="auth-switch">Don't have an account? <a href="{{ route('register') }}">Create account</a></p></div></body></html>
