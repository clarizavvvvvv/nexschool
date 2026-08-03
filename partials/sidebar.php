<!-- SIDEBAR -->
<nav class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <h2>Nex<span>School</span></h2>
        <small>Platform Belajar Digital</small>
    </div>
    <ul class="sidebar-menu">
        <li><a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">
            <span class="icon">📊</span> Beranda
        </a></li>
        <li><a href="diskusi.php" class="<?= basename($_SERVER['PHP_SELF']) == 'diskusi.php' ? 'active' : '' ?>">
            <span class="icon">🗨️</span> Diskusi Kelompok
        </a></li>
        <li><a href="ekstrakurikuler.php" class="<?= basename($_SERVER['PHP_SELF']) == 'ekstrakurikuler.php' ? 'active' : '' ?>">
            <span class="icon">🏫</span> Ekstrakurikuler
        </a></li>
        <li><a href="konseling.php" class="<?= basename($_SERVER['PHP_SELF']) == 'konseling.php' ? 'active' : '' ?>">
            <span class="icon">💚</span> Konseling Virtual
        </a></li>
        <li><a href="profil.php" class="<?= basename($_SERVER['PHP_SELF']) == 'profil.php' ? 'active' : '' ?>">
            <span class="icon">👤</span> Profil
        </a></li>
        <li style="margin-top:20px;border-top:1px solid rgba(255,255,255,0.1);padding-top:16px;">
            <a href="logout.php" style="color:rgba(255,100,100,0.7);">
                <span class="icon">🚪</span> Keluar
            </a>
        </li>
    </ul>
</nav>