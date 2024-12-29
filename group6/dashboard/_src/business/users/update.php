<?php
include '../../init.php';

// Kullanıcı güncelleme
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = intval($_POST['id']);
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $description = $_POST['description'];
    $image = $_FILES['image'];
    $date = date('Y-m-d H:i:s');

    if (empty($fullname) || empty($username) || empty($role)) {
        header('Location: ' . BASE_URL . 'dashboard/user-update.php?id=' . $id . '&status=empty');
        exit;
    }

    $fullname = security($fullname);
    $username = security($username);
    $role = security($role);
    $description = security($description);
    $seoUrl = seoUrl($fullname);
    $update_at = $date;

    // Aynı kullanıcı adına sahip başka bir kullanıcı olup olmadığını kontrol et
    $check_sql = "SELECT * FROM users WHERE username='$username' AND id != $id";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        $conn->close();
        header('Location: ' . BASE_URL . 'dashboard/user-update.php?id=' . $id . '&status=exists');
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
            header('Location: ' . BASE_URL . 'dashboard/user-update.php?id=' . $id . '&status=invalid_file_type');
            exit;
        }

        // Dosyayı yükle
        if (!move_uploaded_file($image['tmp_name'], $target_file)) {
            header('Location: ' . BASE_URL . 'dashboard/user-update.php?id=' . $id . '&status=upload_error');
            exit;
        }
        $imagedb = 'assets/images/uploads/' . basename($image['name']);
    } else {
        $imagedb = null;
    }

    // Şifre alanı boş değilse şifreyi güncelle
    if (!empty($password)) {
        $password = password_hash(security($password), PASSWORD_DEFAULT);
        if ($imagedb) {
            $sql = "UPDATE users SET fullname='$fullname', username='$username', password='$password', role='$role', description='$description', image='$imagedb',seo_url='$seoUrl', update_at='$update_at' WHERE id=$id";
        } else {
            $sql = "UPDATE users SET fullname='$fullname', username='$username', password='$password', role='$role', description='$description',seo_url='$seoUrl', update_at='$update_at' WHERE id=$id";
        }
    } else {
        if ($imagedb) {
            $sql = "UPDATE users SET fullname='$fullname', username='$username', role='$role', description='$description', image='$imagedb',seo_url='$seoUrl', update_at='$update_at' WHERE id=$id";
        } else {
            $sql = "UPDATE users SET fullname='$fullname', username='$username', role='$role', description='$description',seo_url='$seoUrl', update_at='$update_at' WHERE id=$id";
        }
    }

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header('Location: ' . BASE_URL . 'dashboard/user-update.php?id=' . $id . '&status=success');
        exit;
    } else {
        $conn->close();
        header('Location: ' . BASE_URL . 'dashboard/user-update.php?id=' . $id . '&status=error');
        exit;
    }
} else {
    header('Location: ' . BASE_URL . 'dashboard/users.php');
    exit;
}
