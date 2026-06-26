<?php
// ============================================================
// File   : MahasiswaMandiri.php
// Lokasi : Classes/MahasiswaMandiri.php
// Fungsi : Subclass konkrit dari abstract class Mahasiswa.
//          Merepresentasikan mahasiswa dengan pembiayaan Mandiri.
// ============================================================

require_once __DIR__ . '/Mahasiswa.php';

/**
 * Class MahasiswaMandiri
 * 
 * Kelas turunan (child class) dari Mahasiswa untuk jenis pembiayaan Mandiri.
 * Mengimplementasikan seluruh abstract method dari kelas induk.
 * 
 * Properti tambahan:
 * - golonganUkt : Golongan UKT mahasiswa (1-8)
 * - namaWali    : Nama wali/orang tua mahasiswa
 */
class MahasiswaMandiri extends Mahasiswa
{
    // =====================================================
    // PROPERTI TAMBAHAN (protected)
    // =====================================================

    /** @var string Golongan UKT mahasiswa */
    protected $golonganUkt;

    /** @var string Nama wali/orang tua mahasiswa */
    protected $namaWali;

    // =====================================================
    // CONSTRUCTOR
    // =====================================================

    /**
     * Inisialisasi MahasiswaMandiri dengan properti induk + tambahan.
     *
     * @param int    $id_mahasiswa    ID mahasiswa
     * @param string $nama_mahasiswa  Nama lengkap
     * @param string $nim             Nomor Induk Mahasiswa
     * @param int    $semester        Semester aktif
     * @param float  $tarifUktNominal Tarif UKT nominal
     * @param string $golonganUkt     Golongan UKT
     * @param string $namaWali        Nama wali
     */
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $golonganUkt, $namaWali)
    {
        // Panggil constructor induk
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);

        $this->golonganUkt = $golonganUkt;
        $this->namaWali    = $namaWali;
    }

    // =====================================================
    // IMPLEMENTASI ABSTRACT METHODS
    // =====================================================

    /**
     * Menghitung tagihan semester untuk mahasiswa mandiri.
     * Total tagihan = tarifUktNominal + Rp100.000
     * (dikenakan biaya operasional kemahasiswaan/praktikum flat Rp100.000)
     *
     * @return float Total tagihan semester
     */
    public function hitungTagihanSemester()
    {
        // Mahasiswa Mandiri: tarif UKT + biaya operasional kemahasiswaan Rp100.000
        return $this->tarifUktNominal + 100000;
    }

    /**
     * Menampilkan spesifikasi akademik khusus mahasiswa mandiri.
     *
     * @return string Informasi spesifikasi akademik
     */
    public function tampilkanSpesifikasiAkademik()
    {
        return "=== Spesifikasi Akademik Mahasiswa Mandiri ===\n"
             . "ID Mahasiswa     : " . $this->id_mahasiswa . "\n"
             . "Nama             : " . $this->nama_mahasiswa . "\n"
             . "NIM              : " . $this->nim . "\n"
             . "Semester         : " . $this->semester . "\n"
             . "Golongan UKT     : " . $this->golonganUkt . "\n"
             . "Nama Wali        : " . $this->namaWali . "\n"
             . "Tarif UKT        : Rp " . number_format($this->tarifUktNominal, 2, ',', '.') . "\n"
             . "Tagihan Semester : Rp " . number_format($this->hitungTagihanSemester(), 2, ',', '.') . "\n"
             . "Jenis Pembiayaan : Mandiri\n";
    }

    // =====================================================
    // GETTER TAMBAHAN
    // =====================================================

    /** @return string */
    public function getGolonganUkt()
    {
        return $this->golonganUkt;
    }

    /** @return string */
    public function getNamaWali()
    {
        return $this->namaWali;
    }

    // =====================================================
    // METODE QUERY BERSYARAT (WHERE)
    // =====================================================

    /**
     * Mengambil seluruh data mahasiswa mandiri dari database.
     * Query menggunakan klausa WHERE jenis_pembiayaan = 'Mandiri'
     * sehingga hanya data mahasiswa mandiri yang dimuat.
     *
     * @param  mysqli $koneksi Objek koneksi database
     * @return MahasiswaMandiri[] Array of MahasiswaMandiri objects
     */
    public static function getAll($koneksi)
    {
        $data = [];
        $query = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Mandiri' ORDER BY id_mahasiswa ASC";
        $result = $koneksi->query($query);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = new MahasiswaMandiri(
                    $row['id_mahasiswa'],
                    $row['nama_mahasiswa'],
                    $row['nim'],
                    $row['semester'],
                    $row['trif_ukt_nominal'],
                    $row['golongan_ukt'] ?? '-',
                    $row['nama_wali'] ?? '-'
                );
            }
        }

        return $data;
    }
}
