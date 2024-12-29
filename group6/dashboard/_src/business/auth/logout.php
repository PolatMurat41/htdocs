<?php
include '../../init.php';

// Belirli oturum değişkenlerini temizle
unset($_SESSION['user']);
unset($_SESSION['role']);

// Oturumu sonlandır
session_destroy();

// Giriş sayfasına yönlendir
header('Location: ' . BASE_URL . 'dashboard/login.php');
exit;