<?php include '_src/assets/master/header.php';
$user_id = $_SESSION['user'];
$sql = "SELECT fullname FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

?>
<div class="content">
    <h1>Welcome <?php echo security($user['fullname']); ?></h1>
</div>
<?php include '_src/assets/master/footer.php' ?>