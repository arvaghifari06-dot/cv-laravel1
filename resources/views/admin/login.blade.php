<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login Admin — CV</title>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Archivo:wght@400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
</head>
<body>
<div class="login-box">
  <div class="frame">
    <span class="tag">ADMIN — LOGIN</span>
    <h1 style="font-family:var(--display);color:var(--blue);font-size:44px;margin:22px 0 18px;">MASUK</h1>

    @if ($errors->any())
      <div class="msg bad" role="alert">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.store') }}">
      @csrf
      <div class="fgroup">
        <label for="username">USERNAME</label>
        <input type="text" id="username" name="username" value="{{ old('username') }}" autofocus>
      </div>
      <div class="fgroup">
        <label for="password">PASSWORD</label>
        <input type="password" id="password" name="password">
      </div>
      <button type="submit" class="chip ink">LOGIN</button>
      <a class="chip" href="{{ route('home') }}">KE HALAMAN CV</a>
    </form>
  </div>
</div>
</body>
</html>
