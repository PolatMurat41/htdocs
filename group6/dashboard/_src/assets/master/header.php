<?php include '_src/init.php';

if (!isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . 'dashboard/login.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="_src/assets/css/custom.css">
</head>

<body>
    <?php include 'sidebar.php' ?>