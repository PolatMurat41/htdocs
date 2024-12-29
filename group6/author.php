<?php
include 'dashboard/_src/init.php';

// url parametresini kontrol et
if (!isset($_GET['url'])) {
	header('Location: authors.php');
	exit;
}

$url = security($_GET['url']);

// Prepared statement kullanarak SQL sorgusu
$stmt = $conn->prepare("SELECT * FROM users WHERE seo_url = ? AND role = 'Writer'");
$stmt->bind_param("s", $url);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
	header('Location: authors.php');
	exit;
}

$user = $result->fetch_assoc();
$id = intval($user['id']);
$news = $conn->query("SELECT * FROM news WHERE writer_id = $id");
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>TrueScope | EEEN372 Project</title>
	<meta
		name="description"
		content="John Doe is a software developer with 10 years of experience. He specializes in various languages, including Java, Python, and C++. He has developed large-scale web applications, mobile applications, and games." />
	<meta name="author" content="John Doe" />
	<meta name="copyright" content="Copyright 2024, John Doe" />
	<meta name="robots" content="index, follow" />

	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link
		href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
		rel="stylesheet" />
	<link
		rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
		integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
		crossorigin="anonymous"
		referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="assets/css/style.css" />

</head>

<body>
	<header>
		<h1>TrueScope</h1>

		<nav class="social-menu">
			<ul>
				<li>
					<a
						href="https://linkedin.com"
						target="_blank"
						rel="no-opener no-referrer"><i class="fa-brands fa-linkedin"></i></a>
				</li>
				<li>
					<a
						href="https://twitter.com"
						target="_blank"
						rel="no-opener no-referrer"><i class="fa-brands fa-x-twitter"></i></a>
				</li>
				<li>
					<a
						href="https://facebook.com"
						target="_blank"
						rel="no-opener no-referrer"><i class="fa-brands fa-facebook"></i></a>
				</li>
			</ul>
		</nav>

		<label for="chkMenu" class="lbl-menu"><i class="fa-solid fa-bars fa-2x"></i></label>
		<input type="checkbox" id="chkMenu" class="chk-menu" />
		<nav class="main-menu">
			<ul>
				<li>
					<a href="index.php" title="Homepage of John Doe">Home</a>
				</li>
				<li><a href="news.php">News</a></li>
				<li><a href="authors.php">Authors</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</nav>


	</header>

	<main>

		<section class="about container">
			<div class="section-title">
				<h2>About</h2>
				<h4><?php echo $user['fullname']; ?></h4>
			</div>


			<div class="section-content">
				<div class="row">

					<div>
						<p><?php echo $user['description']; ?></p>
					</div>
					<div><img src="<?php echo $user['image']; ?>" alt="<?php echo $user['fullname']; ?>"></div>
				</div>
			</div>
		</section>

		<section class="resume container">
			<div class="section-title">
				<h2><?php echo $user['fullname']; ?></h2>
				<h4>News</h4>
			</div>

			<div class="section-content">
				<div class="row">
					<div>
						<ul class="experience" style="display:grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
							<?php

							if ($news->num_rows > 0) {
								while ($row = $news->fetch_assoc()) { ?>
									<li>
										<h4><a href="news-detail.php?url=<?php echo $row['seo_url'] ?>"><?php echo $row['news_title'] ?></a></h4>
										<p><?php echo $row['news_summary'] ?></p>
									</li>
							<?php }
							} ?>
						</ul>
					</div>
				</div>
			</div>
		</section>

	</main>

	<footer class="container">
		<div class="row">
			<p>Copyright &copy;2023 <span class="text-green">TrueScope</span>. All rights reserved.</p>

			<nav>
				<ul>
					<li><a href="#">Terms &amp; Policy</a></li>
					<li><a href="#">Disclaimer</a></li>
				</ul>
			</nav>
		</div>
	</footer>
</body>

</html>