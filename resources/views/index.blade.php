<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $profil['nama'] }} — CV</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Archivo:wght@400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>

<header class="bar-top">
  <span>CV / {{ strtoupper($profil['nama']) }}</span>
  <nav class="topnav">
    <a href="#profil">PROFIL</a>
    <a href="#jejak">REKAM JEJAK</a>
    <a href="#keahlian">KEAHLIAN</a>
    <a href="#proyek">PROJECT</a>
    <a href="#kontak">KONTAK</a>
    <a href="{{ route('admin.login') }}">ADMIN</a>
  </nav>
</header>

<main class="deck">

  <!-- 1. HOME -->
  <section class="slide" id="atas" aria-label="Judul">
    <div class="frame">
      <span class="tag">01 — KEPALA</span>
      <div class="hero">
        <div>
          <p class="eyebrow">{{ $profil['peran'] }}</p>
          <h1 class="name"><span>{{ $profil['namaDepan'] }}</span><span class="b">{{ $profil['namaBelakang'] }}</span></h1>
          <p class="lede">{{ $profil['tagline'] }} — <b>{{ $profil['taglineLanjut'] }}</b>, dieksekusi lewat desain, foto, dan video.</p>
          <h2 class="mono-note">Halo, saya {{ $profil['nama'] }}</h2>
          <div class="herometa">
            <a class="chip ink" href="mailto:{{ $profil['email'] }}">EMAIL</a>
            <a class="chip fill" href="tel:{{ $profil['teleponLink'] }}">TELEPON</a>
            <a class="chip" href="https://instagram.com/{{ $profil['instagram'] }}" target="_blank" rel="noopener">{{ '@' . strtoupper($profil['instagram']) }}</a>
            <span class="chip">{{ strtoupper($profil['kota']) }}</span>
          </div>
        </div>
        <div class="portrait">
          <img src="{{ asset('assets/image/profile.jpg') }}" alt="Foto {{ $profil['nama'] }}">
          <span class="monogram">MA</span>
        </div>
      </div>
      <div class="cut">GUNTING DI SINI</div>
    </div>
  </section>

  <!-- 2. ABOUT ME -->
  <section class="slide" id="profil" aria-label="Tentang saya">
    <div class="frame">
      <span class="tag">02 — PROFIL</span>
      <div class="two">
        <div class="col">
          <h2 class="head">OBJEKTIF KARIER</h2>
          <p>{{ $profil['deskripsi'] }}</p>
          <p>{{ $profil['deskripsi2'] }}</p>

          <div class="rule"></div>
          <div class="info">
            <div class="crow"><span>NIM</span><span>{{ $profil['nim'] }}</span></div>
            <div class="crow"><span>PRODI</span><span>{{ $profil['prodi'] }}</span></div>
            <div class="crow"><span>STATUS</span>
              <span>
                @if ($profil['status'])
                  <span class="chip fill sm">Mahasiswa Aktif</span>
                @else
                  <span class="chip sm">Bukan Mahasiswa Aktif</span>
                @endif
              </span>
            </div>
          </div>
        </div>
        <div class="col">
          <h2 class="head">CARA KERJA</h2>
          <div class="tags">
            <span class="chip">#KREATIF</span>
            <span class="chip fill">#TERORGANISIR</span>
            <span class="chip">#KOLABORATIF</span>
          </div>
          <p>Suka merapikan ide jadi rencana konten yang jelas, lalu menjalankannya sampai tuntas bareng tim.</p>
          <div class="rule"></div>
          <p class="mono-note">Riset audiens → konsep → produksi → evaluasi</p>

          <div class="rule"></div>
          <form class="sapa" action="{{ route('home') }}#profil" method="GET">
            <label for="nama" class="mono-note">SIAPA NAMAMU?</label>
            <div class="row">
              <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda" value="{{ $namaPengunjung }}">
              @include('partials.hidden-query', ['except' => ['nama']])
              <button type="submit" class="chip ink">KIRIM</button>
            </div>
          </form>
          @if ($namaPengunjung !== '')
            <p class="notice ok">Halo, {{ $namaPengunjung }}! Selamat datang di portfolio saya.</p>
          @endif
        </div>
      </div>
    </div>
  </section>

  <!-- 3. EDUCATION + EXPERIENCE -->
  <section class="slide" id="jejak" aria-label="Pendidikan dan pengalaman">
    <div class="frame">
      <span class="tag">03 — REKAM JEJAK</span>
      <div class="two even">
        <div class="col">
          <h3>Pendidikan</h3>
          @foreach ($pendidikan as $p)
            <div class="item">
              <div class="when">{{ $p['waktu'] }}</div>
              <div class="what">{{ $p['judul'] }}</div>
              @if ($p['tempat'] !== '')<div class="where">{{ $p['tempat'] }}</div>@endif
            </div>
          @endforeach

          <h3 class="mt">Kursus &amp; Sertifikasi</h3>
          @foreach ($kursus as $k)
            <div class="item">
              <div class="when">{{ $k['waktu'] }}</div>
              <div class="what">{{ $k['judul'] }}</div>
              @if ($k['tempat'] !== '')<div class="where">{{ $k['tempat'] }}</div>@endif
            </div>
          @endforeach
        </div>
        <div class="col">
          <h3>Pengalaman</h3>
          @foreach ($pengalaman as $x)
            <div class="item">
              <div class="when">{{ $x['waktu'] }}</div>
              <div class="what">{{ $x['judul'] }}</div>
              @if ($x['tempat'] !== '')<div class="where">{{ $x['tempat'] }}</div>@endif
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <!-- 4. SKILLS -->
  <section class="slide" id="keahlian" aria-label="Keahlian">
    <div class="frame">
      <span class="tag">04 — KEAHLIAN</span>
      <h2 class="head">KEAHLIAN</h2>
      <div class="skills">
        @forelse ($skills as $skill)
          <div class="skill">
            <div class="top"><span class="nm">{{ $skill->nama_skill }}</span><span class="lv">{{ $skill->tingkat }}</span></div>
            <div class="bar {{ $loop->index % 2 === 1 ? 'red' : '' }}">
              @for ($i = 1; $i <= 12; $i++)
                <i @class(['on' => $i <= (int) $skill->nilai])></i>
              @endfor
            </div>
          </div>
        @empty
          <p class="mono-note">Belum ada data keahlian.</p>
        @endforelse
      </div>
      <div class="rule mt2"></div>
      <p class="mono-note">Alat harian: {{ implode(' · ', $alatHarian) }}</p>
    </div>
  </section>

  <!-- 5. PROJECTS -->
  <section class="slide" id="proyek" aria-label="Project">
    <div class="frame">
      <span class="tag">05 — PROJECT</span>
      <h2 class="head">PROJECT</h2>

      <form class="toolbar" action="{{ route('home') }}#proyek" method="GET">
        <div class="field">
          <label for="q">CARI JUDUL</label>
          <input type="text" id="q" name="q" placeholder="Ketik judul project…" value="{{ $kataCari }}">
        </div>
        <div class="field">
          <label for="kategori">KATEGORI</label>
          <select id="kategori" name="kategori">
            <option value="semua">Semua kategori</option>
            @foreach ($daftarKategori as $kat)
              <option value="{{ $kat }}" @selected($kategoriDipilih === $kat)>{{ $kat }}</option>
            @endforeach
          </select>
        </div>
        <div class="field">
          <label for="urut">URUTKAN TAHUN</label>
          <select id="urut" name="urut">
            <option value="terbaru" @selected($urut === 'terbaru')>Terbaru → Terlama</option>
            <option value="terlama" @selected($urut === 'terlama')>Terlama → Terbaru</option>
          </select>
        </div>
        @include('partials.hidden-query', ['except' => ['q', 'kategori', 'urut']])
        <div class="field btns">
          <button type="submit" class="chip ink">TERAPKAN</button>
          <a class="chip" href="{{ route('home') }}#proyek">RESET</a>
        </div>
      </form>

      <p class="mono-note">Menampilkan {{ count($hasil) }} dari {{ count($proyek) }} project</p>

      @if (count($hasil) > 0)
        <div class="projects">
          @foreach ($hasil as $p)
            <article class="proj">
              <div class="pmeta">
                <span class="chip fill sm">{{ $p['kategori'] }}</span>
                <span class="when">{{ $p['tahun'] }}</span>
              </div>
              <h3>{{ $p['judul'] }}</h3>
              <p>{{ $p['deskripsi'] }}</p>
            </article>
          @endforeach
        </div>
      @else
        <div class="empty">
          <strong>Project tidak ditemukan.</strong>
          <p>Tidak ada project yang cocok
            @if ($kataCari !== '')dengan kata kunci “{{ $kataCari }}”@endif
            @if ($kategoriDipilih !== 'semua')pada kategori {{ $kategoriDipilih }}@endif.
            Coba ubah filter atau <a href="{{ route('home') }}#proyek">reset pencarian</a>.</p>
        </div>
      @endif
    </div>
  </section>

  <!-- 6. CONTACT -->
  <section class="slide" id="kontak" aria-label="Kontak">
    <div class="frame">
      <span class="tag">06 — KONTAK</span>
      <h2 class="close-h">YUK KOLABORASI<br><em>BARENG.</em></h2>
      <p>Terbuka untuk kerja sama seputar konten, produksi video &amp; foto, atau strategi media sosial.</p>
      <div class="herometa">
        <a class="chip ink" href="https://wa.me/{{ ltrim($profil['teleponLink'], '+') }}" target="_blank" rel="noopener">CHAT WHATSAPP</a>
        <a class="chip" href="https://instagram.com/{{ $profil['instagram'] }}" target="_blank" rel="noopener">INSTAGRAM</a>
        <a class="chip fill" href="#atas">KEMBALI KE ATAS</a>
      </div>

      <div class="two even mt">
        <div class="col">
          <h3>Kirim Pesan</h3>

          @if (session('contact_success'))
            <div class="notice ok" role="status">
              <strong>Pesan terkirim!</strong><br>
              {{ session('contact_success') }}
            </div>
          @elseif ($errors->has('db'))
            <div class="notice bad" role="alert">{{ $errors->first('db') }}</div>
          @elseif ($errors->any())
            <div class="notice bad" role="alert"><strong>Data belum lengkap.</strong> Periksa kembali isian yang ditandai.</div>
          @endif

          <form class="cform" action="{{ route('pesan.store') }}#kontak" method="POST" novalidate>
            @csrf
            <div class="field {{ $errors->has('nama') ? 'has-err' : '' }}">
              <label for="c-nama">NAMA</label>
              <input type="text" id="c-nama" name="nama" value="{{ old('nama') }}">
              @error('nama')<span class="err">{{ $message }}</span>@enderror
            </div>
            <div class="field {{ $errors->has('email') ? 'has-err' : '' }}">
              <label for="c-email">EMAIL</label>
              <input type="email" id="c-email" name="email" value="{{ old('email') }}">
              @error('email')<span class="err">{{ $message }}</span>@enderror
            </div>
            <div class="field {{ $errors->has('subjek') ? 'has-err' : '' }}">
              <label for="c-subjek">SUBJEK</label>
              <input type="text" id="c-subjek" name="subjek" value="{{ old('subjek') }}">
              @error('subjek')<span class="err">{{ $message }}</span>@enderror
            </div>
            <div class="field {{ $errors->has('pesan') ? 'has-err' : '' }}">
              <label for="c-pesan">PESAN</label>
              <textarea id="c-pesan" name="pesan" rows="5">{{ old('pesan') }}</textarea>
              @error('pesan')<span class="err">{{ $message }}</span>@enderror
            </div>
            <button type="submit" name="kirim" value="1" class="chip ink">KIRIM PESAN</button>
          </form>
        </div>

        <div class="col">
          <h3>Info Kontak</h3>
          <div class="contact" style="margin-top:0">
            <div class="crow"><span>EMAIL</span><a href="mailto:{{ $profil['email'] }}">{{ $profil['email'] }}</a></div>
            <div class="crow"><span>TELEPON</span><a href="tel:{{ $profil['teleponLink'] }}">{{ $profil['telepon'] }}</a></div>
            <div class="crow"><span>INSTAGRAM</span><a href="https://instagram.com/{{ $profil['instagram'] }}" target="_blank" rel="noopener">{{ '@' . $profil['instagram'] }}</a></div>
            <div class="crow"><span>ALAMAT</span><span>{{ $profil['alamat'] }}</span></div>
          </div>
        </div>
      </div>

      <p class="footnote">{{ strtoupper($profil['nama']) }} — CV. BY XXD996.</p>
    </div>
  </section>

</main>

</body>
</html>
