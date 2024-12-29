<?php
include '../../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        header('Location: ' . BASE_URL . 'dashboard/login.php?status=empty');
        exit;
    }

    $username = security($username);
    $password = security($password);

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            header('Location: ' . BASE_URL . 'dashboard');
            exit;
        } else {
            header('Location: ' . BASE_URL . 'dashboard/login.php?status=invalid');
            exit;
        }
    } else {
        header('Location: ' . BASE_URL . 'dashboard/login.php?status=error');
        exit;
    }
}
