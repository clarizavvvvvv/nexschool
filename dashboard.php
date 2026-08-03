<?php
session_start();

// Cek apakah guest
$isGuest = isset($_GET['guest']) || isset($_SESSION['guest']);

if(!isset($_SESSION['user']) && !$isGuest) {
    header("Location: index.php");
    exit();
}

// Jika guest, set session guest
if($isGuest && !isset($_SESSION['user'])) {
    $_SESSION['user'] = "Tamu NexSchool";
    $_SESSION['nis'] = "GUEST001";
    $_SESSION['kelas'] = "-";
    $_SESSION['foto'] = "default.png";
    $_SESSION['guest'] = true;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - NexSchool</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="app-container">
        <?php include 'partials/sidebar.php'; ?>
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        
        <div class="main-content">
            <div class="topbar">
                <div style="display:flex;align-items:center;gap:12px;">
                    <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
                    <h3>📚 Beranda</h3>
                </div>
                <div class="topbar-right">
                    <span style="color:#888;"><?= date('l, d M Y') ?></span>
                    <div class="user-badge">
                        <img src="assets/default.png" alt="Foto" onerror="this.style.display='none'">
                        <span><?= $_SESSION['user'] ?></span>
                        <?php if(isset($_SESSION['guest'])): ?>
                            <span style="background:#f5a623;color:#fff;font-size:10px;padding:2px 8px;border-radius:20px;">Tamu</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- SELAMAT DATANG -->
            <div class="page-card" style="background:linear-gradient(135deg,#1a3a5c,#2d6a9f);color:#fff;border:none;">
                <h3>Selamat Datang, <?= $_SESSION['user'] ?>! 👋</h3>
                <p style="opacity:0.9;">NIS: <?= $_SESSION['nis'] ?> | Kelas: <?= $_SESSION['kelas'] ?></p>
                <p style="margin-top:8px;font-size:14px;opacity:0.8;">Yuk, mulai aktivitas belajarmu hari ini!</p>
            </div>
            
            <!-- GRID FITUR UTAMA -->
            <div class="card-grid">
                <div class="card" onclick="location.href='diskusi.php'">
                    <div class="card-icon">🗨️</div>
                    <h4>Diskusi & Belajar Kelompok</h4>
                    <p>Ruang obrolan + whiteboard bersama untuk kerja kelompok.</p>
                    <span class="badge">5 grup aktif</span>
                </div>
                
                <div class="card" onclick="location.href='ekstrakurikuler.php'">
                    <div class="card-icon">🏫</div>
                    <h4>Portal Ekstrakurikuler</h4>
                    <p>Daftar klub, lihat jadwal, & presensi kegiatan sekolah.</p>
                    <span class="badge">3 klub diikuti</span>
                </div>
                
                <div class="card" onclick="location.href='konseling.php'">
                    <div class="card-icon">💚</div>
                    <h4>Konseling & BK Virtual</h4>
                    <p>Curhat privat & jadwalkan sesi konseling dengan guru BK.</p>
                    <span class="badge">2 sesi tersedia</span>
                </div>
            </div>
            
            <!-- AKTIVITAS TERAKHIR -->
            <div class="page-card">
                <h4>📌 Aktivitas Terakhir</h4>
                <ul style="list-style:none;padding:0;">
                    <li style="padding:8px 0;border-bottom:1px solid #f0f4f8;">✔️ Bergabung di grup "Matematika XII" - 10 menit lalu</li>
                    <li style="padding:8px 0;border-bottom:1px solid #f0f4f8;">✔️ Presensi hadir di "Basket" - 2 jam lalu</li>
                    <li style="padding:8px 0;">✔️ Sesi konseling dengan Bu Ani - kemarin</li>
                </ul>
            </div>
        </div>
    </div>
    
    <script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        if(sidebar && overlay) {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        }
    }
    </script>
    <script src="js/script.js"></script>
</body>
</html>