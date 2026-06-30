<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerpustakaanController;
use App\Http\Controllers\KategoriController;
use App\Models\Anggota;
use App\Models\Buku;
use Illuminate\Support\Facades\DB;

$anggota_list = [
    [
        'id' => 1,
        'kode' => 'AGT-001',
        'nama' => 'Budi Santoso',
        'email' => 'budi@email.com',
        'telepon' => '081234567890',
        'alamat' => 'Jakarta',
        'status' => 'Aktif',
    ],
    [
        'id' => 2,
        'kode' => 'AGT-002',
        'nama' => 'Siti Aminah',
        'email' => 'siti@email.com',
        'telepon' => '082345678901',
        'alamat' => 'Bandung',
        'status' => 'Aktif',
    ],
    [
        'id' => 3,
        'kode' => 'AGT-003',
        'nama' => 'Ahmad Rahman',
        'email' => 'ahmad@email.com',
        'telepon' => '083456789012',
        'alamat' => 'Surabaya',
        'status' => 'Aktif',
    ],
    [
        'id' => 4,
        'kode' => 'AGT-004',
        'nama' => 'Dewi Lestari',
        'email' => 'dewi@email.com',
        'telepon' => '084567890123',
        'alamat' => 'Yogyakarta',
        'status' => 'Nonaktif',
    ],
    [
        'id' => 5,
        'kode' => 'AGT-005',
        'nama' => 'Roni Wijaya',
        'email' => 'roni@email.com',
        'telepon' => '085678901234',
        'alamat' => 'Medan',
        'status' => 'Aktif',
    ],
];

// Home route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ========== TESTING BUKU ==========

// List all buku
Route::get('/buku', function () {
    $bukus = Buku::all();

    $html = '<h1>Daftar Buku</h1>';
    $html .= '<a href="/buku/create">Tambah Buku</a><br /><br />';
    $html .= '<table border="1" cellpadding="10">';
    $html .= '<tr>
                <th>ID</th>
                <th>Kode</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
              </tr>';

    foreach ($bukus as $buku) {
        $html .= '<tr>';
        $html .= '<td>' . $buku->id . '</td>';
        $html .= '<td>' . $buku->kode_buku . '</td>';
        $html .= '<td>' . $buku->judul . '</td>';
        $html .= '<td>' . $buku->kategori . '</td>';
        $html .= '<td>' . $buku->harga_format . '</td>';
        $html .= '<td>' . $buku->stok . '</td>';
        $html .= '<td>
                    <a href="/buku/' . $buku->id . '">Detail</a> | 
                    <a href="/buku/' . $buku->id . '/edit">Edit</a>
                  </td>';
        $html .= '</tr>';
    }

    $html .= '</table>';

    return $html;
});

// Show single buku
Route::get('/buku/{id}', function ($id) {
    $buku = Buku::findOrFail($id);

    $html = '<h1>Detail Buku</h1>';
    $html .= '<a href="/buku">Kembali</a><br /><br />';
    $html .= '<table border="1" cellpadding="10">';
    $html .= '<tr><th>Field</th><th>Value</th></tr>';
    $html .= '<tr><td>ID</td><td>' . $buku->id . '</td></tr>';
    $html .= '<tr><td>Kode Buku</td><td>' . $buku->kode_buku . '</td></tr>';
    $html .= '<tr><td>Judul</td><td>' . $buku->judul . '</td></tr>';
    $html .= '<tr><td>Kategori</td><td>' . $buku->kategori . '</td></tr>';
    $html .= '<tr><td>Pengarang</td><td>' . $buku->pengarang . '</td></tr>';
    $html .= '<tr><td>Penerbit</td><td>' . $buku->penerbit . '</td></tr>';
    $html .= '<tr><td>Tahun</td><td>' . $buku->tahun_terbit . '</td></tr>';
    $html .= '<tr><td>ISBN</td><td>' . $buku->isbn . '</td></tr>';
    $html .= '<tr><td>Harga</td><td>' . $buku->harga_format . '</td></tr>';
    $html .= '<tr><td>Stok</td><td>' . $buku->stok . '</td></tr>';
    $html .= '<tr><td>Tersedia?</td><td>' . ($buku->tersedia ? 'Ya' : 'Tidak') . '</td></tr>';
    $html .= '<tr><td>Created</td><td>' . $buku->created_at . '</td></tr>';
    $html .= '<tr><td>Updated</td><td>' . $buku->updated_at . '</td></tr>';
    $html .= '</table>';

    return $html;
});

