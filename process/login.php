<?php
require_once '../includes/auth.php';

$username = trim($_POST['username']);
$password = trim($_POST['password']);

$result = login_user($username, $password);

if($result === true) {
    redirect('index.php');
} elseif($result === 'not_verified') {
    $error = 'Please verify your account first. Check your email for the verification code.';
} else {
    $error = 'Invalid username or password';
}

require_once '../public/login.php';
?>
