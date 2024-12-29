<?php include 'dashboard/_src/init.php'; ?>
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
		<section class="clients container">
			<div class="section-title">
				<h2>Get to know us</h2>
				<h4>Authours</h4>
			</div>

			<div class="section-content">
				<div class="rows" style="display:grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
					<?php
					$result = $conn->query("SELECT * FROM users WHERE role='Writer'");
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) { ?>

							<div class="testimonial">
								<div class="title">
									<img src="<?php echo $row['image']; ?>" alt=<?php echo $row['fullname']; ?> />

									<div>
										<a href="author.php?url=<?php echo $row['seo_url']; ?>">
											<h4><?php echo $row['fullname']; ?></h4>
										</a>
										<p>Author</p>
										<p><?php echo $row['fullname']; ?></p>
									</div>
								</div>
								<p>
									<?php echo substr($row['description'], 0, 200) . '...'; ?>
								</p>
							</div>
					
					
					
					<?php }
					} ?>
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