// ===== TOGGLE SIDEBAR MOBILE =====
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    if(sidebar && overlay) {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('active');
    }
}

// Tutup sidebar saat overlay diklik
document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('sidebarOverlay');
    if(overlay) {
        overlay.addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            if(sidebar) {
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
            }
        });
    }
    
    console.log('✅ NexSchool siap digunakan!');
});

// ===== FUNGSI UNTUK MENAMPILKAN NOTIFIKASI =====
function showNotification(message, type = 'success') {
    const colors = {
        success: '#d4edda',
        error: '#f8d7da',
        warning: '#fff3cd',
        info: '#d1ecf1'
    };
    
    const textColors = {
        success: '#155724',
        error: '#721c24',
        warning: '#856404',
        info: '#0c5460'
    };
    
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${colors[type] || '#fff'};
        color: ${textColors[type] || '#333'};
        padding: 16px 24px;
        border-radius: 10px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
        z-index: 9999;
        animation: slideIn 0.3s ease;
        border-left: 4px solid ${type === 'success' ? '#28a745' : '#dc3545'};
        max-width: 400px;
    `;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transition = 'opacity 0.5s';
        setTimeout(() => notification.remove(), 500);
    }, 4000);
}

// ===== TAMBAHKAN CSS ANIMASI =====
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
`;
document.head.appendChild(style);

console.log('✅ NexSchool - Semua fitur siap!');