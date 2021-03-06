<!DOCTYPE html>
<html lang="en">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="/app/css/style.css" rel="stylesheet">

<head>
	<title>For You Page</title>
</head>

<body>
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
							<a class="nav-link active" aria-current="page" href="#">Home</a>
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
							<a class="nav-link" href="/Message/index">Messages</a>
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
					<br>
					<form class="d-flex" method="post">
						<select class="custom-select mr-sm-2 me-2" style="flex: 1;" placeholder="Search by brand" name="searchBrand">
							<option value="Jordan">Jordan</option>
							<option value="Nike">Nike</option>
							<option value="Adidas">Adidas</option>
							<option value="Vans">Vans</option>
							<option value="New Balance">New Balance</option>
						</select>
						<button class="btn btn-outline-success" type="submit" name="searchBrandButton">Search by brand</button>
					</form>
				</div>
			</div>
		</div>
	</nav>
	<div class="main">
		<div style="padding: 20px;">
			<h1 class="welcome">Welcome <?php echo "{$data['user']->first_name} {$data['user']->last_name}!" ?></h1>
			<a href="/Listing/allListings" class="button">Click here to explore all listings</a><br><br>
			<h2 style="font-weight: bolder;">For You - Personalised according to your taste and size</h2><br>

			<div class="innie">
				<h3>Some shoes to look out for in the future. <span class="small">Based on your favorite color but not in your size.<span></h3>
				<?php
				if (count($data['listingsColor']) == 0) {
					echo "<div class=\"alert alert-dark\" role=\"alert\">No listings now! Please try again later.</div>";
				} else {
					echo "<div class=\"gray-flex-box\">";
				}
				?>
				<?php foreach ($data['listingsColor'] as $listing) : ?>
					<div class="card">
						<img class="card-img-top" src="/uploads/<?php echo $listing->filename ?>" alt="Card image cap">
						<div class="card-body">
							<?php $shoe = new \app\models\Shoe;
							$shoe = $shoe->getShoeByShoeId($listing->shoe_id) ?>
							<h5 class="card-title"><?php echo $shoe->brand . " " . $shoe->name ?></h5>
							<p class="card-text">Color: <?php echo $listing->color;?></p>
                            <p class="card-text">Size: US Men's <?php echo $listing->size;?></p>
							<p class="card-text">$<?php echo $listing->price ?></p>
							<a href="/Listing/viewListing/<?php echo $listing->listing_id ?>" class="btn btn-primary">View</a>
						</div>
					</div>
				<?php endforeach ?>
				<?php if (count($data['listingsColor']) > 0) {
					echo "</div>";
				} ?>
				<br>
				<h3>Some listings based your favorite color and available in your size.</h3>
				<?php
				if (count($data['listingsColorSize']) == 0) {
					echo "<div class=\"alert alert-dark\" role=\"alert\">No listings now! Please try again later.</div>";
				} else {
					echo "<div class=\"gray-flex-box\">";
				}

				foreach ($data['listingsColorSize'] as $listing) : ?>
					<div class="card" style="width: 18rem;">
						<img class="card-img-top" src="/uploads/<?php echo $listing->filename ?>" alt="Card image cap">
						<div class="card-body">
							<?php $shoe = new \app\models\Shoe;
							$shoe = $shoe->getShoeByShoeId($listing->shoe_id) ?>
							<h5 class="card-title"><?php echo $shoe->brand . " " . $shoe->name ?></h5>
							<p class="card-text">Color: <?php echo $listing->color;?></p>
                            <p class="card-text">Size: US Men's <?php echo $listing->size;?></p>
							<p class="card-text">$<?php echo $listing->price ?></p>
							<a href="/Listing/viewListing/<?php echo $listing->listing_id ?>" class="btn btn-primary">View</a>
						</div>
					</div>
				<?php endforeach ?>
				<?php if (count($data['listingsColor']) > 0) {
					echo "</div>";
				} ?>
			</div>
		</div>
	</div>

</body>

</html>