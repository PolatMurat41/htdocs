<?php
include '../../init.php';

// Kullanıcı oluşturma
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $description = $_POST['description'];
    $image = $_FILES['image'];
    $date = date('Y-m-d H:i:s');

    if (empty($fullname) || empty($username) || empty($password) || empty($role)) {
        header('Location: ' . BASE_URL . 'dashboard/user-create.php?status=empty');
        exit;
    }

    $fullname = security($fullname);
    $username = security($username);
    $password = password_hash(security($password), PASSWORD_DEFAULT);
    $role = security($role);
    $description = security($description);
    $seoUrl = seoUrl($fullname);
    $create_at = $date;
    $update_at = $date;

    // Aynı SEO URL'ye sahip başka bir haber olup olmadığını kontrol et
    $check_sql = "SELECT * FROM users WHERE seo_url='$seoUrl'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        $conn->close();
        header('Location: ' . BASE_URL . 'dashboard/user-create.php?status=exists');
        exit;
    }

    // Resim yükleme işlemi
    if (!empty($image['name'])) {
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/truescope/assets/images/uploads/';
        $target_file = $target_dir . basename($image['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Dosya tipi kontrolü (sadece belirli dosya türlerine izin ver)
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
        if (!in_array($imageFileType, $allowed_types)) {
            header('Location: ' . BASE_URL . 'dashboard/user-create.php?status=invalid_file_type');
            exit;
        }

        // Dosyayı yükle
        if (!move_uploaded_file($image['tmp_name'], $target_file)) {
            header('Location: ' . BASE_URL . 'dashboard/user-create.php?status=upload_error');
            exit;
        }
        $imagedb = 'assets/images/uploads/' . basename($image['name']);
    } else {
        $imagedb = null;
    }

    // Kullanıcıyı veritabanına ekle
    $sql = "INSERT INTO users (fullname, username, password, role, description, image, seo_url, create_at, update_at) VALUES ('$fullname', '$username', '$password', '$role', '$description', '$imagedb', '$seoUrl','$create_at', '$update_at')";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header('Location: ' . BASE_URL . 'dashboard/user-create.php?status=success');
        exit;
    } else {
        $conn->close();
        header('Location: ' . BASE_URL . 'dashboard/user-create.php?status=error');
        exit;
    }
} else {
    header('Location: ' . BASE_URL . 'dashboard/user-create.php');
    exit;
}