<?php
// ============================================================
// File   : MahasiswaBidikmisi.php
// Lokasi : Classes/MahasiswaBidikmisi.php
// Fungsi : Subclass konkrit dari abstract class Mahasiswa.
//          Merepresentasikan mahasiswa dengan pembiayaan Bidikmisi.
// ============================================================

require_once __DIR__ . '/Mahasiswa.php';

/**
 * Class MahasiswaBidikmisi
 * 
 * Kelas turunan (child class) dari Mahasiswa untuk jenis pembiayaan Bidikmisi.
 * Mengimplementasikan seluruh abstract method dari kelas induk.
 * 
 * Properti tambahan:
 * - tunjanganKesehatan : Nominal tunjangan kesehatan yang diterima
 * - opsiSahamId        : ID opsi saham/investasi pendidikan
 */
class MahasiswaBidikmisi extends Mahasiswa
{
    // =====================================================
    // PROPERTI TAMBAHAN (protected)
    // =====================================================

    /** @var float Nominal tunjangan kesehatan */
    protected $tunjanganKesehatan;

    /** @var string ID opsi saham/investasi pendidikan */
    protected $opsiSahamId;

    // =====================================================
    // CONSTRUCTOR
    // =====================================================

    /**
     * Inisialisasi MahasiswaBidikmisi dengan properti induk + tambahan.
     *
     * @param int    $id_mahasiswa       ID mahasiswa
     * @param string $nama_mahasiswa     Nama lengkap
     * @param string $nim                Nomor Induk Mahasiswa
     * @param int    $semester           Semester aktif
     * @param float  $tarifUktNominal    Tarif UKT nominal
     * @param float  $tunjanganKesehatan Tunjangan kesehatan
     * @param string $opsiSahamId        ID opsi saham
     */
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $tunjanganKesehatan, $opsiSahamId)
    {
        // Panggil constructor induk
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);

        $this->tunjanganKesehatan = $tunjanganKesehatan;
        $this->opsiSahamId        = $opsiSahamId;
    }

    // =====================================================
    // IMPLEMENTASI ABSTRACT METHODS
    // =====================================================

    /**
     * Menghitung tagihan semester untuk mahasiswa bidikmisi.
     * Mahasiswa Bidikmisi mendapat subsidi penuh (UKT ditanggung pemerintah),
     * sehingga tagihan semester = Rp 0.
     *
     * @return float Total tagihan semester
     */
    public function hitungTagihanSemester()
    {
        // Mahasiswa Bidikmisi dibebaskan dari biaya UKT (ditanggung pemerintah)
        return 0;
    }

    /**
     * Menampilkan spesifikasi akademik khusus mahasiswa bidikmisi.
     *
     * @return string Informasi spesifikasi akademik
     */
    public function tampilkanSpesifikasiAkademik()
    {
        return "=== Spesifikasi Akademik Mahasiswa Bidikmisi ===\n"
             . "ID Mahasiswa         : " . $this->id_mahasiswa . "\n"
             . "Nama                 : " . $this->nama_mahasiswa . "\n"
             . "NIM                  : " . $this->nim . "\n"
             . "Semester             : " . $this->semester . "\n"
             . "Tunjangan Kesehatan  : Rp " . number_format($this->tunjanganKesehatan, 2, ',', '.') . "\n"
             . "Opsi Saham ID        : " . $this->opsiSahamId . "\n"
             . "Tarif UKT Nominal    : Rp " . number_format($this->tarifUktNominal, 2, ',', '.') . "\n"
             . "Tagihan Semester     : Rp " . number_format($this->hitungTagihanSemester(), 2, ',', '.') . "\n"
             . "Jenis Pembiayaan     : Bidikmisi\n";
    }

    // =====================================================
    // GETTER TAMBAHAN
    // =====================================================

    /** @return float */
    public function getTunjanganKesehatan()
    {
        return $this->tunjanganKesehatan;
    }

    /** @return string */
    public function getOpsiSahamId()
    {
        return $this->opsiSahamId;
    }
}
