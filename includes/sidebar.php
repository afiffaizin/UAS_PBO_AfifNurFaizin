<?php
// ============================================================
// File   : sidebar.php
// Lokasi : includes/sidebar.php
// Fungsi : Komponen sidebar navigasi reusable
// ============================================================

// Deteksi halaman aktif
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!-- Sidebar Overlay (Mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<nav class="sidebar" id="sidebar">
    <!-- Brand -->
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="bi bi-mortarboard-fill"></i>
        </div>
        <div class="brand-text">
            SIAKAD UKT
            <small>Sistem Informasi Akademik</small>
        </div>
    </div>

    <!-- Menu -->
    <div class="sidebar-menu">
        <!-- Menu Utama -->
        <div class="menu-label">Menu Utama</div>

        <a href="index.php" class="nav-link <?= ($currentPage == 'index.php') ? 'active' : '' ?>">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>

        <!-- Data Mahasiswa -->
        <div class="menu-label">Data Mahasiswa</div>

        <a href="mandiri.php" class="nav-link <?= ($currentPage == 'mandiri.php') ? 'active' : '' ?>">
            <i class="bi bi-person-badge"></i>
            <span>Mahasiswa Mandiri</span>
            <span class="badge bg-primary rounded-pill" id="badge-mandiri"></span>
        </a>

        <a href="bidikmisi.php" class="nav-link <?= ($currentPage == 'bidikmisi.php') ? 'active' : '' ?>">
            <i class="bi bi-person-heart"></i>
            <span>Mahasiswa Bidikmisi</span>
            <span class="badge bg-success rounded-pill" id="badge-bidikmisi"></span>
        </a>

        <a href="prestasi.php" class="nav-link <?= ($currentPage == 'prestasi.php') ? 'active' : '' ?>">
            <i class="bi bi-award"></i>
            <span>Mahasiswa Prestasi</span>
            <span class="badge bg-warning rounded-pill" id="badge-prestasi"></span>
        </a>

        <!-- Laporan -->
        <div class="menu-label">Informasi</div>

        <a href="index.php#grafik" class="nav-link">
            <i class="bi bi-bar-chart-line"></i>
            <span>Grafik & Statistik</span>
        </a>
    </div>

    <!-- Footer -->
    <div class="sidebar-footer">
        <i class="bi bi-code-slash"></i> UAS PBO &mdash; TRPL 1A
        <br>Afif Nur Faizin &copy; <?= date('Y') ?>
    </div>
</nav>
