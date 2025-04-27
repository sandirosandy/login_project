<?php
require_once '../includes/auth.php';

$code = trim($_POST['code']);
$email = $_SESSION['verification_email'];

if(verify_user($email, $code)) {
    unset($_SESSION['verification_email']);
    unset($_SESSION['verification_code']);
    $_SESSION['success'] = 'Your account has been verified. Please login.';
    redirect('login.php');
} else {
    $error = 'Invalid verification code';
}

require_once '../public/verify.php';
?>
