<?php
// NAMA FILE: app/Models/Berita.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'penulis', 'gambar', 'isi', 'kategori_id'];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'kategori_id');
    }
}