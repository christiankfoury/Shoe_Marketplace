<!DOCTYPE html>
<html lang="en">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="/app/css/style.css" rel="stylesheet">

<head>
	<title>Document</title>
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
								<li><a class="dropdown-item active" href="/Orders/boughtOrders">Bought order history</a></li>
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
			<h1 class="welcome">Bought Orders</h1>
			<div class="innie">
				<div class="gray-flex-box">
					<article style="margin-bottom: 20px">
						<center>
							<?php
							foreach ($data['orders'] as $orders) {

								$listing = new \app\models\Listing();
								$listing = $listing->get($orders->listing_id);
								$shoe = new \app\models\Shoe();
								$shoe = $shoe->getShoeByShoeId($listing->shoe_id);
								$time = new \app\controllers\Time();
								echo
								"
								<table border=1 style='margin-top: 20px; min-width: 60vw;'>
								<tr>
									<td><img src='/uploads/$listing->filename' style='width:200px;height:200px;'></td>
									<td class='orders'><span class='order-bold'>Shoe:</span> $shoe->brand $shoe->name<br>
									<span class='order-bold'>Seller:</span> $orders->seller_username<br>
									<span class='order-bold'>Quantity:</span> $orders->quantity<br>
									<span class='order-bold'>Ordered at:</span> {$time::convertDateTime($orders->timestamp)}<br>
									<span class='order-bold'>Total:</span> $ {$orders->total_price}</td>
									<td class='orders'><span class='order-bold'>Email:</span> $orders->email<br>
									<span class='order-bold'>Address:</span> $orders->address<br>
									<span class='order-bold'>Address 2:</span> $orders->address2<br>
									<span class='order-bold'>Postal Code:</span> $orders->postal_code<br>
									<span class='order-bold'>City:</span> $orders->city<br>
									<span class='order-bold'>Province:</span> $orders->province<br>
									<span class='order-bold'>Country:</span> $orders->country</td>
								</tr>
								</table> 
								";
							}
							?>
						</center>
					</article>
				</div>
			</div>
		</div>
	</div>




	<!-- <div class="createListing">
		<center>
			<h1>Bought Orders</h1>
		</center>
		<article>
			<center> -->
	<?php
	// foreach ($data['orders'] as $orders) {

	// 	$listing = new \app\models\Listing();
	// 	$listing = $listing->get($orders->listing_id);
	// 	$time = new \app\controllers\Time();
	// 	echo
	// 	"
	// <table border=1>
	// <tr>
	// <th><img src='/uploads/$listing->filename' style='width:150px;height:150px;'></th>
	// <th>Seller: $orders->seller_username</th>
	// <th>Quantity: $orders->quantity</th>
	// <th>Email: $orders->email</th>
	// <th>Address: $orders->address</th>
	// <th>Address 2: $orders->address2</th>
	// <th>Postal Code: $orders->postal_code</th>
	// <th>City: $orders->city</th>
	// <th>Province: $orders->province</th>
	// <th>Country: $orders->country</th>
	// <th>{$time::convertDateTime($orders->timestamp)}</th>
	// </tr>
	// </table>; 
	// ";
	// }
	?>
	<!-- </center>
		</article>
	</div> -->

</body>

</html>