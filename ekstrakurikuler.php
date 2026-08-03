<?php
session_start();
if(!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ekstrakurikuler - NexSchool</title>
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
                    <h3>🏫 Portal Ekstrakurikuler</h3>
                </div>
                <div class="topbar-right">
                    <span style="color:#888;"><?= date('d M Y') ?></span>
                    <div class="user-badge">
                        <img src="assets/default.png" alt="Foto" onerror="this.style.display='none'">
                        <span><?= $_SESSION['user'] ?></span>
                    </div>
                </div>
            </div>
            
            <!-- STATISTIK EKSTRA -->
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:12px;margin-bottom:20px;">
                <div style="background:#fff;border-radius:12px;padding:16px;text-align:center;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
                    <div style="font-size:28px;">🏆</div>
                    <div style="font-size:20px;font-weight:700;">3</div>
                    <small style="color:#888;">Klub Diikuti</small>
                </div>
                <div style="background:#fff;border-radius:12px;padding:16px;text-align:center;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
                    <div style="font-size:28px;">📅</div>
                    <div style="font-size:20px;font-weight:700;">2</div>
                    <small style="color:#888;">Latihan Hari Ini</small>
                </div>
                <div style="background:#fff;border-radius:12px;padding:16px;text-align:center;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
                    <div style="font-size:28px;">✅</div>
                    <div style="font-size:20px;font-weight:700;">8</div>
                    <small style="color:#888;">Total Kehadiran</small>
                </div>
            </div>
            
            <!-- JADWAL HARI INI -->
            <div class="page-card" style="border-left:4px solid #2d6a9f;">
                <h4>📅 Jadwal Latihan Hari Ini</h4>
                <ul style="list-style:none;padding:0;margin-top:8px;">
                    <li style="padding:10px 0;border-bottom:1px solid #f0f4f8;display:flex;justify-content:space-between;align-items:center;">
                        <div>
                            <strong>🏀 Basket</strong>
                            <br><small style="color:#888;">15:00 - 17:00 (GOR)</small>
                        </div>
                        <button class="btn-primary" style="font-size:12px;padding:6px 16px;">Hadir</button>
                    </li>
                    <li style="padding:10px 0;border-bottom:1px solid #f0f4f8;display:flex;justify-content:space-between;align-items:center;">
                        <div>
                            <strong>🎵 Paduan Suara</strong>
                            <br><small style="color:#888;">16:30 - 18:00 (Aula)</small>
                        </div>
                        <button class="btn-secondary" style="font-size:12px;padding:6px 16px;">Belum Mulai</button>
                    </li>
                    <li style="padding:10px 0;display:flex;justify-content:space-between;align-items:center;">
                        <div>
                            <strong>💻 Coding Club</strong>
                            <br><small style="color:#888;">17:00 - 19:00 (Lab Komputer)</small>
                        </div>
                        <button class="btn-secondary" style="font-size:12px;padding:6px 16px;">Belum Mulai</button>
                    </li>
                </ul>
            </div>
            
            <!-- DAFTAR KLUB -->
            <div class="page-card">
                <h4>📋 Daftar Klub / UKM</h4>
                <div class="ekstra-list" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-top:12px;">
                    <div class="ekstra-item" style="background:#f7f9fc;padding:20px;border-radius:12px;text-align:center;">
                        <div style="font-size:40px;">🏀</div>
                        <h5 style="margin:8px 0 4px;">Basket</h5>
                        <p style="font-size:13px;color:#888;">Senin & Rabu</p>
                        <p style="font-size:12px;color:#555;margin:4px 0 8px;">15:00 - 17:00</p>
                        <button class="btn-secondary" style="font-size:12px;width:100%;padding:8px;" disabled>✅ Sudah Gabung</button>
                    </div>
                    
                    <div class="ekstra-item" style="background:#f7f9fc;padding:20px;border-radius:12px;text-align:center;">
                        <div style="font-size:40px;">🎵</div>
                        <h5 style="margin:8px 0 4px;">Paduan Suara</h5>
                        <p style="font-size:13px;color:#888;">Selasa & Kamis</p>
                        <p style="font-size:12px;color:#555;margin:4px 0 8px;">16:30 - 18:00</p>
                        <button class="btn-primary" style="font-size:12px;width:100%;padding:8px;">Daftar</button>
                    </div>
                    
                    <div class="ekstra-item" style="background:#f7f9fc;padding:20px;border-radius:12px;text-align:center;">
                        <div style="font-size:40px;">💻</div>
                        <h5 style="margin:8px 0 4px;">Coding Club</h5>
                        <p style="font-size:13px;color:#888;">Jumat</p>
                        <p style="font-size:12px;color:#555;margin:4px 0 8px;">17:00 - 19:00</p>
                        <button class="btn-primary" style="font-size:12px;width:100%;padding:8px;">Daftar</button>
                    </div>
                    
                    <div class="ekstra-item" style="background:#f7f9fc;padding:20px;border-radius:12px;text-align:center;">
                        <div style="font-size:40px;">🎭</div>
                        <h5 style="margin:8px 0 4px;">Teater</h5>
                        <p style="font-size:13px;color:#888;">Sabtu</p>
                        <p style="font-size:12px;color:#555;margin:4px 0 8px;">13:00 - 15:00</p>
                        <button class="btn-primary" style="font-size:12px;width:100%;padding:8px;">Daftar</button>
                    </div>
                    
                    <div class="ekstra-item" style="background:#f7f9fc;padding:20px;border-radius:12px;text-align:center;">
                        <div style="font-size:40px;">📸</div>
                        <h5 style="margin:8px 0 4px;">Fotografi</h5>
                        <p style="font-size:13px;color:#888;">Kamis</p>
                        <p style="font-size:12px;color:#555;margin:4px 0 8px;">14:00 - 16:00</p>
                        <button class="btn-primary" style="font-size:12px;width:100%;padding:8px;">Daftar</button>
                    </div>
                </div>
            </div>
            
            <!-- PRESENSI -->
            <div class="page-card">
                <h4>✅ Presensi Acara Sekarang</h4>
                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:12px;margin-top:8px;">
                    <div style="background:#f7f9fc;padding:16px 20px;border-radius:10px;display:flex;justify-content:space-between;align-items:center;">
                        <div>
                            <strong>🏀 Latihan Basket</strong>
                            <br><small style="color:#888;">Sedang berlangsung</small>
                        </div>
                        <button class="btn-primary" style="font-size:12px;padding:6px 16px;">✅ Hadir</button>
                    </div>
                    <div style="background:#f7f9fc;padding:16px 20px;border-radius:10px;display:flex;justify-content:space-between;align-items:center;">
                        <div>
                            <strong>🎵 Latihan Paduan Suara</strong>
                            <br><small style="color:#888;">Mulai 16:30</small>
                        </div>
                        <button class="btn-secondary" style="font-size:12px;padding:6px 16px;" disabled>⏳ Belum Mulai</button>
                    </div>
                </div>
            </div>
            
            <!-- RIWAYAT -->
            <div class="page-card">
                <h4>📜 Riwayat Keikutsertaan</h4>
                <ul style="list-style:none;padding:0;margin-top:8px;">
                    <li style="padding:10px 0;border-bottom:1px solid #f0f4f8;display:flex;justify-content:space-between;">
                        <div>
                            <strong>🏀 Basket</strong>
                            <br><small style="color:#888;">12 Jan 2026</small>
                        </div>
                        <span style="color:#28a745;font-size:13px;">✅ Hadir</span>
                    </li>
                    <li style="padding:10px 0;border-bottom:1px solid #f0f4f8;display:flex;justify-content:space-between;">
                        <div>
                            <strong>🎵 Paduan Suara</strong>
                            <br><small style="color:#888;">10 Jan 2026</small>
                        </div>
                        <span style="color:#28a745;font-size:13px;">✅ Hadir</span>
                    </li>
                    <li style="padding:10px 0;display:flex;justify-content:space-between;">
                        <div>
                            <strong>💻 Coding Club</strong>
                            <br><small style="color:#888;">8 Jan 2026</small>
                        </div>
                        <span style="color:#dc3545;font-size:13px;">❌ Tidak Hadir</span>
                    </li>
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