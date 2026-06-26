<?php
// ============================================================
// File   : index.php
// Lokasi : index.php
// Fungsi : Dashboard utama - Kartu Statistik & Grafik Chart.js
// ============================================================

// Include classes (otomatis include koneksi.php)
require_once __DIR__ . '/Classes/MahasiswaMandiri.php';
require_once __DIR__ . '/Classes/MahasiswaBidikmisi.php';
require_once __DIR__ . '/Classes/MahasiswaPrestasi.php';

// =====================================================
// QUERY DATA STATISTIK DARI DATABASE
// =====================================================

// Hitung jumlah per jenis pembiayaan
$queryStats = "SELECT jenis_pembiayaan, COUNT(*) as jumlah FROM tabel_mahasiswa GROUP BY jenis_pembiayaan";
$resultStats = $koneksi->query($queryStats);

$stats = ['Mandiri' => 0, 'Bidikmisi' => 0, 'Prestasi' => 0];
while ($row = $resultStats->fetch_assoc()) {
    $stats[$row['jenis_pembiayaan']] = (int)$row['jumlah'];
}
$totalMahasiswa = array_sum($stats);

// Hitung total tagihan per jenis (menggunakan OOP/Polimorfisme)
$totalTagihanMandiri = 0;
$totalTagihanBidikmisi = 0;
$totalTagihanPrestasi = 0;

// Mahasiswa Mandiri
$qMandiri = $koneksi->query("SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Mandiri'");
while ($r = $qMandiri->fetch_assoc()) {
    $obj = new MahasiswaMandiri(
        $r['id_mahasiswa'], $r['nama_mahasiswa'], $r['nim'],
        $r['semester'], $r['trif_ukt_nominal'],
        $r['golongan_ukt'], $r['nama_wali'] ?? '-'
    );
    $totalTagihanMandiri += $obj->hitungTagihanSemester();
}

// Mahasiswa Bidikmisi
$qBidikmisi = $koneksi->query("SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Bidikmisi'");
while ($r = $qBidikmisi->fetch_assoc()) {
    $obj = new MahasiswaBidikmisi(
        $r['id_mahasiswa'], $r['nama_mahasiswa'], $r['nim'],
        $r['semester'], $r['trif_ukt_nominal'],
        $r['dana_saku_subsidi'] ?? 0, $r['nomor_kip_kuliah'] ?? '-'
    );
    $totalTagihanBidikmisi += $obj->hitungTagihanSemester();
}

// Mahasiswa Prestasi
$qPrestasi = $koneksi->query("SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Prestasi'");
while ($r = $qPrestasi->fetch_assoc()) {
    $obj = new MahasiswaPrestasi(
        $r['id_mahasiswa'], $r['nama_mahasiswa'], $r['nim'],
        $r['semester'], $r['trif_ukt_nominal'],
        $r['nama_instansi_beasiswa'] ?? '-', $r['minimal_ipk_syarat'] ?? 0
    );
    $totalTagihanPrestasi += $obj->hitungTagihanSemester();
}

// Rata-rata UKT per jenis
$qAvgUkt = $koneksi->query("SELECT jenis_pembiayaan, AVG(trif_ukt_nominal) as avg_ukt FROM tabel_mahasiswa GROUP BY jenis_pembiayaan");
$avgUkt = [];
while ($r = $qAvgUkt->fetch_assoc()) {
    $avgUkt[$r['jenis_pembiayaan']] = (float)$r['avg_ukt'];
}

// Distribusi semester
$qSemester = $koneksi->query("SELECT semester, COUNT(*) as jumlah FROM tabel_mahasiswa GROUP BY semester ORDER BY semester");
$semesterLabels = [];
$semesterData = [];
while ($r = $qSemester->fetch_assoc()) {
    $semesterLabels[] = 'Semester ' . $r['semester'];
    $semesterData[] = (int)$r['jumlah'];
}

// Set page info
$pageTitle = 'Dashboard';
$pageSubtitle = 'Ringkasan Data Registrasi Pembayaran UKT Mahasiswa';

include __DIR__ . '/includes/header.php';
?>