// ========== TESTING ANGGOTA ==========

// List all anggota
Route::get('/anggota', function () {
    $anggotas = Anggota::all();

    $html = '<h1>Daftar Anggota</h1>';
    $html .= '<table border="1" cellpadding="10">';
    $html .= '<tr>
                <th>ID</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Umur</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>';

    foreach ($anggotas as $anggota) {
        $html .= '<tr>';
        $html .= '<td>' . $anggota->id . '</td>';
        $html .= '<td>' . $anggota->kode_anggota . '</td>';
        $html .= '<td>' . $anggota->nama . '</td>';
        $html .= '<td>' . $anggota->email . '</td>';
        $html .= '<td>' . $anggota->umur . ' tahun</td>';
        $html .= '<td>' . $anggota->status . '</td>';
        $html .= '<td><a href="/anggota/' . $anggota->id . '">Detail</a></td>';
        $html .= '</tr>';
    }

    $html .= '</table>';

    return $html;
});

// Show single anggota
Route::get('/anggota/{id}', function ($id) {
    $anggota = Anggota::findOrFail($id);

    $html = '<h1>Detail Anggota</h1>';
    $html .= '<a href="/anggota">Kembali</a><br /><br />';
    $html .= '<table border="1" cellpadding="10">';
    $html .= '<tr><th>Field</th><th>Value</th></tr>';
    $html .= '<tr><td>Kode Anggota</td><td>' . $anggota->kode_anggota . '</td></tr>';
    $html .= '<tr><td>Nama</td><td>' . $anggota->nama . '</td></tr>';
    $html .= '<tr><td>Email</td><td>' . $anggota->email . '</td></tr>';
    $html .= '<tr><td>Telepon</td><td>' . $anggota->telepon . '</td></tr>';
    $html .= '<tr><td>Alamat</td><td>' . $anggota->alamat . '</td></tr>';
    $html .= '<tr><td>Tanggal Lahir</td><td>' . $anggota->tanggal_lahir->format('d-m-Y') . '</td></tr>';
    $html .= '<tr><td>Umur</td><td>' . $anggota->umur . ' tahun</td></tr>';
    $html .= '<tr><td>Jenis Kelamin</td><td>' . $anggota->jenis_kelamin . '</td></tr>';
    $html .= '<tr><td>Pekerjaan</td><td>' . $anggota->pekerjaan . '</td></tr>';
    $html .= '<tr><td>Tanggal Daftar</td><td>' . $anggota->tanggal_daftar->format('d-m-Y') . '</td></tr>';
    $html .= '<tr><td>Lama Anggota</td><td>' . $anggota->lama_anggota . ' hari</td></tr>';
    $html .= '<tr><td>Status</td><td>' . $anggota->status . '</td></tr>';
    $html .= '</table>';

    return $html;
});

