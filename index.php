<?php
session_start();
if(isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nis = $_POST['nis'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Validasi: NIS harus diisi, Email harus diisi, Password harus diisi
    if(empty($nis) || empty($email) || empty($password)) {
        $error = "⚠️ NIS, Email, dan Password wajib diisi!";
    } else {
        // Simulasi validasi (bisa diganti dengan database)
        // NIS: 2026001, Email: siswa@nexschool.id, Password: 123456
        if($nis == "2026001" && $email == "siswa@nexschool.id" && $password == "123456") {
            $_SESSION['user'] = "Siswa NexSchool";
            $_SESSION['nis'] = $nis;
            $_SESSION['email'] = $email;
            $_SESSION['kelas'] = "XII IPA 1";
            $_SESSION['foto'] = "default.png";
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "❌ NIS, Email, atau Password salah!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NexSchool</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-box">
            <div class="login-logo">
                <img src="assets/logo.png" alt="NexSchool" onerror="this.style.display='none'">
                <h1>Nex<span>School</span></h1>
                <p>Belajar & Berkembang Bersama</p>
            </div>
            
            <form method="POST" action="" id="loginForm">
                <div class="input-group">
                    <label>📝 NIS</label>
                    <input type="text" name="nis" id="nis" placeholder="Masukkan NIS (contoh: 2026001)" required>
                </div>
                <div class="input-group">
                    <label>📧 Email</label>
                    <input type="email" name="email" id="email" placeholder="Masukkan Email (contoh: siswa@nexschool.id)" required>
                </div>
                <div class="input-group">
                    <label>🔒 Password</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan Password" required>
                </div>
                
                <?php if($error): ?>
                    <div class="error-msg"><?= $error ?></div>
                <?php endif; ?>
                
                <button type="submit" class="btn-primary btn-block" id="loginBtn">Masuk</button>
                
                <div class="login-options">
                    <a href="#" id="lupaPassword" style="cursor:pointer;">Lupa Password?</a>
                    <span>|</span>
                    <a href="#" id="guestLogin" style="cursor:pointer;">Masuk sebagai Tamu</a>
                </div>
            </form>
            
            <div class="login-footer">
                <small>&copy; 2026 NexSchool - Platform Belajar Digital</small>
            </div>
        </div>
    </div>
    
    <script>
    // ===== FITUR LUPA PASSWORD =====
    document.getElementById('lupaPassword').addEventListener('click', function(e) {
        e.preventDefault();
        alert('📧 Silakan hubungi admin sekolah untuk reset password.\n\nAtau kirim email ke: admin@nexschool.id');
    });
    
    // ===== FITUR MASUK SEBAGAI TAMU =====
    document.getElementById('guestLogin').addEventListener('click', function(e) {
        e.preventDefault();
        if(confirm('Masuk sebagai tamu? Anda akan bisa melihat fitur namun tidak bisa berinteraksi penuh.')) {
            // Redirect ke dashboard sebagai tamu
            window.location.href = 'dashboard.php?guest=true';
        }
    });
    
    // ===== VALIDASI FORM LOGIN =====
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        const nis = document.getElementById('nis').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        
        if(!nis || !email || !password) {
            e.preventDefault();
            alert('⚠️ Semua field harus diisi!');
            return false;
        }
        
        if(!email.includes('@')) {
            e.preventDefault();
            alert('⚠️ Email tidak valid!');
            return false;
        }
        
        return true;
    });
    </script>
</body>
</html>