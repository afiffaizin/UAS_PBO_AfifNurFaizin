<?php
// ============================================================
// File   : koneksi.php
// Lokasi : Config/koneksi.php
// Fungsi : Membuat koneksi ke database DB_UAS_PBO_TRPL1A_AfifNurFaizin
//          menggunakan MySQLi (Object-Oriented)
// ============================================================

$host     = 'localhost';
$username = 'root';
$password = '';
$database = 'db_uas_pbo_trpl1a_afifnurfaizin';
$port     = 3306;

// Membuat koneksi MySQLi
$koneksi = new mysqli($host, $username, $password, $database, $port);

// Validasi koneksi
if ($koneksi->connect_error) {
    die("❌ Koneksi ke database gagal: " . $koneksi->connect_error);
}

// Set charset UTF-8
$koneksi->set_charset("utf8mb4");

// Pesan sukses (opsional, bisa dinonaktifkan di produksi)
// echo "✅ Koneksi ke database '$database' berhasil.<br>";
