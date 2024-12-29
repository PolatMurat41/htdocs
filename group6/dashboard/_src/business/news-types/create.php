<?php
include '../../init.php';

// News Type oluşturma
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $newsType = $_POST['news_type'];
    $newsTypeDetail = $_POST['news_type_detail'];
    $date = date('Y-m-d H:i:s');

    if (empty($newsType)) {
        header('Location: ' . BASE_URL . 'dashboard/news-type-create.php?status=empty');
        exit;
    }

    $newsType = security($newsType);
    $newsTypeDetail = security($newsTypeDetail);
    $create_at = $date;
    $update_at = $date;

    $check_sql = "SELECT * FROM news_types WHERE news_type='$newsType'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        $conn->close();
        header('Location: ' . BASE_URL . 'dashboard/news-type-create.php?status=exists');
        exit;
    }

    $sql = "INSERT INTO news_types (news_type, news_type_detail, create_at, update_at) VALUES ('$newsType', '$newsTypeDetail', '$create_at', '$update_at')";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header('Location: ' . BASE_URL . 'dashboard/news-type-create.php?status=success');
        exit;
    } else {
        $conn->close();
        header('Location: ' . BASE_URL . 'dashboard/news-type-create.php?status=error');
        exit;
    }
} else {
    header('Location: ' . BASE_URL . 'dashboard/news-type-create.php');
    exit;
}
