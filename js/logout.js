/**
 * ============================================
 * LOGOUT.JS - NexSchool
 * Fungsi logout untuk semua halaman
 * ============================================
 */

/**
 * ===== FUNGSI LOGOUT UTAMA =====
 * Menghapus semua data session dan redirect ke login
 */
function logout() {
    // Tampilkan konfirmasi sebelum logout
    if(confirm('Yakin ingin keluar dari NexSchool?')) {
        
        // ===== HAPUS SEMUA DATA SESSION =====
        // Data login
        localStorage.removeItem('isLoggedIn');
        localStorage.removeItem('user');
        
        // Data pengaturan
        localStorage.removeItem('darkMode');
        localStorage.removeItem('savedPassword');
        
        // Data aplikasi (opsional - jika ingin reset semua data)
        // localStorage.removeItem('klubData');
        // localStorage.removeItem('siswaData');
        // localStorage.removeItem('konselingSiswaData');
        // localStorage.removeItem('grupDiskusiData');
        // localStorage.removeItem('tugasKelompokData');
        
        // ===== REDIRECT KE HALAMAN LOGIN =====
        window.location.href = 'index.html';
    }
}

/**
 * ===== CEK STATUS LOGIN =====
 * Memeriksa apakah pengguna sudah login
 * @returns {boolean} true jika login, false jika tidak
 */
function checkLoginStatus() {
    const isLoggedIn = localStorage.getItem('isLoggedIn');
    if(!isLoggedIn || isLoggedIn !== 'true') {
        // Jika belum login, redirect ke halaman login
        window.location.href = 'index.html';
        return false;
    }
    return true;
}

/**
 * ===== AMBIL DATA USER =====
 * Mendapatkan data user dari localStorage
 * @returns {object|null} Data user atau null jika tidak ada
 */
function getUserData() {
    const user = localStorage.getItem('user');
    return user ? JSON.parse(user) : null;
}

/**
 * ===== UPDATE USER BADGE =====
 * Memperbarui tampilan nama dan foto user di semua elemen
 * Gunakan class .userName dan .userFoto
 */
function updateUserBadge() {
    const user = getUserData();
    if(user) {
        // Update semua elemen dengan class .userName
        document.querySelectorAll('.userName').forEach(el => {
            el.textContent = user.name;
        });
        
        // Update semua elemen dengan class .userFoto
        document.querySelectorAll('.userFoto').forEach(el => {
            el.src = `assets/${user.foto || 'default.png'}`;
            el.onerror = function() {
                this.style.display = 'none';
            };
        });
        
        // Update elemen spesifik jika ada
        const welcomeText = document.getElementById('welcomeText');
        if(welcomeText) {
            welcomeText.textContent = `Selamat Datang, ${user.name}! 👋`;
        }
        
        const userInfo = document.getElementById('userInfo');
        if(userInfo) {
            userInfo.textContent = `NIS: ${user.nis} | Kelas: ${user.kelas || '-'}`;
        }
    }
}

/**
 * ===== CEK ROLE USER =====
 * @returns {string} 'guru', 'siswa', atau null
 */
function getUserRole() {
    const user = getUserData();
    return user ? user.role : null;
}

/**
 * ===== CEK APAKAH USER GURU =====
 * @returns {boolean}
 */
function isGuru() {
    return getUserRole() === 'guru';
}

/**
 * ===== CEK APAKAH USER SISWA =====
 * @returns {boolean}
 */
function isSiswa() {
    return getUserRole() === 'siswa';
}

/**
 * ===== CEK APAKAH USER TAMU =====
 * @returns {boolean}
 */
function isGuest() {
    const user = getUserData();
    return user ? user.isGuest || false : false;
}

/**
 * ===== REDIRECT BERDASARKAN ROLE =====
 * Mengarahkan user ke halaman sesuai role-nya
 */
function redirectByRole() {
    const user = getUserData();
    if(!user) {
        window.location.href = 'index.html';
        return;
    }
    
    if(user.role === 'guru') {
        window.location.href = 'dashboard_guru.html';
    } else if(user.role === 'siswa') {
        window.location.href = 'dashboard_siswa.html';
    } else {
        window.location.href = 'index.html';
    }
}

/**
 * ===== TAMPILKAN NOTIFIKASI =====
 * Menampilkan notifikasi toast sederhana
 * @param {string} message - Pesan yang ditampilkan
 * @param {string} type - 'success', 'error', 'warning', 'info'
 */
function showToast(message, type = 'success') {
    const colors = {
        success: '#28a745',
        error: '#dc3545',
        warning: '#f5a623',
        info: '#2d6a9f'
    };
    
    const toast = document.createElement('div');
    toast.style.cssText = `
        position: fixed;
        bottom: 30px;
        right: 30px;
        padding: 16px 24px;
        border-radius: 10px;
        background: ${colors[type] || '#2d6a9f'};
        color: #fff;
        font-weight: 600;
        z-index: 99999;
        box-shadow: 0 8px 30px rgba(0,0,0,0.2);
        animation: slideUp 0.3s ease;
        max-width: 400px;
    `;
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transition = 'opacity 0.5s';
        setTimeout(() => toast.remove(), 500);
    }, 4000);
}

/**
 * ===== TAMBAHKAN CSS ANIMASI =====
 * Menambahkan animasi untuk toast notification
 */
(function addToastAnimation() {
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideUp {
            from {
                transform: translateY(100px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    `;
    document.head.appendChild(style);
})();

/**
 * ===== AUTO-LOGOUT (Opsional) =====
 * Logout otomatis setelah 30 menit tidak aktif
 * Aktifkan jika diperlukan
 */
/*
let timeoutId;

function resetAutoLogout() {
    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => {
        if(localStorage.getItem('isLoggedIn')) {
            alert('Sesi Anda telah berakhir karena tidak aktif.');
            logout();
        }
    }, 30 * 60 * 1000); // 30 menit
}

// Reset timer saat ada aktivitas
document.addEventListener('click', resetAutoLogout);
document.addEventListener('keypress', resetAutoLogout);
document.addEventListener('scroll', resetAutoLogout);

// Start auto-logout
resetAutoLogout();
*/

/**
 * ===== KELUAR DARI SEMUA TAB (Opsional) =====
 * Mengirim pesan ke tab lain agar logout bersamaan
 * Aktifkan jika diperlukan
 */
/*
window.addEventListener('storage', function(e) {
    if(e.key === 'isLoggedIn' && !e.newValue) {
        window.location.href = 'index.html';
    }
});
*/

// ===== LOG DI CONSOLE =====
console.log('✅ logout.js loaded - NexSchool');
console.log('📌 Fungsi tersedia:');
console.log('   - logout()');
console.log('   - checkLoginStatus()');
console.log('   - getUserData()');
console.log('   - updateUserBadge()');
console.log('   - getUserRole()');
console.log('   - isGuru() / isSiswa()');
console.log('   - redirectByRole()');
console.log('   - showToast(message, type)');