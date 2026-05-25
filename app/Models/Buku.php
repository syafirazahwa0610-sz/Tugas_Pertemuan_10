<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';

    public function getStatusStokBadgeAttribute(): string
    {
        if ($this->stok == 0) {
            return '<span class="badge bg-danger">Habis</span>';
        } elseif ($this->stok >= 1 && $this->stok <= 5) {
            return '<span class="badge bg-warning">Menipis</span>';
        } elseif ($this->stok >= 6 && $this->stok <= 15) {
            return '<span class="badge bg-info">Sedang</span>';
        } else {
            return '<span class="badge bg-success">Aman</span>';
        }
    }

    public function getTahunLabelAttribute(): string
    {
        if ($this->tahun_terbit >= 2024) {
            return 'Buku Baru';
        }

        return 'Buku Lama';
    }

    public function scopeStokMenipis($query)
    {
        return $query->where('stok', '<', 5);
    }

    public function scopeHargaRange($query, $min, $max)
    {
        return $query->whereBetween('harga', [$min, $max]);
    }

    public function scopeTerbaru($query)
    {
        return $query->where('tahun_terbit', '>=', 2024);
    }
}