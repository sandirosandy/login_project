<?php
require_once 'config.php';

function register_user($name, $email, $address, $phone, $username, $password) {
    global $conn;
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $verification_code = rand(100000, 999999);
    
    $sql = "INSERT INTO customers (name, email, address, phone, username, password, verification_code, is_verified) 
            VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $name, $email, $address, $phone, $username, $hashed_password, $verification_code);
    
    if($stmt->execute()) {
        // In a real app, you would send this code to the user's email
        $_SESSION['verification_email'] = $email;
        $_SESSION['verification_code'] = $verification_code;
        return true;
    }
    return false;
}

function verify_user($email, $code) {
    global $conn;
    
    $sql = "UPDATE customers SET is_verified = 1 WHERE email = ? AND verification_code = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $email, $code);
    
    return $stmt->execute();
}

function login_user($username, $password) {
    global $conn;
    
    $sql = "SELECT id, username, password, is_verified FROM customers WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        if(password_verify($password, $user['password'])) {
            if($user['is_verified']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                return true;
            } else {
                return 'not_verified';
            }
        }
    }
    return false;
}
?>
