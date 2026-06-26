<?php
// ============================================================
// File   : mandiri.php
// Fungsi : Halaman data mahasiswa mandiri - Tabel & Spesifikasi
//          Data diambil via MahasiswaMandiri::getAll() (Polimorfisme)
// ============================================================

require_once __DIR__ . '/Classes/MahasiswaMandiri.php';

// Ambil data menggunakan method query bersyarat (WHERE)
$dataMandiri = MahasiswaMandiri::getAll($koneksi);

$pageTitle    = 'Mahasiswa Mandiri';
$pageSubtitle = 'Data Registrasi Pembayaran UKT - Pembiayaan Mandiri';

include __DIR__ . '/includes/header.php';
?>

<!-- Page Header -->
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
            <li class="breadcrumb-item active">Mahasiswa Mandiri</li>
        </ol>
    </nav>
</div>

<!-- Ringkasan -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card card-mandiri">
            <div class="card-body">
                <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                <div class="stat-value"><?= count($dataMandiri) ?></div>
                <div class="stat-label">Total Mahasiswa Mandiri</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card card-total">
            <div class="card-body">
                <div class="stat-icon"><i class="bi bi-cash-coin"></i></div>
                <?php
                $totalTagihan = 0;
                foreach ($dataMandiri as $mhs) {
                    $totalTagihan += $mhs->hitungTagihanSemester();
                }
                ?>
                <div class="stat-value" style="font-size:1.4rem;">Rp <?= number_format($totalTagihan, 0, ',', '.') ?></div>
                <div class="stat-label">Total Tagihan Semester</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #475569 0%, #64748b 100%);">
            <div class="card-body">
                <div class="stat-icon"><i class="bi bi-calculator"></i></div>
                <div class="stat-value" style="font-size:1rem;">UKT + Rp100.000</div>
                <div class="stat-label">Formula Tagihan Mandiri</div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Data -->
<div class="content-card mb-4">
    <div class="card-header">
        <h5 class="card-title">
            <i class="bi bi-table"></i>
            Tabel Data Mahasiswa Mandiri
        </h5>
        <span class="badge bg-primary rounded-pill"><?= count($dataMandiri) ?> data</span>
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
                        <th>Golongan UKT</th>
                        <th>Nama Wali</th>
                        <th>Tarif UKT</th>
                        <th>Tagihan Semester</th>
                        <th>Jenis</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($dataMandiri) > 0): ?>
                        <?php $no = 1; foreach ($dataMandiri as $mhs): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $mhs->getIdMahasiswa() ?></td>
                            <td><strong><?= htmlspecialchars($mhs->getNamaMahasiswa()) ?></strong></td>
                            <td><code><?= htmlspecialchars($mhs->getNim()) ?></code></td>
                            <td><span class="badge bg-primary"><?= $mhs->getSemester() ?></span></td>
                            <td><?= htmlspecialchars($mhs->getGolonganUkt()) ?></td>
                            <td><?= htmlspecialchars($mhs->getNamaWali()) ?></td>
                            <td>Rp <?= number_format($mhs->getTarifUktNominal(), 0, ',', '.') ?></td>
                            <td><strong class="text-primary">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.') ?></strong></td>
                            <td><span class="badge badge-jenis badge-mandiri">Mandiri</span></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="10" class="text-center text-muted py-4">Tidak ada data mahasiswa mandiri.</td></tr>
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
            Spesifikasi Akademik Mahasiswa Mandiri
        </h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <?php foreach ($dataMandiri as $mhs): ?>
            <div class="col-lg-6">
                <div class="spec-card mandiri">
                    <div class="spec-name">
                        <i class="bi bi-person-fill text-primary me-1"></i>
                        <?= htmlspecialchars($mhs->getNamaMahasiswa()) ?>
                    </div>
                    <div class="spec-detail"><strong>NIM:</strong> <?= htmlspecialchars($mhs->getNim()) ?></div>
                    <div class="spec-detail"><strong>Semester:</strong> <?= $mhs->getSemester() ?></div>
                    <div class="spec-detail"><strong>Golongan UKT:</strong> <?= htmlspecialchars($mhs->getGolonganUkt()) ?></div>
                    <div class="spec-detail"><strong>Nama Wali:</strong> <?= htmlspecialchars($mhs->getNamaWali()) ?></div>
                    <div class="spec-detail"><strong>Tarif UKT:</strong> Rp <?= number_format($mhs->getTarifUktNominal(), 0, ',', '.') ?></div>
                    <div class="spec-tagihan">
                        <i class="bi bi-cash-stack me-1"></i>
                        Tagihan: Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.') ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
