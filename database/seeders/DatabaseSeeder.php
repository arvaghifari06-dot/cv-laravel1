<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admin')->updateOrInsert(
            ['username' => 'admin'],
            ['password' => '$2b$12$v3b1ePwR/bFrya2HmpCbR.WSCoIrVpxxIVxZjO3RRUKfoibFOHrrS']
        );

        foreach ([
            ['Desain Grafis', 'MAHIR', 9],
            ['Videografi', 'MAHIR', 9],
            ['Fotografi', 'MENENGAH', 6],
            ['Strategi Konten', 'MAHIR', 9],
            ['Manajemen Media Sosial', 'MAHIR', 8],
        ] as [$nama, $tingkat, $nilai]) {
            DB::table('skill')->updateOrInsert(
                ['nama_skill' => $nama],
                ['tingkat' => $tingkat, 'nilai' => $nilai]
            );
        }
    }
}
