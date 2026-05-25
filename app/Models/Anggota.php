<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';

    public function getStatusBadgeAttribute(): string
    {
        if ($this->status == 'Aktif') {
            return '<span class="badge bg-success">Aktif</span>';
        }

        return '<span class="badge bg-secondary">Nonaktif</span>';
    }

    public function getKategoriUsiaAttribute(): string
    {
        if ($this->umur < 20) {
            return 'Remaja';
        } elseif ($this->umur <= 50) {
            return 'Dewasa';
        }

        return 'Senior';
    }

    public function scopeJenisKelamin($query, $jk)
    {
        return $query->where('jenis_kelamin', $jk);
    }

    public function scopeTerdaftarBulanIni($query)
    {
        return $query->whereMonth('created_at', now()->month)
                     ->whereYear('created_at', now()->year);
    }
}