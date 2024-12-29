<?php include '_src/assets/master/header.php' ?>
<div class="content">
    <div class="header">
        <h1 style="display:flex;align-items:center">Messages</h1>
        <div class="header-buttons">
        </div>
    </div>

    <div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>e-mail</th>
                    <th>Message</th>
                    <th>Create At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM contacts");

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['message'] ?></td>
                            <td><?php echo date('d.m.Y H:i:s', strtotime($row['create_at'])) ?></td>
                            <td class="actions">
                            <a href="_src/business/message/delete.php?id=<?php echo $row['id'] ?>">Delete</a>
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