// ============================================================
// File   : script.js
// Lokasi : assets/js/script.js
// Fungsi : Custom JavaScript untuk interaktivitas UI
// ============================================================

document.addEventListener('DOMContentLoaded', function () {
    // =====================================================
    // SIDEBAR TOGGLE (Mobile)
    // =====================================================
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function () {
            sidebar.classList.toggle('show');
            sidebarOverlay.classList.toggle('show');
        });
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', function () {
            sidebar.classList.remove('show');
            sidebarOverlay.classList.remove('show');
        });
    }

    // =====================================================
    // ACTIVE NAV LINK HIGHLIGHT
    // =====================================================
    const currentPage = window.location.pathname.split('/').pop() || 'index.php';
    const navLinks = document.querySelectorAll('.sidebar-menu .nav-link');

    navLinks.forEach(function (link) {
        const href = link.getAttribute('href');
        if (href === currentPage) {
            link.classList.add('active');
        }
    });

    // =====================================================
    // ANIMATE STAT NUMBERS (Count Up)
    // =====================================================
    const statValues = document.querySelectorAll('.stat-value[data-count]');
    
    statValues.forEach(function (el) {
        const target = parseInt(el.getAttribute('data-count'));
        let current = 0;
        const increment = Math.ceil(target / 30);
        const timer = setInterval(function () {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            el.textContent = current;
        }, 40);
    });

    // =====================================================
    // TABLE ROW CLICK HIGHLIGHT
    // =====================================================
    const tableRows = document.querySelectorAll('.data-table tbody tr');
    
    tableRows.forEach(function (row) {
        row.addEventListener('click', function () {
            tableRows.forEach(function (r) { r.classList.remove('table-active'); });
            this.classList.add('table-active');
        });
    });
});
