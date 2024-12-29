<?php
include '_src/assets/master/header.php';

// ID parametresini kontrol et
if (!isset($_GET['id'])) {
    header('Location: news.php');
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM news WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    header('Location: news.php');
    exit;
}

$news = $result->fetch_assoc();

$news_types_result = $conn->query("SELECT * FROM news_types");
$writers_result = $conn->query("SELECT * FROM users WHERE role = 'Writer'");
?>
<div class="content">
    <div class="header">
        <h1 style="display:flex;align-items:center"><span style="font-size:18px;margin-right:10px"><a href="news.php">Geri</a></span>/ News Update</h1>
        <div class="header-buttons">
        </div>
    </div>
    <div><img src="<?php echo BASE_URL . $news['news_image']; ?>" alt="Current Image" style="max-width: 300px;border-radius:10px"></div>
    <form action="_src/business/news/update.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $news['id']; ?>">

        <label class="input-group">
            <div>News Types</div>
            <select name="news_type_id" required>
                <option value="">Select News Type</option>
                <?php
                if ($news_types_result->num_rows > 0) {
                    while ($news_type = $news_types_result->fetch_assoc()) {
                        $selected = $news['news_type_id'] == $news_type['id'] ? 'selected' : '';
                        echo '<option value="' . $news_type['id'] . '" ' . $selected . '>' . $news_type['news_type'] . '</option>';
                    }
                }
                ?>
            </select>
        </label>

        <label class="input-group">
            <div>Title</div>
            <input type="text" name="news_title" placeholder="Title" value="<?php echo $news['news_title']; ?>" required>
        </label>

        <label class="input-group">
            <div>Summary</div>
            <input type="text" name="news_summary" placeholder="Summary" value="<?php echo $news['news_summary']; ?>" required>
        </label>

        <label class="input-group">
            <div>Description</div>
            <textarea name="news_description" placeholder="Description" style="resize:none" rows="20" required><?php echo $news['news_description']; ?></textarea>
        </label>

        <label class="input-group">
            <div>Image</div>
            <input type="file" name="news_image">
        </label>

        <div class="form-footer">
            <?php if (isset($_GET['status'])) {
                if ($_GET['status'] == 'empty') { ?>
                    <div class="message warning">Please do not leave any fields empty.</div>
                <?php } elseif ($_GET['status'] == 'success') { ?>
                    <div class="message success">News successfully updated.</div>
                <?php } elseif ($_GET['status'] == 'error') { ?>
                    <div class="message error">Error: News could not be updated.</div>
                <?php } elseif ($_GET['status'] == 'exists') { ?>
                    <div class="message error">Error: This news title already exists.</div>
                <?php } elseif ($_GET['status'] == 'invalid_file_type') { ?>
                    <div class="message error">Error: Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.</div>
                <?php } elseif ($_GET['status'] == 'upload_error') { ?>
                    <div class="message error">Error: An error occurred while uploading the file.</div>
            <?php }
            } ?><button type="submit">Update</button>
        </div>
    </form>

</div>
<?php include '_src/assets/master/footer.php' ?>