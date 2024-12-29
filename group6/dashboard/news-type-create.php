<?php include '_src/assets/master/header.php' ?>
<div class="content">
    <div class="header">
        <h1 style="display:flex;align-items:center"><span style="font-size:18px;margin-right:10px"><a href="news-types.php">Geri</a></span>/ News Type Create</h1>
        <div class="header-buttons">
        </div>
    </div>

    <form action="_src/business/news-types/create.php" method="POST">
        <label class="input-group">
            <div>News Type</div>
            <input type="text" name="news_type" placeholder="News Type" required>
        </label>
        <label class="input-group">
            <div>News Type</div>
            <input type="text" name="news_type_detail" placeholder="News Type Detail" required>
        </label>

        <div class="form-footer">
            <?php if (isset($_GET['status'])) {
                if ($_GET['status'] == 'empty') { ?>
                    <div>Please do not leave any fields empty.</div>
                <?php } elseif ($_GET['status'] == 'success') { ?>
                    <div>News Type successfully created.</div>
                <?php } elseif ($_GET['status'] == 'error') { ?>
                    <div>Error: News Type could not be created.</div>
                <?php } elseif ($_GET['status'] == 'exists') { ?>
                    <div>Error: This News Type already exists.</div>
            <?php }
            } ?><button type="submit">Create</button>
        </div>
    </form>

</div>
<?php include '_src/assets/master/footer.php' ?>