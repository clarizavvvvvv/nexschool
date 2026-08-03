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
    <title>Konseling - NexSchool</title>
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
                    <h3>💚 Konseling & Kesehatan Mental</h3>
                </div>
                <div class="topbar-right">
                    <span style="color:#888;"><?= date('d M Y') ?></span>
                    <div class="user-badge">
                        <img src="assets/default.png" alt="Foto" onerror="this.style.display='none'">
                        <span><?= $_SESSION['user'] ?></span>
                    </div>
                </div>
            </div>
            
            <!-- CURHAT ANONIM -->
            <div class="page-card konseling-box">
                <h4>🤫 Curhat Anonim</h4>
                <p style="font-size:14px;color:#555;margin-bottom:8px;">Tuliskan keluhan atau perasaanmu. Identitasmu akan dirahasiakan.</p>
                <textarea id="curhatText" placeholder="Tulis ceritamu di sini..." style="width:100%;padding:12px;border:2px solid #d5dce6;border-radius:8px;min-height:80px;font-family:inherit;resize:vertical;"></textarea>
                <button class="btn-primary" id="kirimCurhat" style="margin-top:10px;">Kirim (Anonim)</button>
            </div>
            
            <!-- JADWALKAN SESI -->
            <div class="page-card">
                <h4>📅 Jadwalkan Sesi Konseling</h4>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:10px;">
                    <div>
                        <label style="font-size:13px;font-weight:600;">Pilih Guru BK</label>
                        <select id="guruBK" style="width:100%;padding:10px;border:2px solid #e0e7ef;border-radius:8px;">
                            <option value="Bu Ani - BK">Bu Ani - BK</option>
                            <option value="Pak Budi - BK">Pak Budi - BK</option>
                            <option value="Bu Cici - Konselor">Bu Cici - Konselor</option>
                        </select>
                    </div>
                    <div>
                        <label style="font-size:13px;font-weight:600;">Tanggal & Jam</label>
                        <input type="datetime-local" id="jadwalKonseling" style="width:100%;padding:10px;border:2px solid #e0e7ef;border-radius:8px;">
                    </div>
                </div>
                <button class="btn-primary" id="ajukanJadwal" style="margin-top:12px;">Ajukan Jadwal</button>
            </div>
            
            <!-- RIWAYAT -->
            <div class="page-card">
                <h4>📋 Riwayat Konseling</h4>
                <ul style="list-style:none;padding:0;margin-top:8px;">
                    <li style="padding:10px 0;border-bottom:1px solid #f0f4f8;">
                        <strong>📌 Sesi dengan Bu Ani</strong> 
                        <span style="color:#2d6a9f;font-size:13px;">● Selesai</span>
                        <br><small style="color:#888;">12 Jan 2026, 14:00 - Konsultasi karir</small>
                    </li>
                    <li style="padding:10px 0;border-bottom:1px solid #f0f4f8;">
                        <strong>📌 Sesi dengan Pak Budi</strong>
                        <span style="color:#f5a623;font-size:13px;">● Dijadwalkan</span>
                        <br><small style="color:#888;">20 Jan 2026, 15:30 - Kendala belajar</small>
                    </li>
                    <li style="padding:10px 0;">
                        <strong>📌 Curhat Anonim</strong>
                        <span style="color:#888;font-size:13px;">● Terkirim</span>
                        <br><small style="color:#888;">5 Jan 2026, 20:15 - Balasan dari konselor</small>
                    </li>
                </ul>
            </div>
            
            <!-- PENGINGAT -->
            <div class="page-card" style="background:#e8f5e9;border-left:4px solid #4caf50;">
                <h4>🌱 Tips Kesehatan Mental</h4>
                <p style="font-size:14px;color:#555;">"Jangan ragu untuk berbagi. Setiap masalah layak didengar."</p>
                <small style="color:#888;">— Tim BK NexSchool</small>
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
    
    // ===== KIRIM CURHAT =====
    document.addEventListener('DOMContentLoaded', function() {
        const kirimCurhat = document.getElementById('kirimCurhat');
        const curhatText = document.getElementById('curhatText');
        
        if(kirimCurhat && curhatText) {
            kirimCurhat.addEventListener('click', function() {
                const msg = curhatText.value.trim();
                if(msg) {
                    if(confirm('Kirim curhat secara anonim? Pesan ini akan dijaga kerahasiaannya.')) {
                        alert('✅ Curhat berhasil dikirim! Konselor akan merespon dalam 1x24 jam.');
                        curhatText.value = '';
                    }
                } else {
                    alert('⚠️ Silakan tulis curhatmu terlebih dahulu.');
                }
            });
        }
        
        // ===== AJUKAN JADWAL =====
        const ajukanJadwal = document.getElementById('ajukanJadwal');
        const guruBK = document.getElementById('guruBK');
        const jadwalKonseling = document.getElementById('jadwalKonseling');
        
        if(ajukanJadwal && guruBK && jadwalKonseling) {
            ajukanJadwal.addEventListener('click', function() {
                const guru = guruBK.value;
                const datetime = jadwalKonseling.value;
                
                if(!datetime) {
                    alert('⚠️ Silakan pilih tanggal dan jam terlebih dahulu.');
                    return;
                }
                
                const tanggal = new Date(datetime).toLocaleString('id-ID', {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
                
                if(confirm(`Jadwalkan sesi dengan ${guru} pada ${tanggal}?`)) {
                    alert('✅ Jadwal konseling berhasil diajukan! Tunggu konfirmasi dari guru BK.');
                    jadwalKonseling.value = '';
                }
            });
        }
    });
    </script>
    <script src="js/script.js"></script>
</body>
</html>