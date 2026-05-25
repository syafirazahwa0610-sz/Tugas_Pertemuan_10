<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerpustakaanController;
use App\Http\Controllers\KategoriController;
use App\Models\Buku;
use App\Models\Anggota;

/*
|--------------------------------------------------------------------------
| ROUTE UTAMA
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| ROUTE PERPUSTAKAAN (CONTROLLER)
|--------------------------------------------------------------------------
*/

Route::get('/perpustakaan', [PerpustakaanController::class, 'index']);
Route::get('/buku/{id}', [PerpustakaanController::class, 'show']);
Route::get('/about', [PerpustakaanController::class, 'about']);

/*
|--------------------------------------------------------------------------
| DATA ANGGOTA (ARRAY SEMENTARA)
|--------------------------------------------------------------------------
*/

$anggota_list = [
    [
        'id' => 1,
        'kode' => 'AGT-001',
        'nama' => 'Budi Santoso',
        'email' => 'budi@email.com',
        'telepon' => '081234567890',
        'alamat' => 'Jakarta',
        'status' => 'Aktif'
    ],
    [
        'id' => 2,
        'kode' => 'AGT-002',
        'nama' => 'Siti Aminah',
        'email' => 'siti@email.com',
        'telepon' => '081298765432',
        'alamat' => 'Bandung',
        'status' => 'Aktif'
    ],
    [
        'id' => 3,
        'kode' => 'AGT-003',
        'nama' => 'Rudi Hartono',
        'email' => 'rudi@email.com',
        'telepon' => '081234111222',
        'alamat' => 'Surabaya',
        'status' => 'Nonaktif'
    ],
    [
        'id' => 4,
        'kode' => 'AGT-004',
        'nama' => 'Dewi Lestari',
        'email' => 'dewi@email.com',
        'telepon' => '081222333444',
        'alamat' => 'Yogyakarta',
        'status' => 'Aktif'
    ],
    [
        'id' => 5,
        'kode' => 'AGT-005',
        'nama' => 'Ahmad Fauzi',
        'email' => 'ahmad@email.com',
        'telepon' => '081255566677',
        'alamat' => 'Medan',
        'status' => 'Aktif'
    ],
];

/*
|--------------------------------------------------------------------------
| ROUTE ANGGOTA
|--------------------------------------------------------------------------
*/

// LIST ANGGOTA
Route::get('/anggota', function () use ($anggota_list) {
    return view('anggota.index', compact('anggota_list'));
});

// DETAIL ANGGOTA
Route::get('/anggota/{id}', function ($id) use ($anggota_list) {

    $anggota = collect($anggota_list)->firstWhere('id', $id);

    if (!$anggota) {
        abort(404);
    }

    return view('anggota.show', compact('anggota'));
});

/*
|--------------------------------------------------------------------------
| ROUTE KATEGORI (TUGAS 2 MVC)
|--------------------------------------------------------------------------
*/

Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');

Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');

Route::get('/kategori/search/{keyword}', [KategoriController::class, 'search'])->name('kategori.search');

/*
|--------------------------------------------------------------------------
| TEST ACCESSOR & SCOPE
|--------------------------------------------------------------------------
*/

Route::get('/test-accessor-scope', function () {

    $html = '

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="container mt-4">

        <h1 class="text-center mb-4">
            Testing Accessor & Scope
        </h1>

    ';

    /*
    |--------------------------------------------------------------------------
    | SEMUA BUKU
    |--------------------------------------------------------------------------
    */

    $html .= '<h2 class="text-primary mt-4">Semua Buku</h2>';

    $bukus = Buku::all();

    foreach ($bukus as $buku) {

        $html .= "

        <div class='card p-3 mb-3 shadow-sm'>

            <h5>{$buku->judul}</h5>

            <p>
                Status Stok:
                {$buku->status_stok_badge}
            </p>

            <p>
                Tahun:
                <span class='badge bg-dark'>
                    {$buku->tahun_label}
                </span>
            </p>

        </div>

        ";
    }

    /*
    |--------------------------------------------------------------------------
    | BUKU TERBARU
    |--------------------------------------------------------------------------
    */

    $html .= '<h2 class="text-success mt-4">Buku Terbaru</h2>';

    $terbaru = Buku::terbaru()->get();

    foreach ($terbaru as $buku) {

        $html .= "

        <div class='alert alert-success'>

            {$buku->judul} ({$buku->tahun_terbit})

        </div>

        ";
    }

    /*
    |--------------------------------------------------------------------------
    | BUKU STOK MENIPIS
    |--------------------------------------------------------------------------
    */

    $html .= '<h2 class="text-warning mt-4">Buku Stok Menipis</h2>';

    $tipis = Buku::stokMenipis()->get();

    foreach ($tipis as $buku) {

        $html .= "

        <div class='alert alert-warning'>

            {$buku->judul} - Stok: {$buku->stok}

        </div>

        ";
    }

    /*
    |--------------------------------------------------------------------------
    | SEMUA ANGGOTA
    |--------------------------------------------------------------------------
    */

    $html .= '<h2 class="text-info mt-4">Semua Anggota</h2>';

    $anggota = Anggota::all();

    foreach ($anggota as $a) {

        $html .= "

        <div class='card p-3 mb-3 shadow-sm'>

            <h5>{$a->nama}</h5>

            <p>
                Status:
                {$a->status_badge}
            </p>

            <p>
                Kategori Usia:
                <span class='badge bg-info'>
                    {$a->kategori_usia}
                </span>
            </p>

        </div>

        ";
    }

    /*
    |--------------------------------------------------------------------------
    | ANGGOTA TERDAFTAR BULAN INI
    |--------------------------------------------------------------------------
    */

    $html .= '<h2 class="text-danger mt-4">Anggota Terdaftar Bulan Ini</h2>';

    $bulanIni = Anggota::terdaftarBulanIni()->get();

    foreach ($bulanIni as $a) {

        $html .= "

        <div class='alert alert-primary'>

            {$a->nama}

        </div>

        ";
    }

    $html .= '</div>';

    return $html;
});