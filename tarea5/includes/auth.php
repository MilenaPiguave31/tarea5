<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

function requireRole($roles) {
    if (!is_array($roles)) {
        $roles = [$roles];
    }
    if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $roles)) {
        header('Location: ../index.php');
        exit();
    }
}
?>
