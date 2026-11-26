<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $proyek = $this->proyek();

        // Kategori unik, terurut (pengganti array_unique + sort)
        $daftarKategori = collect($proyek)->pluck('kategori')->unique()->sort()->values()->all();

        // Parameter GET dibersihkan seperti pada index.php
        $namaPengunjung  = $this->queryString($request, 'nama');
        $kataCari        = $this->queryString($request, 'q');
        $kategoriDipilih = $this->queryString($request, 'kategori', 'semua');
        $urut            = $this->queryString($request, 'urut', 'terbaru');

        if ($kategoriDipilih !== 'semua' && ! in_array($kategoriDipilih, $daftarKategori, true)) {
            $kategoriDipilih = 'semua';
        }
        if (! in_array($urut, ['terbaru', 'terlama'], true)) {
            $urut = 'terbaru';
        }

        // Filter + cari + urutkan (pengganti filterProyek, cariProyek, urutkanProyek)
        $hasil = collect($proyek)
            ->when($kategoriDipilih !== 'semua', fn ($c) => $c->where('kategori', $kategoriDipilih))
            ->when($kataCari !== '', fn ($c) => $c->filter(
                fn ($p) => mb_stripos($p['judul'], $kataCari) !== false
            ))
            ->when(
                $urut === 'terlama',
                fn ($c) => $c->sortBy('tahun'),
                fn ($c) => $c->sortByDesc('tahun')
            )
            ->values()
            ->all();

        return view('index', [
            'profil'          => $this->profil(),
            'alatHarian'      => ['Adobe Photoshop', 'Illustrator', 'Premiere Pro', 'Canva', 'CapCut'],
            'pendidikan'      => $this->pendidikan(),
            'kursus'          => $this->kursus(),
            'pengalaman'      => $this->pengalaman(),
            'skills'          => Skill::orderBy('id')->get(),   // dari database (dikelola lewat admin)
            'proyek'          => $proyek,
            'hasil'           => $hasil,
            'daftarKategori'  => $daftarKategori,
            'kategoriDipilih' => $kategoriDipilih,
            'kataCari'        => $kataCari,
            'urut'            => $urut,
            'namaPengunjung'  => $namaPengunjung,
        ]);
    }

    private function queryString(Request $request, string $key, string $default = ''): string
    {
        $nilai = $request->query($key, $default);

        return is_string($nilai) && trim($nilai) !== '' ? trim($nilai) : $default;
    }

    private function profil(): array
    {
        return [
            'namaDepan'     => 'MUHAMMAD ARVA',
            'namaBelakang'  => 'ALGHIFARI',
            'nama'          => 'Muhammad Arva Alghifari',
            'nim'           => '5325XXXXXX', // TODO: ganti dengan NIM asli
            'prodi'         => 'D4 Teknologi Rekayasa Multimedia',
            'kampus'        => 'Politeknik Elektronika Negeri Surabaya',
            'email'         => 'arvaghifari06@gmail.com',
            'telepon'       => '+62 821-3982-3305',
            'teleponLink'   => '+6282139823305',
            'instagram'     => 'arvaghifar',
            'kota'          => 'Surabaya',
            'alamat'        => 'Jl. Manyar Sabrangan 39, Surabaya',
            'peran'         => 'CONTENT CREATOR',
            'tagline'       => 'Social Media Specialist & Visual Storyteller',
            'taglineLanjut' => 'strategi konten yang matang',
            'deskripsi'     => 'Mahasiswa D4 Teknologi Rekayasa Multimedia yang berjalan di dua sisi konten: merancang strategi media sosial berbasis data, sekaligus turun tangan langsung memproduksi visualnya sendiri.',
            'deskripsi2'    => 'Terbiasa merencanakan, membuat, dan mengevaluasi performa konten digital untuk mendorong engagement dan brand awareness — mulai dari riset audiens, desain grafis, pemotretan, sampai penyuntingan video.',
            'status'        => true,
        ];
    }

    private function pendidikan(): array
    {
        return [
            ['waktu' => '2025 — SEKARANG', 'judul' => 'D4 Teknologi Rekayasa Multimedia', 'tempat' => 'Politeknik Elektronika Negeri Surabaya'],
            ['waktu' => 'LULUS 2025',      'judul' => 'SMK Muhammadiyah 1 Surabaya',      'tempat' => ''],
        ];
    }

    private function kursus(): array
    {
        return [
            ['waktu' => '2023', 'judul' => 'Certified English for Beginner', 'tempat' => ''],
        ];
    }

    private function pengalaman(): array
    {
        return [
            ['waktu' => '2025 — SEKARANG', 'judul' => 'Public Relation and Content Planner', 'tempat' => 'UKM Cinemascope'],
            ['waktu' => '2024 — 2025',     'judul' => 'Content Planning and Editor',         'tempat' => 'Probest School Surabaya'],
        ];
    }

    /* TODO: ganti isi di bawah dengan project aslimu */
    private function proyek(): array
    {
        return [
            ['judul' => 'Rebranding Feed Instagram UKM Cinemascope', 'kategori' => 'Desain Grafis',   'tahun' => 2025, 'deskripsi' => 'Perancangan ulang identitas visual feed Instagram: palet warna, template postingan, dan highlight cover.'],
            ['judul' => 'Video Profil Probest School',               'kategori' => 'Videografi',      'tahun' => 2024, 'deskripsi' => 'Produksi video profil sekolah mulai dari konsep, pengambilan gambar, hingga penyuntingan akhir.'],
            ['judul' => 'Kalender Konten Bulanan',                   'kategori' => 'Strategi Konten', 'tahun' => 2025, 'deskripsi' => 'Penyusunan rencana konten berbasis riset audiens dengan evaluasi performa tiap akhir bulan.'],
            ['judul' => 'Dokumentasi Acara Kampus',                  'kategori' => 'Fotografi',       'tahun' => 2023, 'deskripsi' => 'Dokumentasi foto kegiatan kampus dengan fokus pada momen candid dan detail suasana.'],
            ['judul' => 'Poster Promosi Event Film',                 'kategori' => 'Desain Grafis',   'tahun' => 2024, 'deskripsi' => 'Desain poster dan materi promosi digital untuk pemutaran film komunitas.'],
        ];
    }
}
