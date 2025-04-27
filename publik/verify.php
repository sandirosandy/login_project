<?php 
session_start(); 
require_once '../includes/config.php'; 
require_once '../includes/functions.php';  

if(!isset($_SESSION['verification_email'])) {     
    redirect('register.php'); 
}  

$error = '';
$success = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {     
    // Proses verifikasi kode
    $input_code = $_POST['code'];
    if ($input_code == $_SESSION['verification_code']) {
        // Jika kode cocok
        $success = 'Akun kamu berhasil diverifikasi!';
        
        // (Opsional) Update status akun di database di sini, kalau mau
        
        // Hapus session verification_code supaya tidak bisa verifikasi ulang pakai kode lama
        unset($_SESSION['verification_code']);
        
        // Redirect otomatis ke login setelah beberapa detik
        echo "<script>
            setTimeout(function() {
                window.location.href = 'login.php';
            }, 3000); // 3000ms = 3 detik
        </script>";
    } else {
        $error = 'Kode verifikasi salah!';
    }
}
?>  

<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Verify Account - T Informatica</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="css/style.css" rel="stylesheet"> 
</head> 
<body> 
    <div class="login-container"> 
        <div class="login-logo"> 
            <h2>Teknik Informatika - UKRI</h2> 
            <p>Software Quality - Kelompok 10</p> 
        </div> 
        
        <?php if($success): ?>
            <div class="alert alert-success"><?php echo $success; ?><br>Anda akan diarahkan ke halaman login...</div>
        <?php endif; ?>

        <?php if($error): ?> 
            <div class="alert alert-danger"><?php echo $error; ?></div> 
        <?php endif; ?>
        
        <form action="verify.php" method="POST"> 
            <div class="alert alert-info"> 
                Kode telah dikirim ke <b><?php echo $_SESSION['verification_email']; ?></b>.<br>
                Gunakan kode ini untuk verifikasi: <b><?php echo $_SESSION['verification_code']; ?></b>
            </div> 
            <div class="form-group mb-3"> 
                <label for="code">Verification Code</label> 
                <input type="text" class="form-control" id="code" name="code" required> 
            </div> 
            <button type="submit" class="btn btn-primary w-100 mb-2">Verify Account</button> 
            <a href="register.php" class="btn btn-secondary w-100">Cancel</a> 
        </form> 
    </div> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
</body> 
</html>
