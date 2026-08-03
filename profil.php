<?php
session_start();
if(!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$success = '';
$error = '';
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $nama = trim($_POST['nama'] ?? '');
    $kelas = trim($_POST['kelas'] ?? '');
    
    if(empty($nama) || empty($kelas)) {
        $error = "Nama dan Kelas tidak boleh kosong!";
    } else {
        $_SESSION['user'] = $nama;
        $_SESSION['kelas'] = $kelas;
        $success = "✅ Profil berhasil diperbarui!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - NexSchool</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Mode Gelap */
        body.dark-mode {
            background: #1a1a2e;
            color: #eee;
        }
        body.dark-mode .page-card,
        body.dark-mode .profile-header,
        body.dark-mode .stat-item,
        body.dark-mode .ekstra-item {
            background: #2d2d44 !important;
            color: #eee !important;
        }
        body.dark-mode .topbar {
            border-bottom-color: #444;
        }
        body.dark-mode .chat-item {
            background: #2d2d44 !important;
        }
        body.dark-mode input,
        body.dark-mode select,
        body.dark-mode textarea {
            background: #3d3d5c;
            color: #eee;
            border-color: #555 !important;
        }
        body.dark-mode .btn-secondary {
            background: #3d3d5c;
            color: #eee;
        }
        body.dark-mode .user-badge {
            background: #2d2d44;
        }
        body.dark-mode .login-box {
            background: #2d2d44;
        }
        body.dark-mode .login-box h1 {
            color: #eee;
        }
    </style>
</head>
<body id="appBody">
    <div class="app-container">
        <?php include 'partials/sidebar.php'; ?>
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        
        <div class="main-content">
            <div class="topbar">
                <div style="display:flex;align-items:center;gap:12px;">
                    <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
                    <h3>👤 Profil Saya</h3>
                </div>
                <div class="topbar-right">
                    <span style="color:#888;"><?= date('d M Y') ?></span>
                    <div class="user-badge">
                        <img src="assets/default.png" alt="Foto" onerror="this.style.display='none'">
                        <span><?= $_SESSION['user'] ?></span>
                    </div>
                </div>
            </div>
            
            <?php if($success): ?>
                <div style="background:#d4edda;color:#155724;padding:12px 16px;border-radius:8px;margin-bottom:16px;border:1px solid #c3e6cb;">
                    <?= $success ?>
                </div>
            <?php endif; ?>
            
            <?php if($error): ?>
                <div style="background:#f8d7da;color:#721c24;padding:12px 16px;border-radius:8px;margin-bottom:16px;border:1px solid #f5c6cb;">
                    <?= $error ?>
                </div>
            <?php endif; ?>
            
            <!-- PROFIL HEADER -->
            <div class="profile-header">
                <div style="position:relative;">
                    <img src="assets/default.png" alt="Foto Profil" style="width:100px;height:100px;border-radius:50%;object-fit:cover;background:#2d6a9f;" onerror="this.style.display='none'">
                    <button class="btn-secondary" id="gantiFoto" style="font-size:12px;margin-top:8px;display:block;width:100%;">Ganti Foto</button>
                </div>
                <div style="flex:1;">
                    <h3><?= $_SESSION['user'] ?></h3>
                    <p style="color:#888;margin:4px 0;">
                        <strong>NIS:</strong> <?= $_SESSION['nis'] ?> 
                        | <strong>Kelas:</strong> <?= $_SESSION['kelas'] ?>
                    </p>
                    <p style="color:#888;font-size:14px;">📧 <?= strtolower(str_replace(' ', '', $_SESSION['user'])) ?>@nexschool.id</p>
                    <p style="color:#888;font-size:13px;margin-top:4px;">
                        <span style="background:#e8edf3;padding:2px 12px;border-radius:20px;font-size:12px;">
                            🟢 Online
                        </span>
                    </p>
                </div>
            </div>
            
            <!-- STATISTIK -->
            <div style="margin:24px 0;">
                <h4 style="margin-bottom:12px;">📊 Statistik Aktivitas</h4>
                <div class="profile-stats">
                    <div class="stat-item">
                        <div class="number">12</div>
                        <small>Tugas Selesai</small>
                    </div>
                    <div class="stat-item">
                        <div class="number">8</div>
                        <small>Kehadiran Ekstra</small>
                    </div>
                    <div class="stat-item">
                        <div class="number">3</div>
                        <small>Sesi Konseling</small>
                    </div>
                    <div class="stat-item">
                        <div class="number">5</div>
                        <small>Grup Diskusi</small>
                    </div>
                </div>
            </div>
            
            <!-- EDIT PROFIL -->
            <div class="page-card">
                <h4>✏️ Edit Profil</h4>
                <form method="POST" action="" onsubmit="return validateForm()">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label style="font-size:13px;font-weight:600;display:block;margin-bottom:4px;">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" value="<?= htmlspecialchars($_SESSION['user']) ?>" 
                                   style="width:100%;padding:10px 14px;border:2px solid #e0e7ef;border-radius:8px;font-size:14px;">
                        </div>
                        <div>
                            <label style="font-size:13px;font-weight:600;display:block;margin-bottom:4px;">Kelas</label>
                            <input type="text" name="kelas" id="kelas" value="<?= htmlspecialchars($_SESSION['kelas']) ?>"
                                   style="width:100%;padding:10px 14px;border:2px solid #e0e7ef;border-radius:8px;font-size:14px;">
                        </div>
                    </div>
                    <button type="submit" name="update_profile" class="btn-primary" style="margin-top:16px;">
                        💾 Simpan Perubahan
                    </button>
                </form>
            </div>
            
            <!-- PENGATURAN -->
            <div class="page-card">
                <h4>⚙️ Pengaturan</h4>
                <div style="display:flex;flex-direction:column;gap:12px;">
                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;padding:8px 0;border-bottom:1px solid #f0f4f8;">
                        <input type="checkbox" checked style="width:18px;height:18px;"> 
                        Notifikasi Aktivitas
                    </label>
                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;padding:8px 0;border-bottom:1px solid #f0f4f8;">
                        <input type="checkbox" id="modeGelap" style="width:18px;height:18px;"> 
                        🌙 Mode Gelap
                    </label>
                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;padding:8px 0;border-bottom:1px solid #f0f4f8;">
                        <input type="checkbox" checked style="width:18px;height:18px;"> 
                        Notifikasi Konseling
                    </label>
                    <button class="btn-secondary" id="gantiPassword" style="margin-top:8px;width:fit-content;padding:10px 24px;cursor:pointer;">
                        🔑 Ganti Password
                    </button>
                </div>
            </div>
            
            <!-- AKTIVITAS TERAKHIR -->
            <div class="page-card">
                <h4>🕐 Aktivitas Terakhir</h4>
                <ul style="list-style:none;padding:0;margin-top:8px;">
                    <li style="padding:10px 0;border-bottom:1px solid #f0f4f8;display:flex;align-items:center;gap:8px;">
                        <span style="font-size:20px;">💬</span>
                        <div>
                            <strong>Bergabung di grup "Matematika XII"</strong>
                            <br><small style="color:#888;">10 menit lalu</small>
                        </div>
                    </li>
                    <li style="padding:10px 0;border-bottom:1px solid #f0f4f8;display:flex;align-items:center;gap:8px;">
                        <span style="font-size:20px;">🏀</span>
                        <div>
                            <strong>Presensi hadir di "Basket"</strong>
                            <br><small style="color:#888;">2 jam lalu</small>
                        </div>
                    </li>
                    <li style="padding:10px 0;display:flex;align-items:center;gap:8px;">
                        <span style="font-size:20px;">💚</span>
                        <div>
                            <strong>Sesi konseling dengan Bu Ani</strong>
                            <br><small style="color:#888;">Kemarin, 14:00</small>
                        </div>
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
    
    function validateForm() {
        const nama = document.getElementById('nama');
        const kelas = document.getElementById('kelas');
        if(!nama.value.trim() || !kelas.value.trim()) {
            alert('⚠️ Nama dan Kelas tidak boleh kosong!');
            return false;
        }
        return true;
    }
    
    // ===== MODE GELAP =====
    document.addEventListener('DOMContentLoaded', function() {
        const modeGelap = document.getElementById('modeGelap');
        const body = document.getElementById('appBody');
        
        // Cek localStorage
        if(localStorage.getItem('darkMode') === 'enabled') {
            body.classList.add('dark-mode');
            modeGelap.checked = true;
        }
        
        if(modeGelap) {
            modeGelap.addEventListener('change', function() {
                if(this.checked) {
                    body.classList.add('dark-mode');
                    localStorage.setItem('darkMode', 'enabled');
                } else {
                    body.classList.remove('dark-mode');
                    localStorage.setItem('darkMode', 'disabled');
                }
            });
        }
        
        // ===== GANTI FOTO =====
        const gantiFoto = document.getElementById('gantiFoto');
        if(gantiFoto) {
            gantiFoto.addEventListener('click', function() {
                alert('📸 Fitur ganti foto akan segera hadir!\n\nUntuk saat ini, gunakan foto default.');
            });
        }
        
        // ===== GANTI PASSWORD =====
        const gantiPassword = document.getElementById('gantiPassword');
        if(gantiPassword) {
            gantiPassword.addEventListener('click', function() {
                const oldPass = prompt('🔒 Masukkan Password Lama:');
                if(oldPass !== null) {
                    if(oldPass === '123456') {
                        const newPass = prompt('🔑 Masukkan Password Baru:');
                        if(newPass !== null && newPass.length >= 6) {
                            const confirmPass = prompt('✅ Konfirmasi Password Baru:');
                            if(confirmPass === newPass) {
                                alert('✅ Password berhasil diubah! Silakan login kembali.');
                                // Simulasi logout setelah ganti password
                                if(confirm('Ingin logout sekarang?')) {
                                    window.location.href = 'logout.php';
                                }
                            } else {
                                alert('❌ Password tidak sama!');
                            }
                        } else if(newPass !== null && newPass.length < 6) {
                            alert('❌ Password minimal 6 karakter!');
                        }
                    } else if(oldPass !== '') {
                        alert('❌ Password lama salah!');
                    }
                }
            });
        }
    });
    </script>
    <script src="js/script.js"></script>
</body>
</html>