<?php
// ============================================================
// File   : header.php
// Lokasi : includes/header.php
// Fungsi : Komponen header HTML reusable (head + opening body)
// ============================================================

// Default page title jika belum di-set
if (!isset($pageTitle)) $pageTitle = 'Dashboard';
if (!isset($pageSubtitle)) $pageSubtitle = 'Sistem Informasi Akademik';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Informasi Registrasi Pembayaran Kuliah - UAS PBO TRPL 1A Afif Nur Faizin">
    <title><?= htmlspecialchars($pageTitle) ?> | SIAKAD UKT - UAS PBO</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<div class="app-wrapper">
    <?php include __DIR__ . '/sidebar.php'; ?>

    <div class="main-content">
        <!-- Top Navbar -->
        <header class="top-navbar">
            <div>
                <button class="btn-sidebar-toggle" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
                <div class="page-title">
                    <?= htmlspecialchars($pageTitle) ?>
                    <small><?= htmlspecialchars($pageSubtitle) ?></small>
                </div>
            </div>
            <div class="navbar-actions">
                <span class="text-muted" style="font-size: 0.8rem;">
                    <i class="bi bi-calendar3 me-1"></i><?= date('d F Y') ?>
                </span>
            </div>
        </header>

        <div class="content-area">
