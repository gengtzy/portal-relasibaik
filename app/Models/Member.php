<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    // Mengizinkan kolom-kolom ini diisi melalui form
    protected $fillable = [
        'nama',
        'nidn',
        'kampus',
        'foto',
        'jurnals'
    ];

    protected $casts = [
        'jurnals' => 'array'
    ];
}