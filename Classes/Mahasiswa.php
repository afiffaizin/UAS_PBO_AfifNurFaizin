<?php
// ============================================================
// File   : Mahasiswa.php
// Lokasi : Classes/Mahasiswa.php
// Fungsi : Abstract class induk untuk seluruh jenis mahasiswa.
//          Mengimplementasikan konsep Abstraksi (Abstraction)
//          dengan properti terenkapsulasi (protected) dan
//          abstract method yang wajib di-override oleh subclass.
// ============================================================

// Include file koneksi database
require_once __DIR__ . '/../Config/koneksi.php';

/**
 * Abstract Class Mahasiswa
 * 
 * Kelas abstrak yang menjadi blueprint untuk seluruh jenis mahasiswa.
 * Tidak dapat di-instantiate secara langsung — hanya bisa diturunkan
 * oleh subclass (MahasiswaMandiri, MahasiswaBidikmisi, MahasiswaPrestasi).
 * 
 * Konsep OOP yang diterapkan:
 * - Abstraction  : Kelas ini abstract, memaksa subclass mengimplementasikan method tertentu.
 * - Encapsulation : Seluruh properti bersifat protected (hanya bisa diakses oleh kelas ini & turunannya).
 */
abstract class Mahasiswa
{
    // =====================================================
    // PROPERTI TERENKAPSULASI (protected)
    // Hanya dapat diakses oleh kelas ini dan subclass-nya
    // =====================================================

    /** @var int ID unik mahasiswa (Primary Key) */
    protected $id_mahasiswa;

    /** @var string Nama lengkap mahasiswa */
    protected $nama_mahasiswa;

    /** @var string Nomor Induk Mahasiswa */
    protected $nim;

    /** @var int Semester aktif mahasiswa */
    protected $semester;

    /** @var float Tarif UKT nominal mahasiswa */
    protected $tarifUktNominal;

    // =====================================================
    // CONSTRUCTOR
    // =====================================================

    /**
     * Inisialisasi properti dasar mahasiswa.
     *
     * @param int    $id_mahasiswa    ID mahasiswa
     * @param string $nama_mahasiswa  Nama lengkap
     * @param string $nim             Nomor Induk Mahasiswa
     * @param int    $semester        Semester aktif
     * @param float  $tarifUktNominal Tarif UKT nominal
     */
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal)
    {
        $this->id_mahasiswa    = $id_mahasiswa;
        $this->nama_mahasiswa  = $nama_mahasiswa;
        $this->nim             = $nim;
        $this->semester        = $semester;
        $this->tarifUktNominal = $tarifUktNominal;
    }

    // =====================================================
    // ABSTRACT METHODS (Tanpa Body)
    // Wajib diimplementasikan oleh setiap subclass
    // =====================================================

    /**
     * Menghitung total tagihan semester mahasiswa.
     * Setiap jenis mahasiswa memiliki formula perhitungan yang berbeda.
     *
     * @return float Total tagihan semester
     */
    abstract public function hitungTagihanSemester();

    /**
     * Menampilkan spesifikasi akademik khusus mahasiswa.
     * Setiap jenis mahasiswa menampilkan informasi spesifik yang berbeda.
     *
     * @return string Informasi spesifikasi akademik
     */
    abstract public function tampilkanSpesifikasiAkademik();

    // =====================================================
    // GETTER METHODS (Akses properti protected dari luar)
    // =====================================================

    /** @return int */
    public function getIdMahasiswa()
    {
        return $this->id_mahasiswa;
    }

    /** @return string */
    public function getNamaMahasiswa()
    {
        return $this->nama_mahasiswa;
    }

    /** @return string */
    public function getNim()
    {
        return $this->nim;
    }

    /** @return int */
    public function getSemester()
    {
        return $this->semester;
    }

    /** @return float */
    public function getTarifUktNominal()
    {
        return $this->tarifUktNominal;
    }
}
