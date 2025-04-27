<?php
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function redirect($url) {
    header("Location: $url");
    exit();
}

function display_error($error) {
    return '<div class="alert alert-danger">'.$error.'</div>';
}
?>
