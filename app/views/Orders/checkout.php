<!DOCTYPE html>
<html lang="en">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="/app/script/checkout.js"></script>

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


  <h4 style='margin-top:150px;'>Checkout</h4>
  <?php
  $listing = new \app\models\Listing();
  $listing = $listing->get($data['order']->listing_id);
  echo "<img src='/uploads/$listing->filename' style='width:150px;height:150px;'><br>
        <h4>size: $listing->size</h4>";
  ?>

  <?php
  if (isset($data['error'])) {
    echo "<h4>{$data['error']}</h4>";
  }
  ?>
  <form method="post" action="">
    <h4>Shipping information</h4>
    <?php
    echo "Quantity: <select name='quantity'>";
    for ($i = 1; $i <= $listing->stock; $i++) {
      echo "<option value='$i'>$i</option>";
    }
    echo "</select><br>";
    ?>
    Email: <input type="email" name="email" placeholder="bob@gmail.com" pattern="(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|'(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*')@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])"><br>
    First Name: <input disabled value="<?php echo $data['user']->first_name ?>" type="text" name="fName"><br>
    Last Name: <input disabled value="<?php echo $data['user']->last_name ?>" type="text" name="lName"><br>
    Address: <input type="text" name="address" maxlength="50"><br>
    Address 2: <input type="text" name="address2" placeholder="apt,suite,etc." maxlength="50"><br>
    Postal Code: <input id="postal_code" type="text" name="postal_code" placeholder="A1A 1A1" minlength="6" maxlength="7"><br>
    City: <input type="text" name="city"><br>
    <?php
    $provinces = ['AB', 'BC', 'MB', 'NB', 'NL', 'NS', 'NT', 'NU', 'ON', 'PE', 'QC', 'SK', 'YT'];
    echo
    "
    Province:
    <select name='province'>";

    foreach ($provinces as $province) {
      echo "<option value='$province'>$province</option>";
    }

    echo
    "
    </select><br>
    ";
    ?>
    Country: <input disabled value="Canada" type="text" name="country"><br>
    <h4>Payment Information</h4>
    Card Number: <input id="card_number" type="text" name="card_number" placeholder="4519 9999 9999 9999" maxlength="19">
    Name on Card: <input type="text" name="card_name" placeholder="Bob Appleseed"><br>
    Expiration: <input type="month" name="expiration" placeholder="MM/YY">
    Security Code: <input type="text" pattern="^[0-9]*$" name="security_code" placeholder="999" maxlength="3"><br>
    <input type="submit" name="action" value="Place Order">
  </form>
</body>

</html>