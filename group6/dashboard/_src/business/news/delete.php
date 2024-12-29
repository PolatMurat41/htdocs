<?php
include '../../init.php';

// News silme
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Mevcut resmi sil
    $current_image_sql = "SELECT news_image FROM news WHERE id = $id";
    $current_image_result = $conn->query($current_image_sql);
    if ($current_image_result->num_rows > 0) {
        $current_image_row = $current_image_result->fetch_assoc();
        $current_image_path = $_SERVER['DOCUMENT_ROOT'] . '/truescope/' . $current_image_row['news_image'];
        if (file_exists($current_image_path)) {
            unlink($current_image_path);
        }
    }

    // News veritabanından sil
    $sql = "DELETE FROM news WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header('Location: ' . BASE_URL . 'dashboard/news.php?status=deleted');
        exit;
    } else {
        $conn->close();
        header('Location: ' . BASE_URL . 'dashboard/news.php?status=error');
        exit;
    }
} else {
    header('Location: ' . BASE_URL . 'dashboard/news.php');
    exit;
}