<?php include '_src/init.php';

if (isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . 'dashboard');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Dashboard</title>
</head>

<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        padding: 0;
    }

    form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
    }

    input,
    button {
        margin: 5px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 300px;
    }

    button {
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
        width: 320px;
    }
</style>

<body>
    <form action="_src/business/auth/login.php" method="POST">
        <h1>Login Form</h1>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Sign In</button>
        <button onclick="document.location='../index.php'">Go To Home age</button>
        <?php if (isset($_GET['status'])) {
            if ($_GET['status'] == 'empty') { ?>
                <div class="message warning">Please enter a username and password.</div>
            <?php } elseif ($_GET['status'] == 'invalid') { ?>
                <div class="message error">Invalid username or password.</div>
            <?php } elseif ($_GET['status'] == 'error') { ?>
                <div class="message error">Error: Login failed.</div>
        <?php }
        } ?>
    </form>
</body>

</html>