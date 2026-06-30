<?php

// 1. Ambil semua buku dan hitung jumlahnya
$bukus = App\Models\Buku::all();
dump("Jumlah semua buku:", $bukus->count());

// 2. Ambil buku pertama dan tampilkan judulnya
$buku = App\Models\Buku::first();
dump("Judul buku pertama:", optional($buku)->judul);

// 3. Ambil buku ID 1, tampilkan judul dan format harga
$buku = App\Models\Buku::find(1);
dump("Judul buku ID 1:", optional($buku)->judul);
dump("Harga format buku ID 1:", optional($buku)->harga_format);

// 4. Cari buku berdasarkan kode_buku 'BK-001'
$buku = App\Models\Buku::where('kode_buku', 'BK-001')->first();
dump("Judul buku BK-001:", optional($buku)->judul);

// 5. Cari buku kategori Programming dan hitung jumlahnya
$bukus = App\Models\Buku::where('kategori', 'Programming')->get();
dump("Jumlah buku Programming:", $bukus->count());

// 6. Ambil buku yang tersedia dan tampilkan judul-judulnya
$bukus = App\Models\Buku::tersedia()->get();
dump("Judul buku yang tersedia:", $bukus->pluck('judul'));

// 7. Ambil buku kategori Database dan tampilkan judul-judulnya
$bukus = App\Models\Buku::kategori('Database')->get();
dump("Judul buku Database:", $bukus->pluck('judul'));

// 8. Ambil buku Programming dengan stok > 10, urutkan berdasarkan harga termahal
$bukus = App\Models\Buku::where('kategori', 'Programming')->where('stok', '>', 10)->orderBy('harga', 'desc')->get();
dump("Buku Programming stok > 10 (Urut Harga):", $bukus->pluck('judul'));

// 9. Tambah buku baru menggunakan instansiasi objek (BK-009)
$buku = new App\Models\Buku();
$buku->kode_buku = 'BK-009';
$buku->judul = 'Vue.js 3 Complete Guide';
$buku->kategori = 'Programming';
$buku->pengarang = 'Sarah Chen';
$buku->penerbit = 'Frontend Books';
$buku->tahun_terbit = 2024;
$buku->harga = 145000;
$buku->stok = 15;
$buku->bahasa = 'Inggris';
$buku->save();
dump("Buku baru disimpan, ID:", $buku->id);

// 10. Tambah buku baru menggunakan mass assignment (BK-010)
$bukuBaru = App\Models\Buku::create([
    'kode_buku' => 'BK-010',
    'judul' => 'Docker & Kubernetes',
    'kategori' => 'Programming',
    'pengarang' => 'Michael Johnson',
    'penerbit' => 'DevOps Press',
    'tahun_terbit' => 2024,
    'harga' => 210000,
    'stok' => 8,
    'bahasa' => 'Inggris'
]);
dump("Buku Mass Assignment berhasil dibuat:", $bukuBaru->judul);
dump("Total jumlah buku sekarang:", App\Models\Buku::count());

// 11. Update data buku ID 1 secara manual
$buku = App\Models\Buku::find(1);
if ($buku) {
    $buku->stok = 25;
    $buku->harga = 155000;
    $buku->save();
    dump("Buku ID 1 berhasil di-update stok & harganya.");
}

// 12. Update data buku ID 2 menggunakan method update()
$buku = App\Models\Buku::find(2);
if ($buku) {
    $buku->update([
        'stok' => 20,
        'harga' => 180000
    ]);
    dump("Buku ID 2 berhasil di-update.");
}

// 13. Mass update semua buku kategori Programming menjadi stok 30
App\Models\Buku::where('kategori', 'Programming')->update(['stok' => 30]);
dump("Semua stok buku Programming diubah menjadi 30.");

// 14. Cek stok terbaru buku ID 1
$buku = App\Models\Buku::find(1);
dump("Stok terbaru buku ID 1:", optional($buku)->stok);

// 15. Proses Hapus Data (Soft Delete / Hard Delete sesuai konfigurasi model Anda)
$buku = App\Models\Buku::find(10);
if ($buku) {
    $buku->delete();
    dump("Buku ID 10 berhasil dihapus.");
}

App\Models\Buku::destroy(9);
dump("Buku ID 9 dihancurkan (destroy).");

App\Models\Buku::destroy([7, 8]);
dump("Buku ID 7 dan 8 dihancurkan.");

App\Models\Buku::where('stok', 0)->delete();
dump("Semua buku dengan stok 0 berhasil dihapus.");
dump("Total jumlah buku setelah penghapusan:", App\Models\Buku::count());

// 16. Operasi data Anggota
$anggotas = App\Models\Anggota::all();
dump("Jumlah semua anggota:", $anggotas->count());

$anggota = App\Models\Anggota::first();
dump("Nama anggota pertama:", optional($anggota)->nama);
dump("Umur anggota pertama:", optional($anggota)->umur);
dump("Lama anggota pertama:", optional($anggota)->lama_anggota);

// 17. Ambil anggota aktif dan tampilkan nama-namanya
$aktif = App\Models\Anggota::aktif()->get();
dump("Nama-nama anggota aktif:", $aktif->pluck('nama'));

// 18. Tambah anggota baru
$anggotaBaru = App\Models\Anggota::create([
    'kode_anggota' => 'AGT-006',
    'nama' => 'Testing User',
    'email' => 'test' . rand(1,999) . '@example.com', // Ditambah angka acak agar tidak error unique constraint saat dijalankan ulang
    'telepon' => '081234567899',
    'alamat' => 'Jl. Test No. 1',
    'tanggal_lahir' => '2000-01-01',
    'jenis_kelamin' => 'Laki-laki',
    'pekerjaan' => 'Tester',
    'tanggal_daftar' => today(),
    'status' => 'Aktif'
]);
dump("Anggota baru berhasil didaftarkan:", $anggotaBaru->nama);