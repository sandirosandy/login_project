<?php
require_once '../includes/auth.php';

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$address = trim($_POST['address']);
$phone = trim($_POST['phone']);
$username = trim($_POST['username']);
$password = trim($_POST['password']);

if(register_user($name, $email, $address, $phone, $username, $password)) {
    redirect('verify.php');
} else {
    $error = 'Registration failed. Please try again.';
}

require_once '../public/register.php';
?>