// Testing Scope & Query
Route::get('/test-query', function () {
    $html = '<h1>Testing Query Eloquent</h1>';

    // Buku tersedia
    $tersedia = Buku::tersedia()->get();
    $html .= '<h3>Buku Tersedia (Stok > 0): ' . $tersedia->count() . '</h3>';
    $html .= '<ul>';
    foreach ($tersedia as $buku) {
        $html .= '<li>' . $buku->judul . ' (Stok: ' . $buku->stok . ')</li>';
    }
    $html .= '</ul>';

    // Buku Programming
    $programming = Buku::kategori('Programming')->get();
    $html .= '<h3>Buku Programming: ' . $programming->count() . '</h3>';
    $html .= '<ul>';
    foreach ($programming as $buku) {
        $html .= '<li>' . $buku->judul . '</li>';
    }
    $html .= '</ul>';

    // Anggota Aktif
    $aktif = Anggota::aktif()->get();
    $html .= '<h3>Anggota Aktif: ' . $aktif->count() . '</h3>';
    $html .= '<ul>';
    foreach ($aktif as $anggota) {
        $html .= '<li>' . $anggota->nama . ' (' . $anggota->email . ')</li>';
    }
    $html .= '</ul>';

    return $html;
});

// Testing Accessor & Scope
Route::get('/test-accessor-scope', function () {
    $html = '<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing Accessor & Scope</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans p-8">
    <div class="max-w-5xl mx-auto space-y-6">
        <h1 class="text-3xl font-bold text-center mb-8 text-indigo-700 border-b-4 border-indigo-200 pb-4">Testing Accessor & Scope</h1>';

    // 1. Buku dengan status_stok_badge
    $html .= '<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">';
    $html .= '<h2 class="text-xl font-semibold mb-4 text-indigo-600 flex items-center"><span class="bg-indigo-100 text-indigo-800 w-8 h-8 rounded-full flex items-center justify-center mr-3">1</span> Buku dengan status_stok_badge</h2>';
    $html .= '<ul class="divide-y divide-gray-100">';
    foreach (Buku::all() as $buku) {
        $html .= '<li class="py-3 flex justify-between items-center">' .
            '<span class="font-medium text-gray-700">' . $buku->judul . '</span>' .
            '<div class="flex items-center gap-3">' . $buku->getStatusStokBadgeAttribute() . ' <span class="text-sm text-gray-500 bg-gray-50 px-2 py-1 rounded">Stok: ' . $buku->stok . '</span></div></li>';
    }
    $html .= '</ul></div>';

    // 2. Buku terbaru (scope)
    $html .= '<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">';
    $html .= '<h2 class="text-xl font-semibold mb-4 text-indigo-600 flex items-center"><span class="bg-indigo-100 text-indigo-800 w-8 h-8 rounded-full flex items-center justify-center mr-3">2</span> Buku terbaru (scope)</h2>';
    $html .= '<ul class="divide-y divide-gray-100">';
    foreach (Buku::terbaru()->get() as $buku) {
        $html .= '<li class="py-3 flex justify-between items-center">' .
            '<span class="font-medium text-gray-700">' . $buku->judul . '</span>' .
            '<div class="flex items-center gap-3"><span class="px-2.5 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">' . $buku->tahun_label . '</span> <span class="text-sm text-gray-500 bg-gray-50 px-2 py-1 rounded">Tahun: ' . $buku->tahun_terbit . '</span></div></li>';
    }
    $html .= '</ul></div>';

    // 3. Buku stok menipis (scope)
    $html .= '<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">';
    $html .= '<h2 class="text-xl font-semibold mb-4 text-indigo-600 flex items-center"><span class="bg-indigo-100 text-indigo-800 w-8 h-8 rounded-full flex items-center justify-center mr-3">3</span> Buku stok menipis (scope)</h2>';
    $html .= '<ul class="divide-y divide-gray-100">';
    foreach (Buku::stokMenipis()->get() as $buku) {
        $html .= '<li class="py-3 flex justify-between items-center">' .
            '<span class="font-medium text-gray-700">' . $buku->judul . '</span>' .
            '<div class="flex items-center gap-3">' . $buku->status_stok_badge . ' <span class="text-sm text-gray-500 bg-gray-50 px-2 py-1 rounded">Stok: ' . $buku->stok . '</span></div></li>';
    }
    $html .= '</ul></div>';

    // 4. Anggota dengan status_badge
    $html .= '<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">';
    $html .= '<h2 class="text-xl font-semibold mb-4 text-indigo-600 flex items-center"><span class="bg-indigo-100 text-indigo-800 w-8 h-8 rounded-full flex items-center justify-center mr-3">4</span> Anggota dengan status_badge</h2>';
    $html .= '<ul class="divide-y divide-gray-100">';
    foreach (Anggota::all() as $anggota) {
        $html .= '<li class="py-3 flex justify-between items-center">' .
            '<span class="font-medium text-gray-700">' . $anggota->nama . '</span>' .
            '<div>' . $anggota->status_badge . '</div></li>';
    }
    $html .= '</ul></div>';

    // 5. Anggota dengan kategori_usia
    $html .= '<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">';
    $html .= '<h2 class="text-xl font-semibold mb-4 text-indigo-600 flex items-center"><span class="bg-indigo-100 text-indigo-800 w-8 h-8 rounded-full flex items-center justify-center mr-3">5</span> Anggota dengan kategori_usia</h2>';
    $html .= '<ul class="divide-y divide-gray-100">';
    foreach (Anggota::all() as $anggota) {
        $html .= '<li class="py-3 flex justify-between items-center">' .
            '<span class="font-medium text-gray-700">' . $anggota->nama . '</span>' .
            '<div class="flex items-center gap-3"><span class="px-2.5 py-0.5 rounded text-xs font-medium bg-teal-100 text-teal-800">' . $anggota->kategori_usia . '</span> <span class="text-sm text-gray-500 bg-gray-50 px-2 py-1 rounded">Umur: ' . $anggota->umur . ' thn</span></div></li>';
    }
    $html .= '</ul></div>';

    // 6. Anggota terdaftar bulan ini (scope)
    $html .= '<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">';
    $html .= '<h2 class="text-xl font-semibold mb-4 text-indigo-600 flex items-center"><span class="bg-indigo-100 text-indigo-800 w-8 h-8 rounded-full flex items-center justify-center mr-3">6</span> Anggota terdaftar bulan ini (scope)</h2>';
    $html .= '<ul class="divide-y divide-gray-100">';
    foreach (Anggota::terdaftarBulanIni()->get() as $anggota) {
        $html .= '<li class="py-3 flex justify-between items-center">' .
            '<div class="flex flex-col"><span class="font-medium text-gray-700">' . $anggota->nama . '</span><span class="text-xs text-gray-500 mt-1">Daftar: ' . $anggota->tanggal_daftar->format('d-m-Y') . '</span></div>' .
            '<div>' . $anggota->status_badge . '</div></li>';
    }
    $html .= '</ul></div>';

    $html .= '</div></body></html>';

    return $html;
});


