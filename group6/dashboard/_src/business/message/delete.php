<?php
include '../../init.php';

// News Type silme
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // News Type veritabanından sil
    $sql = "DELETE FROM contacts WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header('Location: ' . BASE_URL . 'dashboard/messages.php?status=deleted');
        exit;
    } else {
        $conn->close();
        header('Location: ' . BASE_URL . 'dashboard/messages.php?status=error');
        exit;
    }
} else {
    header('Location: ' . BASE_URL . 'dashboard/messages.php');
    exit;
}