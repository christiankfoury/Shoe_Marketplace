<!DOCTYPE html>
<html lang="en">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<head>
  <title>Checkout</title>
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
              <a class="nav-link" href="/Message/index">Messages</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/User/settings">Settings</a>
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
            <button class="btn btn-outline-success" type="submit" name="action">Search</button>
          </form>
        </div>
      </div>
    </div>
  </nav>

  <center><h4 style='margin-top:150px;'>Checkout</h4></center>
  <?php 
        $listing = new \app\models\Listing();
        $listing = $listing->get($data['order']->listing_id);
        echo "<center><img src='/uploads/$listing->filename' style='width:150px;height:150px;'><br>
        <h4>size: $listing->size</h4>
        <h4>quantity: {$data['order']->quantity}</h4></center>";
  ?>

    <form method="post" action="">
        <h4>Shipping information</h4>
        Email: <input type="text" name="email"><br>
        First Name: <input disabled value="<?php echo $data['user']->first_name ?>" type="text" name="fName"><br>
        Last Name: <input disabled value="<?php echo $data['user']->last_name ?>" type="text" name="lName"><br>
        Address: <input type="text" name="address"><br>
        Address 2: <input type="text" name="address2" placeholder="apt,suite,etc."><br>
        Postal Code: <input type="text" name="postal_code"><br>
        City: <input type="text" name="city"><br>
        Province: <input type="text" name="province"><br>
        Country: <input disabled value="Canada" type="text" name="country"><br>
        <h4>Payment Information</h4>
        Card Number: <input type="text" name="card_number" placeholder="1111 2222 3333 4444">
        Name on Card: <input type="text" name="card_name" placeholder="Bob Appleseed">
        Expiration Date: <input type="text" name="expiration" placeholder="MM/YY">
        Security Code: <input type="text" name="security_code" placeholder="999"><br>
        <input type="submit" name="action" value="Place Order">
    </form>
</body>

</html>