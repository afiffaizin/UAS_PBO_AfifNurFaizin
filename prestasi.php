<?php
// ============================================================
// File   : prestasi.php
// Fungsi : Halaman data mahasiswa prestasi - Tabel & Spesifikasi
//          Data diambil via MahasiswaPrestasi::getAll() (Polimorfisme)
// ============================================================

require_once __DIR__ . '/Classes/MahasiswaPrestasi.php';

// Ambil data menggunakan method query bersyarat (WHERE)
$dataPrestasi = MahasiswaPrestasi::getAll($koneksi);

$pageTitle    = 'Mahasiswa Prestasi';
$pageSubtitle = 'Data Registrasi Pembayaran UKT - Pembiayaan Beasiswa Prestasi';

include __DIR__ . '/includes/header.php';
?>

<!-- Page Header -->
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
            <li class="breadcrumb-item active">Mahasiswa Prestasi</li>
        </ol>
    </nav>
</div>

<!-- Ringkasan -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card card-prestasi">
            <div class="card-body">
                <div class="stat-icon"><i class="bi bi-award-fill"></i></div>
                <div class="stat-value"><?= count($dataPrestasi) ?></div>
                <div class="stat-label">Total Mahasiswa Prestasi</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card card-total">
            <div class="card-body">
                <div class="stat-icon"><i class="bi bi-cash-coin"></i></div>
                <?php
                $totalTagihan = 0;
                foreach ($dataPrestasi as $mhs) {
                    $totalTagihan += $mhs->hitungTagihanSemester();
                }
                ?>
                <div class="stat-value" style="font-size:1.4rem;">Rp <?= number_format($totalTagihan, 0, ',', '.') ?></div>
                <div class="stat-label">Total Tagihan Semester</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);">
            <div class="card-body">
                <div class="stat-icon"><i class="bi bi-percent"></i></div>
                <div class="stat-value" style="font-size:1rem;">UKT × 25%</div>
                <div class="stat-label">Potongan 75% Beasiswa Prestasi</div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Data -->
<div class="content-card mb-4">
    <div class="card-header">
        <h5 class="card-title">
            <i class="bi bi-table"></i>
            Tabel Data Mahasiswa Prestasi
        </h5>
        <span class="badge bg-warning text-dark rounded-pill"><?= count($dataPrestasi) ?> data</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover data-table mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Semester</th>
                        <th>Instansi Beasiswa</th>
                        <th>Min. IPK Syarat</th>
                        <th>Tarif UKT</th>
                        <th>Tagihan Semester</th>
                        <th>Jenis</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($dataPrestasi) > 0): ?>
                        <?php $no = 1; foreach ($dataPrestasi as $mhs): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $mhs->getIdMahasiswa() ?></td>
                            <td><strong><?= htmlspecialchars($mhs->getNamaMahasiswa()) ?></strong></td>
                            <td><code><?= htmlspecialchars($mhs->getNim()) ?></code></td>
                            <td><span class="badge bg-warning text-dark"><?= $mhs->getSemester() ?></span></td>
                            <td><?= htmlspecialchars($mhs->getNamaInstansiBeasiswa()) ?></td>
                            <td><span class="badge bg-light text-dark"><?= number_format($mhs->getMinimalIpkSyarat(), 2) ?></span></td>
                            <td>Rp <?= number_format($mhs->getTarifUktNominal(), 0, ',', '.') ?></td>
                            <td><strong class="text-warning">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.') ?></strong></td>
                            <td><span class="badge badge-jenis badge-prestasi">Prestasi</span></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="10" class="text-center text-muted py-4">Tidak ada data mahasiswa prestasi.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Spesifikasi Akademik (Polimorfisme) -->
<div class="content-card mb-4">
    <div class="card-header">
        <h5 class="card-title">
            <i class="bi bi-card-checklist"></i>
            Spesifikasi Akademik Mahasiswa Prestasi
        </h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <?php foreach ($dataPrestasi as $mhs): ?>
            <div class="col-lg-6">
                <div class="spec-card prestasi">
                    <div class="spec-name">
                        <i class="bi bi-award-fill text-warning me-1"></i>
                        <?= htmlspecialchars($mhs->getNamaMahasiswa()) ?>
                    </div>
                    <div class="spec-detail"><strong>NIM:</strong> <?= htmlspecialchars($mhs->getNim()) ?></div>
                    <div class="spec-detail"><strong>Semester:</strong> <?= $mhs->getSemester() ?></div>
                    <div class="spec-detail"><strong>Instansi Beasiswa:</strong> <?= htmlspecialchars($mhs->getNamaInstansiBeasiswa()) ?></div>
                    <div class="spec-detail"><strong>Minimal IPK Syarat:</strong> <?= number_format($mhs->getMinimalIpkSyarat(), 2) ?></div>
                    <div class="spec-detail"><strong>Tarif UKT:</strong> Rp <?= number_format($mhs->getTarifUktNominal(), 0, ',', '.') ?></div>
                    <div class="spec-tagihan">
                        <i class="bi bi-trophy-fill me-1"></i>
                        Tagihan: Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.') ?> (diskon 75%)
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
