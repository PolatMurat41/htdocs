<?php include '_src/assets/master/header.php';
if (isset($_SESSION['role']) && $_SESSION['role'] != 'Admin') {
    header('Location: ' . BASE_URL . 'dashboard');
    exit;
} ?>
<div class="content">
    <div class="header">
        <h1 style="display:flex;align-items:center"><span style="font-size:18px;margin-right:10px"><a href="users.php">Geri</a></span>/ Users Create</h1>
        <div class="header-buttons">
        </div>
    </div>

    <form action="_src/business/users/create.php" method="POST"  enctype="multipart/form-data">
        <label class="input-group">
            <div>Fullname</div>
            <input type="text" name="fullname" placeholder="Fullname" required>
        </label>

        <label class="input-group">
            <div>Username</div>
            <input type="text" name="username" placeholder="Username" required>
        </label>

        <label class="input-group">
            <div>Password</div>
            <input type="password" name="password" placeholder="Password" required>
        </label>

        <label class="input-group">
            <div>Roles</div>
            <select name="role" required>
                <option value="">Select Role</option>
                <option value="Admin">Admin</option>
                <option value="Writer">Writer</option>
            </select>
        </label>

        <label class="input-group">
            <div>Description</div>
            <textarea name="description" placeholder="Description" style="resize:none" rows="20"></textarea>
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
                    <div>User successfully created.</div>
                <?php } elseif ($_GET['status'] == 'error') { ?>
                    <div>Error: User could not be created.</div>
                <?php } elseif ($_GET['status'] == 'exists') { ?>
                    <div>Error: This username already exists.</div>
            <?php }
            } ?><button type="submit">Create</button>
        </div>
    </form>

</div>
<?php include '_src/assets/master/footer.php' ?>