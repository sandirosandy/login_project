<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/functions.php';

if(is_logged_in()) {
    redirect('index.php');
}

$error = '';
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../process/login.php';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - T Informatica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600&display=swap" rel="stylesheet">

    <link href="css/login.css" rel="stylesheet">


</head>
<body>
    <div class="login-container">
        <div class="login-logo">
            <h2>LOG IN</h2>
            <p>Kalo hati dan pikiran sudah mantap</p>
        </div>
        
        <?php if($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <a href="register.php" class="btn btn-secondary w-100 btn-register">Register</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>