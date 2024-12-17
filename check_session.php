<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Ambil data user dari database
require_once 'config.php';
try {
    $stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    
    // Simpan ke session untuk digunakan di halaman lain
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
