<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | GrandStay Hotel</title>
    @vite('resources/css/hotel.css')
</head>
<body>
<div class="app-shell">
    <aside class="sidebar">
        <a class="brand" href="{{ route('dashboard') }}"><span class="brand-mark">G</span><span>GrandStay<small>HOTEL MANAGEMENT</small></span></a>
        <div class="nav-label">MAIN MENU</div>
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">▦ <span>Dashboard</span></a>
        <a class="nav-link {{ request()->routeIs('room-types.*') ? 'active' : '' }}" href="{{ route('room-types.index') }}">▤ <span>Room Types</span></a>
        <a class="nav-link {{ request()->routeIs('rooms.*') ? 'active' : '' }}" href="{{ route('rooms.index') }}">▣ <span>Rooms</span></a>
        <a class="nav-link {{ request()->routeIs('guests.*') ? 'active' : '' }}" href="{{ route('guests.index') }}">♙ <span>Guests</span></a>
        <a class="nav-link {{ request()->routeIs('bookings.*') ? 'active' : '' }}" href="{{ route('bookings.index') }}">▧ <span>Bookings</span></a>
        <div class="sidebar-bottom"><div class="profile-mini"><div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div><div><strong>{{ auth()->user()->name }}</strong><small>Administrator</small></div></div></div>
    </aside>
    <main class="main-area">
        <header class="topbar"><div><span class="eyebrow">HOTEL MANAGEMENT SYSTEM</span><h2>@yield('page-heading', 'Dashboard')</h2></div><div class="top-actions"><span class="welcome">Hello, {{ auth()->user()->name }}</span><form method="POST" action="{{ route('logout') }}">@csrf<button class="btn btn-light" type="submit">Log out</button></form></div></header>
        <section class="content">
            @if(session('success'))<div class="alert success">{{ session('success') }}</div>@endif
            @if(session('error'))<div class="alert error">{{ session('error') }}</div>@endif
            @if($errors->any())<div class="alert error"><strong>Please check the form:</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
            @yield('content')
        </section>
        <footer class="footer">© {{ date('Y') }} GrandStay Hotel Management System</footer>
    </main>
</div>
</body>
</html>
