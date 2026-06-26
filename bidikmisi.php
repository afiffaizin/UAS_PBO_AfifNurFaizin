<?php
// ============================================================
// File   : bidikmisi.php
// Fungsi : Halaman data mahasiswa bidikmisi - Tabel & Spesifikasi
//          Data diambil via MahasiswaBidikmisi::getAll() (Polimorfisme)
// ============================================================

require_once __DIR__ . '/Classes/MahasiswaBidikmisi.php';

// Ambil data menggunakan method query bersyarat (WHERE)
$dataBidikmisi = MahasiswaBidikmisi::getAll($koneksi);

$pageTitle    = 'Mahasiswa Bidikmisi';
$pageSubtitle = 'Data Registrasi Pembayaran UKT - Pembiayaan Bidikmisi (KIP-Kuliah)';

include __DIR__ . '/includes/header.php';
?>

<!-- Page Header -->
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
            <li class="breadcrumb-item active">Mahasiswa Bidikmisi</li>
        </ol>
    </nav>
</div>

<!-- Ringkasan -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card card-bidikmisi">
            <div class="card-body">
                <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                <div class="stat-value"><?= count($dataBidikmisi) ?></div>
                <div class="stat-label">Total Mahasiswa Bidikmisi</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card card-total">
            <div class="card-body">
                <div class="stat-icon"><i class="bi bi-cash-coin"></i></div>
                <?php
                $totalTagihan = 0;
                foreach ($dataBidikmisi as $mhs) {
                    $totalTagihan += $mhs->hitungTagihanSemester();
                }
                ?>
                <div class="stat-value" style="font-size:1.4rem;">Rp <?= number_format($totalTagihan, 0, ',', '.') ?></div>
                <div class="stat-label">Total Tagihan Semester</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
            <div class="card-body">
                <div class="stat-icon"><i class="bi bi-heart-fill"></i></div>
                <div class="stat-value" style="font-size:1rem;">GRATIS (Rp 0)</div>
                <div class="stat-label">KIP-Kuliah — Ditanggung Negara</div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Data -->
<div class="content-card mb-4">
    <div class="card-header">
        <h5 class="card-title">
            <i class="bi bi-table"></i>
            Tabel Data Mahasiswa Bidikmisi
        </h5>
        <span class="badge bg-success rounded-pill"><?= count($dataBidikmisi) ?> data</span>
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
                        <th>Tunjangan Kesehatan</th>
                        <th>Opsi Saham ID</th>
                        <th>Tarif UKT</th>
                        <th>Tagihan Semester</th>
                        <th>Jenis</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($dataBidikmisi) > 0): ?>
                        <?php $no = 1; foreach ($dataBidikmisi as $mhs): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $mhs->getIdMahasiswa() ?></td>
                            <td><strong><?= htmlspecialchars($mhs->getNamaMahasiswa()) ?></strong></td>
                            <td><code><?= htmlspecialchars($mhs->getNim()) ?></code></td>
                            <td><span class="badge bg-success"><?= $mhs->getSemester() ?></span></td>
                            <td>Rp <?= number_format($mhs->getTunjanganKesehatan(), 0, ',', '.') ?></td>
                            <td><code><?= htmlspecialchars($mhs->getOpsiSahamId()) ?></code></td>
                            <td>Rp <?= number_format($mhs->getTarifUktNominal(), 0, ',', '.') ?></td>
                            <td><strong class="text-success">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.') ?></strong></td>
                            <td><span class="badge badge-jenis badge-bidikmisi">Bidikmisi</span></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="10" class="text-center text-muted py-4">Tidak ada data mahasiswa bidikmisi.</td></tr>
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
            Spesifikasi Akademik Mahasiswa Bidikmisi
        </h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <?php foreach ($dataBidikmisi as $mhs): ?>
            <div class="col-lg-6">
                <div class="spec-card bidikmisi">
                    <div class="spec-name">
                        <i class="bi bi-person-heart text-success me-1"></i>
                        <?= htmlspecialchars($mhs->getNamaMahasiswa()) ?>
                    </div>
                    <div class="spec-detail"><strong>NIM:</strong> <?= htmlspecialchars($mhs->getNim()) ?></div>
                    <div class="spec-detail"><strong>Semester:</strong> <?= $mhs->getSemester() ?></div>
                    <div class="spec-detail"><strong>Tunjangan Kesehatan:</strong> Rp <?= number_format($mhs->getTunjanganKesehatan(), 0, ',', '.') ?></div>
                    <div class="spec-detail"><strong>Opsi Saham ID:</strong> <?= htmlspecialchars($mhs->getOpsiSahamId()) ?></div>
                    <div class="spec-detail"><strong>Tarif UKT:</strong> Rp <?= number_format($mhs->getTarifUktNominal(), 0, ',', '.') ?></div>
                    <div class="spec-tagihan">
                        <i class="bi bi-check-circle-fill me-1"></i>
                        Tagihan: Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.') ?> (GRATIS)
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