<!-- =====================================================
     KARTU STATISTIK
     ===================================================== -->
<div class="row g-3 mb-4">
    <!-- Total Mahasiswa -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card card-total animate-fade-in-up animate-delay-1">
            <div class="card-body">
                <div class="stat-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="stat-value" data-count="<?= $totalMahasiswa ?>"><?= $totalMahasiswa ?></div>
                <div class="stat-label">Total Mahasiswa</div>
            </div>
        </div>
    </div>
    <!-- Mandiri -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card card-mandiri animate-fade-in-up animate-delay-2">
            <div class="card-body">
                <div class="stat-icon">
                    <i class="bi bi-person-badge-fill"></i>
                </div>
                <div class="stat-value" data-count="<?= $stats['Mandiri'] ?>"><?= $stats['Mandiri'] ?></div>
                <div class="stat-label">Mahasiswa Mandiri</div>
            </div>
        </div>
    </div>
    <!-- Bidikmisi -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card card-bidikmisi animate-fade-in-up animate-delay-3">
            <div class="card-body">
                <div class="stat-icon">
                    <i class="bi bi-person-heart"></i>
                </div>
                <div class="stat-value" data-count="<?= $stats['Bidikmisi'] ?>"><?= $stats['Bidikmisi'] ?></div>
                <div class="stat-label">Mahasiswa Bidikmisi</div>
            </div>
        </div>
    </div>
    <!-- Prestasi -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card card-prestasi animate-fade-in-up animate-delay-4">
            <div class="card-body">
                <div class="stat-icon">
                    <i class="bi bi-award-fill"></i>
                </div>
                <div class="stat-value" data-count="<?= $stats['Prestasi'] ?>"><?= $stats['Prestasi'] ?></div>
                <div class="stat-label">Mahasiswa Prestasi</div>
            </div>
        </div>
    </div>
</div>

<!-- =====================================================
     RINGKASAN TAGIHAN
     ===================================================== -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="content-card h-100">
            <div class="card-body text-center">
                <i class="bi bi-cash-coin text-primary" style="font-size: 2rem;"></i>
                <h6 class="mt-2 mb-1 fw-bold">Total Tagihan Mandiri</h6>
                <h4 class="text-primary fw-bold">Rp <?= number_format($totalTagihanMandiri, 0, ',', '.') ?></h4>
                <small class="text-muted">Formula: UKT + Rp100.000</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="content-card h-100">
            <div class="card-body text-center">
                <i class="bi bi-heart-fill text-success" style="font-size: 2rem;"></i>
                <h6 class="mt-2 mb-1 fw-bold">Total Tagihan Bidikmisi</h6>
                <h4 class="text-success fw-bold">Rp <?= number_format($totalTagihanBidikmisi, 0, ',', '.') ?></h4>
                <small class="text-muted">Gratis (KIP-Kuliah)</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="content-card h-100">
            <div class="card-body text-center">
                <i class="bi bi-trophy-fill text-warning" style="font-size: 2rem;"></i>
                <h6 class="mt-2 mb-1 fw-bold">Total Tagihan Prestasi</h6>
                <h4 class="text-warning fw-bold">Rp <?= number_format($totalTagihanPrestasi, 0, ',', '.') ?></h4>
                <small class="text-muted">Formula: UKT × 25%</small>
            </div>
        </div>
    </div>
</div>

<!-- =====================================================
     GRAFIK CHART.JS
     ===================================================== -->
