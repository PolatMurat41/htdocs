<div class="sidebar">
    <ul>
        <li><a href="./">Home</a></li>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') { ?> <li><a href="./users.php">Users</a></li>
            <li><a href="./messages.php">Messages</a></li> 
            <li><a href="./news-types.php">News Types</a></li> <?php } ?>
        
        <li><a href="./news.php">News</a></li>
        <li><a href="_src/business/auth/logout.php">Logout</a></li>
    </ul>
</div>