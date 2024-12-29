<?php
include '../../init.php';

// News oluşturma
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  

    $newsTypeId = $_POST['news_type_id'];
  
    $writerId = $_POST['writer_id'];
    $newsTitle = $_POST['news_title'];
    $newsSummary = $_POST['news_summary'];
    $newsDescription = $_POST['news_description'];
    $newsImage = $_FILES['news_image'];

    $date = date('Y-m-d H:i:s');

    if (empty($newsTypeId) || empty($writerId) || empty($newsTitle) || empty($newsSummary) || empty($newsDescription)) {

        header('Location: ' . BASE_URL . 'dashboard/news-create.php?status=empty');
        exit;
    }

    $newsTypeId = security($newsTypeId);
    $writerId = security($writerId);
    $newsTitle = security($newsTitle);
    $newsSummary = security($newsSummary);
    $newsDescription = security($newsDescription);
    $seoUrl = seoUrl($newsTitle);
    $create_at = $date;
    $update_at = $date;

    // Aynı SEO URL'ye sahip başka bir haber olup olmadığını kontrol et
    $check_sql = "SELECT * FROM news WHERE seo_url='$seoUrl'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        $conn->close();
        header('Location: ' . BASE_URL . 'dashboard/news-create.php?status=exists');
        exit;
    }

    // Resim yükleme
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

    // Haber veritabanına ekle
    $sql = "INSERT INTO news (news_type_id, writer_id, news_title, news_summary, news_description, news_image, seo_url, create_at, update_at) VALUES ('$newsTypeId', '$writerId', '$newsTitle', '$newsSummary', '$newsDescription', 'assets/images/uploads/" . basename($newsImage['name']) . "', '$seoUrl', '$create_at', '$update_at')";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header('Location: ' . BASE_URL . 'dashboard/news-create.php?status=success');
        exit;
    } else {
        $conn->close();
        header('Location: ' . BASE_URL . 'dashboard/news-create.php?status=error');
        exit;
    }
} else {
    header('Location: ' . BASE_URL . 'dashboard/news-create.php');
    exit;
}