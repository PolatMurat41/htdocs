
<?php
include 'dashboard/_src/init.php';

// url parametresini kontrol et
if (!isset($_GET['url'])) {
	header('Location: index.php');
	exit;
}

$url = security($_GET['url']);

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
				<li><a href="news.php" title="About John Doe">News</a></li>
				<li><a href="authors.php">Authors</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</nav>


	</header>

	<main>

		<section class="what-i-do container">
			<div class="section-title">
				<h2>Last Uploaded</h2>
				<h4>News</h4>
			</div>

			<div class="section-content">
				<div class="row">
					<ul style="display:grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
						<?php
						$result = $conn->query("SELECT * FROM news WHERE news_type_id = $url");

						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) { ?>

								<li>
									<div>
										<h3><a href="news-detail.php?url=<?php echo $row['seo_url'] ?>"><?php echo $row['news_title'] ?></a></h3>
										<p><?php echo $row['news_summary'] ?></p>
										<img src="<?php echo $row['news_image'] ?>" alt="<?php echo $row['news_title'] ?>" style="margin-top:10px" />
									</div>
								</li>
						<?php }
						} ?>
						

					</ul>
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