// // ========== ANGGOTA ==========

// Route::get('/anggota', function () use ($anggota_list) {
//     return view('anggota.index', compact('anggota_list'));
// })->name('anggota.index');

// Route::get('/anggota/{id}', function ($id) use ($anggota_list) {
//     $anggota = collect($anggota_list)->firstWhere('id', (int) $id);

//     abort_if(! $anggota, 404, 'Anggota tidak ditemukan');

//     return view('anggota.show', compact('anggota', 'anggota_list'));
// })->whereNumber('id')->name('anggota.show');

// ========== KATEGORI BUKU ==========

Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/search/{keyword}', [KategoriController::class, 'search'])->name('kategori.search');
Route::get('/kategori/{id}', [KategoriController::class, 'show'])->whereNumber('id')->name('kategori.show');



// Route menggunakan Controller
Route::get('/perpustakaan', [PerpustakaanController::class, 'index']);
// Route::get('/buku/{id}', [PerpustakaanController::class, 'show']);
// Route::get('/about', [PerpustakaanController::class, 'about']);

// // Anggota Routes
// Route::get('/anggota', function () {
//     $anggota_list = [
//         [
//             'id' => 1,
//             'kode' => 'AGT-001',
//             'nama' => 'Budi Santoso',
//             'email' => 'budi@email.com',
//             'telepon' => '081234567890',
//             'alamat' => 'Jakarta',
//             'status' => 'Aktif'
//         ],
//         [
//             'id' => 2,
//             'kode' => 'AGT-002',
//             'nama' => 'Siti Nurhaliza',
//             'email' => 'siti@email.com',
//             'telepon' => '082345678901',
//             'alamat' => 'Bandung',
//             'status' => 'Aktif'
//         ],
//         [
//             'id' => 3,
//             'kode' => 'AGT-003',
//             'nama' => 'Ahmad Rahman',
//             'email' => 'ahmad@email.com',
//             'telepon' => '083456789012',
//             'alamat' => 'Surabaya',
//             'status' => 'Aktif'
//         ],
//         [
//             'id' => 4,
//             'kode' => 'AGT-004',
//             'nama' => 'Dewi Lestari',
//             'email' => 'dewi@email.com',
//             'telepon' => '084567890123',
//             'alamat' => 'Yogyakarta',
//             'status' => 'Nonaktif'
//         ],
//         [
//             'id' => 5,
//             'kode' => 'AGT-005',
//             'nama' => 'Roni Wijaya',
//             'email' => 'roni@email.com',
//             'telepon' => '085678901234',
//             'alamat' => 'Medan',
//             'status' => 'Aktif'
//         ]
//     ];

