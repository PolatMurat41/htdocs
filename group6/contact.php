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
						<a href="index.php" title="Homepage of John Doe">Home</a>
					</li>
					<li><a href="news.php" title="About John Doe">News</a></li>
					<li><a href="authors.php">Authors</a></li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
			</nav>

			
		</header>

		<main>
			

			<section class="contact container">
				<div class="section-title">
					<h2>Get in Touch</h2>
					<h4>Contact</h4>
				</div>

				<div class="section-content">
					<div class="row">
						<div class="info">
							<div class="address">
								<h4>ADDRESS</h4>
								<address>
									Lorem ipsum dolor, sit amet consectetur
									adipisicing.
								</address>
							</div>

							<ol>
								<li>
									<a href="tel:+60444434444"
										><i class="fa-solid fa-phone"></i> (060)
										444 434 444</a
									>
								</li>
								<li>
									<a href="tel:+60444434445"
										><i class="fa-solid fa-fax"></i> (060)
										444 434 445</a
									>
								</li>
								<li>
									<a href="mailto:info@johndoe.com"
										><i class="fa-solid fa-envelope"></i>
										info@johndoe.com</a
									>
								</li>
							</ol>

							<div class="social">
								<h4>FOLLOW ME</h4>
								<ul>
									<li>
										<a
											href="https://linkedin.com"
											target="_blank"
											rel="no-opener no-referrer"
											><i
												class="fa-brands fa-linkedin"
											></i
										></a>
									</li>
									<li>
										<a
											href="https://twitter.com"
											target="_blank"
											rel="no-opener no-referrer"
											><i
												class="fa-brands fa-x-twitter"
											></i
										></a>
									</li>
									<li>
										<a
											href="https://facebook.com"
											target="_blank"
											rel="no-opener no-referrer"
											><i
												class="fa-brands fa-facebook"
											></i
										></a>
									</li>
								</ul>
							</div>
						</div>
						<div>
							<h4>SEND US A NOTE</h4>
							<form action="create_contact.php" method="POST">
								<div>
									<input
										type="text"
										name="name"
										class="form-control"
										id="name"
										placeholder="Name"
									/>
									<input
										type="email"
										name="email"
										class="form-control"
										id="email"
										placeholder="E-mail"
									/>
								</div>
								<div>
									<textarea
										name="message"
										id="message"
										class="form-control"
										cols="30"
										rows="5"
										placeholder="Your message"
									></textarea>
								</div>
								<div class="text-center">
								<?php if (isset($_GET['status'])) {
										if ($_GET['status'] == 'empty') { ?>
											<div>Please do not leave any fields empty.</div>
										<?php } elseif ($_GET['status'] == 'success') { ?>
											<div>Your message successfully sended.</div>
										<?php } elseif ($_GET['status'] == 'error') { ?>
											<div>Error: Your message could not be sended.</div>
									<?php }
									} ?>
									<button class="btn btn-bg" type="submit">Send Message</button>
								</div>
							</form>
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
