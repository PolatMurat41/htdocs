<?php
include '../../init.php';

// News güncelleme
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = intval($_POST['id']);
    $newsTypeId = $_POST['news_type_id'];
    $newsTitle = $_POST['news_title'];
    $newsSummary = $_POST['news_summary'];
    $newsDescription = $_POST['news_description'];
    $newsImage = $_FILES['news_image'];
    $date = date('Y-m-d H:i:s');

    if (empty($newsTypeId) || empty($newsTitle) || empty($newsSummary) || empty($newsDescription)) {
        header('Location: ' . BASE_URL . 'dashboard/news-update.php?id=' . $id . '&status=empty');
        exit;
    }

    $newsTypeId = security($newsTypeId);
    $newsTitle = security($newsTitle);
    $newsSummary = security($newsSummary);
    $newsDescription = security($newsDescription);
    $seoUrl = seoUrl($newsTitle);
    $update_at = $date;

    // Aynı SEO URL'ye sahip başka bir haber olup olmadığını kontrol et
    $check_sql = "SELECT * FROM news WHERE seo_url='$seoUrl' AND id != $id";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        $conn->close();
        header('Location: ' . BASE_URL . 'dashboard/news-update.php?id=' . $id . '&status=exists');
        exit;
    }

    // Resim yükleme işlemi
    if (!empty($newsImage['name'])) {
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/truescope/assets/images/uploads/';
        $target_file = $target_dir . basename($newsImage['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Dosya tipi kontrolü (sadece belirli dosya türlerine izin ver)
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
        if (!in_array($imageFileType, $allowed_types)) {
            header('Location: ' . BASE_URL . 'dashboard/news-create.php?status=invalid_file_type');
            exit;
        }

        // Dosyayı yükle
        if (!move_uploaded_file($newsImage['tmp_name'], $target_file)) {
            header('Location: ' . BASE_URL . 'dashboard/news-create.php?status=upload_error');
            exit;
        }

        // Haber veritabanına güncelle
        $sql = "UPDATE news SET news_type_id='$newsTypeId', news_title='$newsTitle', news_summary='$newsSummary', news_description='$newsDescription', news_image='assets/images/uploads/" . basename($newsImage['name']) . "', seo_url='$seoUrl', update_at='$update_at' WHERE id=$id";
    } else {
        // Haber veritabanına güncelle (resim olmadan)
        $sql = "UPDATE news SET news_type_id='$newsTypeId', news_title='$newsTitle', news_summary='$newsSummary', news_description='$newsDescription', seo_url='$seoUrl', update_at='$update_at' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header('Location: ' . BASE_URL . 'dashboard/news-update.php?id=' . $id . '&status=success');
        exit;
    } else {
        $conn->close();
        header('Location: ' . BASE_URL . 'dashboard/news-update.php?id=' . $id . '&status=error');
        exit;
    }
} else {
    header('Location: ' . BASE_URL . 'dashboard/news-update.php');
    exit;
}