//     return view('anggota.index', compact('anggota_list'));
// })->name('anggota.index');

// Route::get('/anggota/{id}', function ($id) {
//     $anggota_list = [
//         [
//             'id' => 1,
//             'kode' => 'AGT-001',
//             'nama' => 'Budi Santoso',
//             'email' => 'budi@email.com',
//             'telepon' => '081234567890',
//             'alamat' => 'Jakarta',
//             'status' => 'Aktif'
//         ],
//         [
//             'id' => 2,
//             'kode' => 'AGT-002',
//             'nama' => 'Siti Nurhaliza',
//             'email' => 'siti@email.com',
//             'telepon' => '082345678901',
//             'alamat' => 'Bandung',
//             'status' => 'Aktif'
//         ],
//         [
//             'id' => 3,
//             'kode' => 'AGT-003',
//             'nama' => 'Ahmad Rahman',
//             'email' => 'ahmad@email.com',
//             'telepon' => '083456789012',
//             'alamat' => 'Surabaya',
//             'status' => 'Aktif'
//         ],
//         [
//             'id' => 4,
//             'kode' => 'AGT-004',
//             'nama' => 'Dewi Lestari',
//             'email' => 'dewi@email.com',
//             'telepon' => '084567890123',
//             'alamat' => 'Yogyakarta',
//             'status' => 'Nonaktif'
//         ],
//         [
//             'id' => 5,
//             'kode' => 'AGT-005',
//             'nama' => 'Roni Wijaya',
//             'email' => 'roni@email.com',
//             'telepon' => '085678901234',
//             'alamat' => 'Medan',
//             'status' => 'Aktif'
//         ]
//     ];

//     $anggota = null;
//     foreach ($anggota_list as $member) {
//         if ($member['id'] == $id) {
//             $anggota = $member;
//             break;
//         }
//     }

//     if (!$anggota) {
//         abort(404, 'Anggota tidak ditemukan');
//     }

//     return view('anggota.show', compact('anggota', 'anggota_list'));
// })->name('anggota.show');

// // Kategori Routes
// Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
// Route::get('/kategori/search/{keyword?}', [KategoriController::class, 'search'])->name('kategori.search');
// Route::get('/kategori/{id}', [KategoriController::class, 'show'])
//     ->whereNumber('id')
//     ->name('kategori.show');

// Route test koneksi database
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        $dbName = DB::connection()->getDatabaseName();

        return "Koneksi database berhasil!<br />Database: <strong>{$dbName}</strong>";
    } catch (\Exception $e) {
        return "Koneksi database gagal!<br />Error: " . $e->getMessage();
    }
});
