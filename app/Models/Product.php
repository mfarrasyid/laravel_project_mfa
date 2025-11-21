<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',   // jika kamu pakai kategori
        'nama',
        'deskripsi',
        'harga',
        'stok',
        'foto',           // kolom foto
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    public function kategori()
    {
        return $this->belongsTo(\App\Models\Category::class, 'kategori_id');
    }

    // Accessor agar bisa pakai $product->foto_url
    public function getFotoUrlAttribute()
    {
        return $this->foto
            ? Storage::disk('public')->url($this->foto)
            : asset('assets/img/default-product.png'); // fallback
    }

    protected $appends = ['foto_url'];
}
