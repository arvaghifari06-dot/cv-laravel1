@extends('admin.layout')

@section('title', 'Pesan Masuk')

@section('content')
<div class="frame">
  <span class="tag">PESAN KONTAK</span>
  <h1>PESAN MASUK</h1>
  <p class="sub">Total: {{ $pesan->count() }} pesan</p>

  <div class="adm-actions">
    <a class="chip" href="{{ route('admin.dashboard') }}">← KEMBALI KE DASHBOARD</a>
  </div>

  @forelse ($pesan as $item)
    <div class="pesan-item">
      <div class="meta">{{ $item->tanggal }}</div>
      <strong>{{ $item->nama }}</strong> ({{ $item->email }})
      @if ($item->subjek !== '')<br><em>Subjek: {{ $item->subjek }}</em>@endif
      <p>{!! nl2br(e($item->pesan)) !!}</p>
    </div>
  @empty
    <div class="msg">Belum ada pesan masuk.</div>
  @endforelse
</div>
@endsection
