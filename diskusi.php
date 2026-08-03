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
    <title>Diskusi - NexSchool</title>
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
                    <h3>🗨️ Diskusi & Belajar Kelompok</h3>
                </div>
                <div class="topbar-right">
                    <span style="color:#888;"><?= date('d M Y') ?></span>
                    <div class="user-badge">
                        <img src="assets/default.png" alt="Foto" onerror="this.style.display='none'">
                        <span><?= $_SESSION['user'] ?></span>
                    </div>
                </div>
            </div>
            
            <!-- TAB NAVIGASI -->
            <div class="page-card">
                <div style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:16px;border-bottom:2px solid #f0f4f8;padding-bottom:12px;">
                    <button class="btn-primary tab-btn" data-tab="ruang" style="background:#2d6a9f;color:#fff;">Ruang Kelas</button>
                    <button class="btn-secondary tab-btn" data-tab="tugas" style="background:#e8edf3;">Tugas Kelompok</button>
                    <button class="btn-secondary tab-btn" data-tab="whiteboard" style="background:#e8edf3;">Whiteboard</button>
                </div>
                
                <!-- KONTEN TAB -->
                <div id="tabRuang" class="tab-content">
                    <div class="chat-area">
                        <div class="chat-list">
                            <h5>💬 Grup Aktif</h5>
                            <div class="chat-item" onclick="alert('Masuk ke grup Matematika XII')">
                                <div class="chat-name">📐 Matematika XII</div>
                                <div class="chat-preview">Ani: siapa yg udah selesai?</div>
                            </div>
                            <div class="chat-item" onclick="alert('Masuk ke grup Fisika XI')">
                                <div class="chat-name">🔬 Fisika XI</div>
                                <div class="chat-preview">Budi: coba cek file yg aku kirim</div>
                            </div>
                            <div class="chat-item" onclick="alert('Masuk ke grup Bahasa Inggris')">
                                <div class="chat-name">📖 Bahasa Inggris</div>
                                <div class="chat-preview">Cici: tugas dikumpul besok ya</div>
                            </div>
                        </div>
                        
                        <div class="chat-window">
                            <h5>📐 Matematika XII</h5>
                            <div class="message"><strong>Andi:</strong> ada yg tau no 5?</div>
                            <div class="message"><strong>Guru:</strong> coba lihat whiteboard ya</div>
                            
                            <div class="whiteboard-placeholder" onclick="alert('✏️ Whiteboard akan terbuka!')" style="cursor:pointer;">
                                ✏️ Klik untuk membuka Whiteboard bersama
                            </div>
                            
                            <div style="display:flex;gap:8px;margin-top:12px;">
                                <input type="text" id="chatInput" placeholder="Ketik pesan..." style="flex:1;padding:10px;border:2px solid #e0e7ef;border-radius:8px;">
                                <button class="btn-primary" id="kirimPesan">Kirim</button>
                                <button class="btn-secondary" onclick="alert('📎 Fitur lampirkan file')">📎</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="tabTugas" class="tab-content" style="display:none;">
                    <h4>📋 Tugas Kelompok</h4>
                    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:16px;margin-top:12px;">
                        <div style="background:#f7f9fc;padding:16px;border-radius:10px;border-left:4px solid #2d6a9f;cursor:pointer;" onclick="alert('📐 Membuka tugas Matematika')">
                            <h5>📐 Tugas Matematika</h5>
                            <p style="font-size:13px;color:#888;">Deadline: 20 Jan 2026</p>
                            <span style="background:#2d6a9f;color:#fff;padding:2px 12px;border-radius:20px;font-size:12px;">Kelompok 3</span>
                        </div>
                        <div style="background:#f7f9fc;padding:16px;border-radius:10px;border-left:4px solid #f5a623;cursor:pointer;" onclick="alert('🔬 Membuka tugas Fisika')">
                            <h5>🔬 Tugas Fisika</h5>
                            <p style="font-size:13px;color:#888;">Deadline: 22 Jan 2026</p>
                            <span style="background:#f5a623;color:#fff;padding:2px 12px;border-radius:20px;font-size:12px;">Kelompok 1</span>
                        </div>
                        <div style="background:#f7f9fc;padding:16px;border-radius:10px;border-left:4px solid #4caf50;cursor:pointer;" onclick="alert('📖 Membuka tugas Bahasa Inggris')">
                            <h5>📖 Tugas Bahasa Inggris</h5>
                            <p style="font-size:13px;color:#888;">Deadline: 25 Jan 2026</p>
                            <span style="background:#4caf50;color:#fff;padding:2px 12px;border-radius:20px;font-size:12px;">Kelompok 2</span>
                        </div>
                    </div>
                </div>
                
                <div id="tabWhiteboard" class="tab-content" style="display:none;">
                    <h4>✏️ Whiteboard Bersama</h4>
                    <div style="background:#f7f9fc;border:2px dashed #ccc;border-radius:12px;height:300px;display:flex;flex-direction:column;justify-content:center;align-items:center;color:#888;margin-top:12px;cursor:pointer;" onclick="alert('✏️ Whiteboard siap digunakan! Silakan mulai menggambar.')">
                        <div style="font-size:48px;">✏️</div>
                        <p>Klik untuk mulai menggambar di whiteboard</p>
                        <p style="font-size:12px;color:#aaa;">Fitur whiteboard interaktif akan segera hadir</p>
                    </div>
                </div>
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
    
    // ===== TAB NAVIGASI =====
    document.addEventListener('DOMContentLoaded', function() {
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabContents = {
            ruang: document.getElementById('tabRuang'),
            tugas: document.getElementById('tabTugas'),
            whiteboard: document.getElementById('tabWhiteboard')
        };
        
        tabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Reset semua tombol
                tabBtns.forEach(b => {
                    b.className = 'btn-secondary';
                    b.style.background = '#e8edf3';
                    b.style.color = '#333';
                });
                
                // Aktifkan tombol yang diklik
                this.className = 'btn-primary';
                this.style.background = '#2d6a9f';
                this.style.color = '#fff';
                
                // Sembunyikan semua konten
                Object.values(tabContents).forEach(content => {
                    if(content) content.style.display = 'none';
                });
                
                // Tampilkan konten sesuai tab
                const tab = this.getAttribute('data-tab');
                if(tabContents[tab]) {
                    tabContents[tab].style.display = 'block';
                }
            });
        });
        
        // ===== KIRIM PESAN =====
        const kirimPesan = document.getElementById('kirimPesan');
        const chatInput = document.getElementById('chatInput');
        const chatWindow = document.querySelector('.chat-window');
        
        if(kirimPesan && chatInput && chatWindow) {
            kirimPesan.addEventListener('click', function() {
                const msg = chatInput.value.trim();
                if(msg) {
                    const msgDiv = document.createElement('div');
                    msgDiv.className = 'message';
                    msgDiv.innerHTML = `<strong>Kamu:</strong> ${msg}`;
                    const whiteboard = chatWindow.querySelector('.whiteboard-placeholder');
                    if(whiteboard) {
                        chatWindow.insertBefore(msgDiv, whiteboard);
                    } else {
                        chatWindow.appendChild(msgDiv);
                    }
                    chatInput.value = '';
                    chatWindow.scrollTop = chatWindow.scrollHeight;
                }
            });
            
            chatInput.addEventListener('keypress', function(e) {
                if(e.key === 'Enter') {
                    kirimPesan.click();
                }
            });
        }
    });
    </script>
    <script src="js/script.js"></script>
</body>
</html>