<?php include '_src/assets/master/header.php';

$news_types_result = $conn->query("SELECT * FROM news_types");
$writers_result = $conn->query("SELECT * FROM users WHERE role = 'Writer'");
?>
<div class="content">
    <div class="header">
        <h1 style="display:flex;align-items:center"><span style="font-size:18px;margin-right:10px"><a href="news.php">Geri</a></span>/ News Create</h1>
        <div class="header-buttons">
        </div>
    </div>

    <form action="_src/business/news/create.php" method="POST" enctype="multipart/form-data">

        <label class="input-group">
            <div>News Types</div>
            <select name="news_type_id" required>
                <option value="">Select News Type</option>
                <?php
                if ($news_types_result->num_rows > 0) {
                    while ($news_type = $news_types_result->fetch_assoc()) {
                        echo '<option value="' . $news_type['id'] . '">' . $news_type['news_type'] . '</option>';
                    }
                }
                ?>
            </select>
        </label>

        <?php
        if ($_SESSION['role'] == 'Admin') { ?>

            <label class="input-group">
                <div>Writers</div>
                <select name="writer_id" required>
                    <option value="">Select Writer</option>
                    <?php
                    if ($writers_result->num_rows > 0) {
                        while ($writer = $writers_result->fetch_assoc()) {
                            echo '<option value="' . $writer['id'] . '">' . $writer['fullname'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </label>
        <?php }else{ ?>
            <input type="hidden" name="writer_id" value="<?php echo $_SESSION['user']; ?>">
        <?php } ?>

        <label class="input-group">
            <div>Title</div>
            <input type="text" name="news_title" placeholder="Title" required>
        </label>

        <label class="input-group">
            <div>Summary</div>
            <input type="text" name="news_summary" placeholder="Summary" required>
        </label>

        <label class="input-group">
            <div>Description</div>
            <textarea name="news_description" placeholder="Description" style="resize:none" rows="20"></textarea>
        </label>

        <label class="input-group">
            <div>Image</div>
            <input type="file" name="news_image" required>
        </label>

        <div class="form-footer">
            <?php if (isset($_GET['status'])) {
                if ($_GET['status'] == 'empty') { ?>
                    <div class="message warning">Please do not leave any fields empty.</div>
                <?php } elseif ($_GET['status'] == 'success') { ?>
                    <div class="message success">News successfully created.</div>
                <?php } elseif ($_GET['status'] == 'error') { ?>
                    <div class="message error">Error: News could not be created.</div>
                <?php } elseif ($_GET['status'] == 'exists') { ?>
                    <div class="message error">Error: This News name already exists.</div>
                <?php } elseif ($_GET['status'] == 'invalid_file_type') { ?>
                    <div class="message error">Error: Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.</div>
                <?php } elseif ($_GET['status'] == 'upload_error') { ?>
                    <div class="message error">Error: An error occurred while uploading the file.</div>
            <?php }
            } ?><button type="submit">Create</button>
        </div>
    </form>

</div>
<?php include '_src/assets/master/footer.php' ?>