<?php
// ============================================================
// File   : MahasiswaPrestasi.php
// Lokasi : Classes/MahasiswaPrestasi.php
// Fungsi : Subclass konkrit dari abstract class Mahasiswa.
//          Merepresentasikan mahasiswa dengan pembiayaan Prestasi.
// ============================================================

require_once __DIR__ . '/Mahasiswa.php';

/**
 * Class MahasiswaPrestasi
 * 
 * Kelas turunan (child class) dari Mahasiswa untuk jenis pembiayaan Prestasi.
 * Mengimplementasikan seluruh abstract method dari kelas induk.
 * 
 * Properti tambahan:
 * - namaInstansiBeasiswa : Nama instansi pemberi beasiswa
 * - minimalIpkSyarat     : Minimal IPK yang disyaratkan untuk mempertahankan beasiswa
 */
class MahasiswaPrestasi extends Mahasiswa
{
    // =====================================================
    // PROPERTI TAMBAHAN (protected)
    // =====================================================

    /** @var string Nama instansi pemberi beasiswa */
    protected $namaInstansiBeasiswa;

    /** @var float Minimal IPK syarat mempertahankan beasiswa */
    protected $minimalIpkSyarat;

    // =====================================================
    // CONSTRUCTOR
    // =====================================================

    /**
     * Inisialisasi MahasiswaPrestasi dengan properti induk + tambahan.
     *
     * @param int    $id_mahasiswa        ID mahasiswa
     * @param string $nama_mahasiswa      Nama lengkap
     * @param string $nim                 Nomor Induk Mahasiswa
     * @param int    $semester            Semester aktif
     * @param float  $tarifUktNominal     Tarif UKT nominal
     * @param string $namaInstansiBeasiswa Nama instansi beasiswa
     * @param float  $minimalIpkSyarat    Minimal IPK syarat
     */
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $namaInstansiBeasiswa, $minimalIpkSyarat)
    {
        // Panggil constructor induk
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);

        $this->namaInstansiBeasiswa = $namaInstansiBeasiswa;
        $this->minimalIpkSyarat     = $minimalIpkSyarat;
    }

    // =====================================================
    // IMPLEMENTASI ABSTRACT METHODS
    // =====================================================

    /**
     * Menghitung tagihan semester untuk mahasiswa prestasi.
     * Mahasiswa Prestasi mendapat beasiswa penuh dari instansi,
     * sehingga tagihan semester = Rp 0.
     *
     * @return float Total tagihan semester
     */
    public function hitungTagihanSemester()
    {
        // Mahasiswa Prestasi dibebaskan dari biaya UKT (ditanggung beasiswa)
        return 0;
    }

    /**
     * Menampilkan spesifikasi akademik khusus mahasiswa prestasi.
     *
     * @return string Informasi spesifikasi akademik
     */
    public function tampilkanSpesifikasiAkademik()
    {
        return "=== Spesifikasi Akademik Mahasiswa Prestasi ===\n"
             . "ID Mahasiswa            : " . $this->id_mahasiswa . "\n"
             . "Nama                    : " . $this->nama_mahasiswa . "\n"
             . "NIM                     : " . $this->nim . "\n"
             . "Semester                : " . $this->semester . "\n"
             . "Instansi Beasiswa       : " . $this->namaInstansiBeasiswa . "\n"
             . "Minimal IPK Syarat      : " . number_format($this->minimalIpkSyarat, 2) . "\n"
             . "Tarif UKT Nominal       : Rp " . number_format($this->tarifUktNominal, 2, ',', '.') . "\n"
             . "Tagihan Semester        : Rp " . number_format($this->hitungTagihanSemester(), 2, ',', '.') . "\n"
             . "Jenis Pembiayaan        : Prestasi\n";
    }

    // =====================================================
    // GETTER TAMBAHAN
    // =====================================================

    /** @return string */
    public function getNamaInstansiBeasiswa()
    {
        return $this->namaInstansiBeasiswa;
    }

    /** @return float */
    public function getMinimalIpkSyarat()
    {
        return $this->minimalIpkSyarat;
    }
}
