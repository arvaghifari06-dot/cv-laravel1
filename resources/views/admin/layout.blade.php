<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'Admin') — Admin CV</title>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Archivo:wght@400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
</head>
<body>
<header class="bar-top">
  <span>ADMIN / {{ strtoupper(session('admin_username', '')) }}</span>
  <nav class="topnav">
    <a href="{{ route('admin.dashboard') }}">DASHBOARD</a>
    <a href="{{ route('admin.messages.index') }}">PESAN</a>
    <a href="{{ route('home') }}" target="_blank">LIHAT CV</a>
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit" class="linkbtn">LOGOUT</button>
    </form>
  </nav>
</header>
<div class="adm">
@yield('content')
</div>
</body>
</html>
