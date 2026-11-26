@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
@php
    $daftarStatus = [
        'tambah' => 'Skill baru berhasil ditambahkan.',
        'edit'   => 'Skill berhasil diperbarui.',
        'hapus'  => 'Skill berhasil dihapus.',
    ];
@endphp
<div class="frame">
  <span class="tag">DASHBOARD</span>
  <h1>DATA KEAHLIAN</h1>
  <p class="sub">Halo, {{ session('admin_username') }} · Pesan masuk: {{ $totalPesan }}</p>

  @if (isset($daftarStatus[session('status', '')]))
    <div class="msg ok" role="status">{{ $daftarStatus[session('status', '')] }}</div>
  @endif

  <div class="adm-actions">
    <a class="chip ink" href="{{ route('admin.skills.create') }}">+ TAMBAH SKILL</a>
    <a class="chip fill" href="{{ route('admin.messages.index') }}">LIHAT PESAN KONTAK</a>
    <a class="chip" href="{{ route('home') }}" target="_blank">LIHAT HALAMAN CV</a>
  </div>

  <div style="overflow-x:auto">
  <table class="tbl">
    <thead>
      <tr><th>NO</th><th>NAMA SKILL</th><th>TINGKAT</th><th>NILAI (1-12)</th><th>AKSI</th></tr>
    </thead>
    <tbody>
      @forelse ($skills as $skill)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $skill->nama_skill }}</td>
          <td>{{ $skill->tingkat }}</td>
          <td>{{ $skill->nilai }}</td>
          <td class="aksi">
            <a class="chip fill sm" href="{{ route('admin.skills.edit', $skill) }}">EDIT</a>
            <form method="POST" action="{{ route('admin.skills.destroy', $skill) }}" onsubmit="return confirm('Hapus skill ini?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="chip danger sm">HAPUS</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="5">Belum ada data skill.</td></tr>
      @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection
