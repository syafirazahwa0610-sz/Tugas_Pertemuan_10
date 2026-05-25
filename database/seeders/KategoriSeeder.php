<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::create([
            'nama_kategori' => 'Programming',
            'deskripsi' => 'Kategori buku pemrograman',
            'icon' => 'code-slash',
            'warna' => 'primary'
        ]);

        Kategori::create([
            'nama_kategori' => 'Database',
            'deskripsi' => 'Kategori buku database',
            'icon' => 'database',
            'warna' => 'success'
        ]);

        Kategori::create([
            'nama_kategori' => 'Web Design',
            'deskripsi' => 'Kategori buku desain web',
            'icon' => 'palette',
            'warna' => 'info'
        ]);

        Kategori::create([
            'nama_kategori' => 'Networking',
            'deskripsi' => 'Kategori buku jaringan',
            'icon' => 'wifi',
            'warna' => 'warning'
        ]);

        Kategori::create([
            'nama_kategori' => 'Data Science',
            'deskripsi' => 'Kategori buku data science',
            'icon' => 'graph-up',
            'warna' => 'danger'
        ]);
    }
}