<div class="row g-3 mb-4" id="grafik">
    <!-- Grafik 1: Pie Chart - Distribusi Jenis Pembiayaan -->
    <div class="col-lg-6">
        <div class="content-card h-100">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="bi bi-pie-chart-fill"></i>
                    Distribusi Jenis Pembiayaan
                </h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="chartDistribusi"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik 2: Bar Chart - Distribusi per Semester -->
    <div class="col-lg-6">
        <div class="content-card h-100">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="bi bi-bar-chart-fill"></i>
                    Distribusi Mahasiswa per Semester
                </h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="chartSemester"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Grafik 3: Bar Chart - Perbandingan Rata-rata UKT & Total Tagihan -->
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="content-card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="bi bi-graph-up"></i>
                    Perbandingan Rata-rata UKT vs Total Tagihan Semester
                </h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="chartPerbandingan"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- =====================================================
     CHART.JS SCRIPTS
     ===================================================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Warna konsisten
    const colors = {
        mandiri:   { bg: 'rgba(26, 86, 219, 0.8)',  border: '#1a56db'  },
        bidikmisi: { bg: 'rgba(5, 150, 105, 0.8)',   border: '#059669'  },
        prestasi:  { bg: 'rgba(217, 119, 6, 0.8)',    border: '#d97706'  }
    };

    // ----- CHART 1: Pie/Doughnut - Distribusi Jenis -----
    new Chart(document.getElementById('chartDistribusi'), {
        type: 'doughnut',
        data: {
            labels: ['Mandiri', 'Bidikmisi', 'Prestasi'],
            datasets: [{
                data: [<?= $stats['Mandiri'] ?>, <?= $stats['Bidikmisi'] ?>, <?= $stats['Prestasi'] ?>],
                backgroundColor: [colors.mandiri.bg, colors.bidikmisi.bg, colors.prestasi.bg],
                borderColor: [colors.mandiri.border, colors.bidikmisi.border, colors.prestasi.border],
                borderWidth: 2,
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { font: { family: 'Inter', size: 13 }, padding: 20 }
                }
            },
            cutout: '55%'
        }
    });

    // ----- CHART 2: Bar - Distribusi Semester -----
    new Chart(document.getElementById('chartSemester'), {
        type: 'bar',
        data: {
            labels: <?= json_encode($semesterLabels) ?>,
            datasets: [{
                label: 'Jumlah Mahasiswa',
                data: <?= json_encode($semesterData) ?>,
                backgroundColor: 'rgba(26, 86, 219, 0.7)',
                borderColor: '#1a56db',
                borderWidth: 1,
                borderRadius: 8,
                barPercentage: 0.6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, font: { family: 'Inter' } },
                    grid: { color: 'rgba(0,0,0,0.05)' }
                },
                x: {
                    ticks: { font: { family: 'Inter' } },
                    grid: { display: false }
                }
            }
        }
    });

    // ----- CHART 3: Grouped Bar - Rata-rata UKT vs Total Tagihan -----
    new Chart(document.getElementById('chartPerbandingan'), {
        type: 'bar',
        data: {
            labels: ['Mandiri', 'Bidikmisi', 'Prestasi'],
            datasets: [
                {
                    label: 'Rata-rata Tarif UKT (Rp)',
                    data: [
                        <?= $avgUkt['Mandiri'] ?? 0 ?>,
                        <?= $avgUkt['Bidikmisi'] ?? 0 ?>,
                        <?= $avgUkt['Prestasi'] ?? 0 ?>
                    ],
                    backgroundColor: 'rgba(30, 58, 138, 0.7)',
                    borderColor: '#1e3a8a',
                    borderWidth: 1,
                    borderRadius: 6,
                    barPercentage: 0.5
                },
                {
                    label: 'Total Tagihan Semester (Rp)',
                    data: [
                        <?= $totalTagihanMandiri ?>,
                        <?= $totalTagihanBidikmisi ?>,
                        <?= $totalTagihanPrestasi ?>
                    ],
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                    borderColor: '#3b82f6',
                    borderWidth: 1,
                    borderRadius: 6,
                    barPercentage: 0.5
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { font: { family: 'Inter', size: 12 }, padding: 20 }
                },
                tooltip: {
                    callbacks: {
                        label: function(ctx) {
                            return ctx.dataset.label + ': Rp ' + ctx.raw.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: { family: 'Inter' },
                        callback: function(value) { return 'Rp ' + value.toLocaleString('id-ID'); }
                    },
                    grid: { color: 'rgba(0,0,0,0.05)' }
                },
                x: {
                    ticks: { font: { family: 'Inter', weight: '600' } },
                    grid: { display: false }
                }
            }
        }
    });
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
