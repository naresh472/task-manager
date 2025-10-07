<?php
function isLoggedIn() {
    return !empty($_SESSION['user_id']);
}
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: index.php?page=login');
        exit;
    }
}
function currentUserId() {
    return $_SESSION['user_id'] ?? null;
}
