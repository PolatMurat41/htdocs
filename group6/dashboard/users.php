<?php include '_src/assets/master/header.php';

if (isset($_SESSION['role']) && $_SESSION['role'] != 'Admin') {
    header('Location: ' . BASE_URL . 'dashboard');
    exit;
}

?>
<div class="content">
    <div class="header">
        <h1 style="display:flex;align-items:center">Users</h1>
        <div class="header-buttons">
            <a href="user-create.php">Create User</a>
        </div>
    </div>

    <div>
        <table>
            <thead>
                <tr>
                    <th>Fullname</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM users");

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['fullname'] ?></td>
                            <td><?php echo $row['username'] ?></td>
                            <td><?php echo $row['role'] ?></td>
                            <td><?php echo date('d.m.Y H:i:s', strtotime($row['create_at'])) ?></td>
                            <td><?php echo date('d.m.Y H:i:s', strtotime($row['update_at'])) ?></td>
                            <td class="actions">
                            <a href="user-update.php?id=<?php echo $row['id'] ?>">Update</a>
                            <a href="_src/business/users/delete.php?id=<?php echo $row['id'] ?>">Delete</a>
                        </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="6">No data found.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</div>
<?php include '_src/assets/master/footer.php' ?>