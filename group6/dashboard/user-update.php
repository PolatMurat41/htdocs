<?php
include '_src/assets/master/header.php';

if (isset($_SESSION['role']) && $_SESSION['role'] != 'Admin') {
    header('Location: ' . BASE_URL . 'dashboard');
    exit;
}

// ID parametresini kontrol et
if (!isset($_GET['id'])) {
    header('Location: users.php');
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    header('Location: users.php');
    exit;
}

$user = $result->fetch_assoc();

?>

<div class="content">
    <div class="header">
        <h1 style="display:flex;align-items:center"><span style="font-size:18px;margin-right:10px"><a href="users.php">Geri</a></span>/ Users Update</h1>
        <div class="header-buttons">
        </div>
    </div>
    <div><img src="<?php echo BASE_URL . $user['image']; ?>" alt="Current Image" style="max-width: 300px;border-radius:10px"></div>
    <form action="_src/business/users/update.php" method="POST"  enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <label class="input-group">
            <div>Fullname</div>
            <input type="text" name="fullname" placeholder="Fullname" value="<?php echo $user['fullname']; ?>" required>
        </label>

        <label class="input-group">
            <div>Username</div>
            <input type="text" name="username" placeholder="Username" value="<?php echo $user['username']; ?>" required>
        </label>

        <label class="input-group">
            <div>Password</div>
            <input type="password" name="password" placeholder="Password">
        </label>

        <label class="input-group">
            <div>Roles</div>
            <select name="role" required>
                <option value="">Select Role</option>
                <option value="Admin" <?php echo $user['role'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                <option value="Writer" <?php echo $user['role'] == 'Writer' ? 'selected' : ''; ?>>Writer</option>
            </select>
        </label>

        <label class="input-group">
            <div>Description</div>
            <textarea name="description" placeholder="Description" style="resize:none" rows="20"><?php echo $user['description']; ?></textarea>
        </label>

        <label class="input-group">
            <div>Image</div>
            <input type="file" name="image">
        </label>

        <div class="form-footer">
            <?php if (isset($_GET['status'])) {
                if ($_GET['status'] == 'empty') { ?>
                    <div>Please do not leave any fields empty.</div>
                <?php } elseif ($_GET['status'] == 'success') { ?>
                    <div>User successfully updated.</div>
                <?php } elseif ($_GET['status'] == 'error') { ?>
                    <div>Error: User could not be updated.</div>
                <?php } elseif ($_GET['status'] == 'exists') { ?>
                    <div>Error: This username already exists.</div>
            <?php }
            } ?><button type="submit">Update</button>
        </div>
    </form>

</div>
<?php include '_src/assets/master/footer.php' ?>