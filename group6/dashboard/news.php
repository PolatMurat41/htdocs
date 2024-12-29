<?php include '_src/assets/master/header.php' ?>
<div class="content">
    <div class="header">
        <h1 style="display:flex;align-items:center">News</h1>
        <div class="header-buttons">
            <a href="news-create.php">Create News</a>
        </div>
    </div>

    <div>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM news");

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['news_title'] ?></td>
                            <td><?php echo date('d.m.Y H:i:s', strtotime($row['create_at'])) ?></td>
                            <td><?php echo date('d.m.Y H:i:s', strtotime($row['update_at'])) ?></td>
                            <td class="actions">
                            <a href="news-update.php?id=<?php echo $row['id'] ?>">Update</a>
                            <a href="_src/business/news/delete.php?id=<?php echo $row['id'] ?>">Delete</a>
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