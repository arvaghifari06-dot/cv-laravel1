<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skill';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama_skill',
        'tingkat',
        'nilai',
    ];

    protected function casts(): array
    {
        return [
            'nilai' => 'integer',
        ];
    }
}
