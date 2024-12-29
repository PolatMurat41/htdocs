<?php
include 'init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $date = date('Y-m-d H:i:s');

    if (empty($name) || empty($email) || empty($message)) {
        header('Location: ' . BASE_URL . 'contact.php?status=empty');
        exit;
    }

    $name = security($name);
    $email = security($email);
    $message = security($message);
    $create_at = $date;


    // Haber veritabanına ekle
    $sql = "INSERT INTO contacts (name, email, message, create_at) VALUES ('$name', '$email', '$message', '$create_at')";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header('Location: ' . BASE_URL . 'contact.php?status=success');
        exit;
    } else {
        $conn->close();
        header('Location: ' . BASE_URL . 'contact.php?status=error');
        exit;
    }
} else {
    header('Location: ' . BASE_URL . 'contact.php');
    exit;
}