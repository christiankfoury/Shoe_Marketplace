<!DOCTYPE html>
<html lang="en">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="/app/css/style.css" rel="stylesheet">

<head>
	<title>Your Inbox</title>
</head>

<body style="background: white;">
	<nav class="navbar navbar-light bg-light fixed-top">
		<div class="container-fluid">
			<a class="navbar-brand mx-auto" href="/User/index" style="margin-left: 50px;"><img src="/uploads/monkey.png" style="height: 100px"></a></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
				<div class="offcanvas-header">
					<h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
					<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
				</div>
				<div class="offcanvas-body">
					<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
						<li class="nav-item">
							<a class="nav-link" aria-current="page" href="/User/index">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/Listing/index">Listings</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/Wishlist/index">Wishlist</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/Orders/viewCart">Cart</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="/Message/index">Messages</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/User/changePassword">Change Password</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/User/logout">Logout</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								Order history
							</a>
							<ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
								<li><a class="dropdown-item" href="/Orders/boughtOrders">Bought order history</a></li>
								<li>
									<hr class="dropdown-divider">
								</li>
								<li><a class="dropdown-item" href="/Orders/soldOrders">Sold order history</a></li>
							</ul>
						</li>
					</ul>
					<form class="d-flex" method="post">
						<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="searchBox">
						<button class="btn btn-outline-success" type="submit" name="search">Search</button>
					</form>
				</div>
			</div>
		</div>
	</nav>
	<div class="main">
		<div style="padding: 20px;">
			<h1 class="welcome">Messages</h1>
			<div class="innie">
				<div class="gray-flex-box">
					<div class="inbox left-radius">
						<h2 style="margin-bottom: 20px;">Inbox</h2>
						<?php
						foreach ($data["inbox"] as $messages) {
							echo
							"
							<table class='inbox-outbox-table'>
								<tr>
									<th>From: $messages->sender</th>
									<th style='text-align:right; white-space:nowrap;'>At $messages->timestamp</th>
								</tr>
								<tr>
									<td>$messages->message Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestias aut, repellat ipsum facere voluptate dicta obcaecati deserunt nobis suscipit eaque?</td>
									<td style='text-align:right'><div class='reply-div'><a class='reply-button' href='\Message\createMessage\\$messages->receiver\\$messages->sender'>Reply</a></div></td>
								</tr>
							</table>
							";
						}
						?>
					</div>
					<div class="outbox right-radius">
						<h2 style="margin-bottom: 20px">Outbox</h2>
						<?php
						foreach ($data["outbox"] as $messages) {
							echo
							"
							<table class='inbox-outbox-table'>
								<tr>
									<th>To: $messages->receiver</th>
									<th style='text-align:right; white-space:nowrap;'>At $messages->timestamp</th>
								</tr>
								<tr>
									<td>$messages->message</td>
									<td style='text-align:right'><div class='reply-div'><a class='reply-button' href='\Message\createMessage\\$messages->sender\\$messages->receiver'>Send again</a></div></td>
								</tr>
							</table>
							";
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- <div class="createListing">
		<center>
			<h1>Messages</h1>
		</center>
		<article>
			<center>
				<h1>Inbox</h1>
				<?php
				// foreach ($data["inbox"] as $messages) {
				// 	echo
				// 	"
				// <table border=1>
				// <tr>
				// <th>$messages->sender</th>
				// <th>$messages->message</th>
				// <th>$messages->timestamp</th>
				// <th><a href='\Message\createMessage\\$messages->receiver\\$messages->sender'>Reply</a></th>
				// </tr>
				// </table>
				// ";
				// }
				?>
				<br>
				<h1>Outbox</h1>
				<?php
				// foreach ($data["outbox"] as $messages) {
				// 	echo
				// 	"
				// <table border=1>
				// <tr>
				// <th>$messages->receiver</th>
				// <th>$messages->message</th>
				// <th>$messages->timestamp</th>
				// <th><a href='\Message\createMessage\\$messages->sender\\$messages->receiver'>Send again</a></th>
				// </tr>
				// </table>
				// ";
				// }
				?>
			</center>
		</article>
	</div> -->

</body>

</html>