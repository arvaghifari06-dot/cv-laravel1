@extends('admin.layout')

@php($edit = $skill->exists)

@section('title', $edit ? 'Edit Skill' : 'Tambah Skill')

@section('content')
<div class="frame">
  <span class="tag">{{ $edit ? 'UPDATE' : 'CREATE' }}</span>
  <h1>{{ $edit ? 'EDIT SKILL' : 'TAMBAH SKILL' }}</h1>
  <p class="sub">{{ $edit ? 'ID data: ' . $skill->id : 'Data akan langsung tampil di halaman CV.' }}</p>

  @if ($errors->any())
    <div class="msg bad" role="alert">{{ $errors->first() }}</div>
  @endif

  <form method="POST" action="{{ $edit ? route('admin.skills.update', $skill) : route('admin.skills.store') }}">
    @csrf
    @if ($edit)
      @method('PUT')
    @endif
    <div class="fgroup">
      <label for="nama_skill">NAMA SKILL</label>
      <input type="text" id="nama_skill" name="nama_skill" value="{{ old('nama_skill', $skill->nama_skill) }}">
    </div>
    <div class="fgroup">
      <label for="tingkat">TINGKAT</label>
      <select id="tingkat" name="tingkat">
        @foreach ($daftarTingkat as $t)
          <option value="{{ $t }}" @selected(old('tingkat', $skill->tingkat) === $t)>{{ $t }}</option>
        @endforeach
      </select>
    </div>
    <div class="fgroup">
      <label for="nilai">NILAI (1-12)</label>
      <input type="number" id="nilai" name="nilai" min="1" max="12" value="{{ old('nilai', $skill->nilai) }}">
    </div>
    <button type="submit" class="chip ink">{{ $edit ? 'SIMPAN PERUBAHAN' : 'SIMPAN' }}</button>
    <a class="chip" href="{{ route('admin.dashboard') }}">BATAL</a>
  </form>
</div>
@endsection
