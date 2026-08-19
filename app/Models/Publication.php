<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    // Mengizinkan kolom-kolom ini diisi melalui form
    protected $fillable = [
        'judul',
        'penulis',
        'deskripsi',
        'link_jurnal'
    ];
}