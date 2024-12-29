<?php
include '../../init.php';

// news type güncelleme
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = intval($_POST['id']);
    $newsType = $_POST['news_type'];
    $newsTypeDetail = $_POST['news_type_detail'];
    $date = date('Y-m-d H:i:s');

    if (empty($newsType)) {
        header('Location: ' . BASE_URL . 'dashboard/news-type-update.php?id=' . $id . '&status=empty');
        exit;
    }

    $newsType = security($newsType);
    $newsTypeDetail = security($newsTypeDetail);
    $update_at = $date;

    // Aynı news type sahip başka bir news type olup olmadığını kontrol et
    $check_sql = "SELECT * FROM news_types WHERE news_type='$newsType' AND id != $id";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        $conn->close();
        header('Location: ' . BASE_URL . 'dashboard/news-type-update.php?id=' . $id . '&status=exists');
        exit;
    }

    $sql = "UPDATE news_types SET news_type='$newsType', news_type_detail='$newsTypeDetail', update_at='$update_at' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header('Location: ' . BASE_URL . 'dashboard/news-type-update.php?id=' . $id . '&status=success');
        exit;
    } else {
        $conn->close();
        header('Location: ' . BASE_URL . 'dashboard/news-type-update.php?id=' . $id . '&status=error');
        exit;
    }
} else {
    header('Location: ' . BASE_URL . 'dashboard/news-types.php');
    exit;
}
