<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $table = 'pesan_kontak';
    protected $primaryKey = 'id';

    // Kolom tanggal diisi otomatis oleh DEFAULT CURRENT_TIMESTAMP di database
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'subjek',
        'pesan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'datetime',
        ];
    }
}
