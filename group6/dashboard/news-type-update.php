<?php
include '_src/assets/master/header.php';

// ID parametresini kontrol et
if (!isset($_GET['id'])) {
    header('Location: news-types.php');
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM news_types WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    header('Location: news-types.php');
    exit;
}

$newsType = $result->fetch_assoc();

?>
<div class="content">
    <div class="header">
        <h1 style="display:flex;align-items:center"><span style="font-size:18px;margin-right:10px"><a href="news-types.php">Geri</a></span>/ News Type Update</h1>
        <div class="header-buttons">
        </div>
    </div>

    <form action="_src/business/news-types/update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $newsType['id']; ?>">
        <label class="input-group">
            <div>News Type</div>
            <input type="text" name="news_type" placeholder="News Type" required value="<?php echo $newsType['news_type']; ?>">
        </label>
        <label class="input-group">
            <div>News Type</div>
            <textarea name="news_type_detail" placeholder="News Type" style="resize:none" rows="20" required><?php echo $newsType['news_type_detail']; ?></textarea>
        </label>

        <div class="form-footer">
            <?php if (isset($_GET['status'])) {
                if ($_GET['status'] == 'empty') { ?>
                    <div>Please do not leave any fields empty.</div>
                <?php } elseif ($_GET['status'] == 'success') { ?>
                    <div>News Type successfully updated.</div>
                <?php } elseif ($_GET['status'] == 'error') { ?>
                    <div>Error: News Type could not be updated.</div>
                <?php } elseif ($_GET['status'] == 'exists') { ?>
                    <div>Error: This News Type already exists.</div>
            <?php }
            } ?><button type="submit">Update</button>
        </div>
    </form>

</div>
<?php include '_src/assets/master/footer.php' ?>