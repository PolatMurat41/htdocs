<?php include 'dashboard/_src/init.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>TrueScope | EEEN372 Project</title>
		<meta
			name="description"
			content="John Doe is a software developer with 10 years of experience. He specializes in various languages, including Java, Python, and C++. He has developed large-scale web applications, mobile applications, and games."
		/>
		<meta name="author" content="John Doe" />
		<meta name="copyright" content="Copyright 2024, John Doe" />
		<meta name="robots" content="index, follow" />

		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link
			href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
			rel="stylesheet"
		/>
		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
			integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		/>
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
							rel="no-opener no-referrer"
							><i class="fa-brands fa-linkedin"></i
						></a>
					</li>
					<li>
						<a
							href="https://twitter.com"
							target="_blank"
							rel="no-opener no-referrer"
							><i class="fa-brands fa-x-twitter"></i
						></a>
					</li>
					<li>
						<a
							href="https://facebook.com"
							target="_blank"
							rel="no-opener no-referrer"
							><i class="fa-brands fa-facebook"></i
						></a>
					</li>
				</ul>
			</nav>

			<label for="chkMenu" class="lbl-menu"><i class="fa-solid fa-bars fa-2x"></i></label>
			<input type="checkbox" id="chkMenu" class="chk-menu"/>
			<nav class="main-menu">
				<ul>
					<li>
						<a href="index.php">Home</a>
					</li>
					<li><a href="news.php">News</a></li>
					<li><a href="authors.php">Authors</a></li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
			</nav>

			
		</header>

		<main>
			

			

			<section class="resume container">
				<div class="section-title">
					<h2>News</h2>
					<h4>Categories</h4>
				</div>


				<?php
					$result = $conn->query("SELECT * FROM news_types");
					$counter = 0;
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) { 
							if($counter % 2 == 0){
								$counter++?>
							<div class="row">
								<div>
									<ul class="experience">
										<li>
										<a href="categoryNew.php?url=<?php echo $row['id']; ?>"><h4><?php echo $row['news_type']; ?></h4></a>
											<p>
											<?php echo substr($row['news_type_detail'], 0, 200) . '...'; ?>
											</p>
										</li>
									</ul>
								</div>
							<?php }
							else{
								$counter++?>
							<div>
									<ul class="experience">
										<li>
										<a href="categoryNew.php?url=<?php echo $row['id']; ?>"><h4><?php echo $row['news_type']; ?></h4></a>
											<p>
											<?php echo substr($row['news_type_detail'], 0, 200) . '...'; ?>
											</p>
										</li>
									</ul>
								</div>
							</div>
								<?php }
							}
					} ?>
			</section>

			<section class="what-i-do container">
				<div class="section-title">
					<h2>Top 10</h2>
					<h4>News</h4>
				</div>

				<div class="section-content">
				<div class="row">
					<ul style="display:grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
						<?php
						$result = $conn->query("SELECT * FROM news ORDER BY update_at DESC LIMIT 10");

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

			<section class="about container">
				<div class="section-title">
					<h2>About US</h2>
					<h4>Know We More</h4>
				</div>

				<div class="section-content">
					<div class="row">
						<div>
							<h3><span class="text-green">TrueScope</span>, trusted news</h3>
							<p>
								Welcome to TrueScope, your trusted source for timely, accurate, and unbiased news. Our mission is to inform, inspire, and empower our readers by delivering high-quality journalism that matters.
							</p>
							<p>
								At TrueScope, we cover a wide range of topics, including breaking news, politics, business, technology, entertainment, sports, and lifestyle. Our dedicated team of journalists and contributors works tirelessly to provide in-depth analysis, thought-provoking opinions, and fresh perspectives on the stories shaping our world.
							</p>
							<p>
								We believe in the power of information to drive change and foster understanding. That’s why we’re committed to upholding the highest standards of integrity, transparency, and accountability in all our reporting.
							</p>
							<p>
								Whether you’re seeking the latest headlines or a deeper dive into today’s most pressing issues, TrueScope is here to keep you informed, connected, and engaged.
							</p>
							<p>
								Thank you for choosing TrueScope as your go-to news source. Together, let’s stay informed and stay ahead.
							</p>
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
