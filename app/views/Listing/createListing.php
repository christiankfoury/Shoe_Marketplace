<!DOCTYPE html>
<html lang="en">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link href="/app/css/style.css" rel="stylesheet">
<script src="/app/script/javascript.js"></script>

<head>
  <title>Create a Listing</title>
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
              <a class="nav-link" aria-current="page" href="#">Home</a>
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
              <a class="nav-link" href="/User/settings">Settings</a>
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
  <div class="createListing">
    <center>
      <h1>Listings</h1>
    </center>
    <?php if(isset($data['error'])){echo "<h4 style='color:red;'>{$data['error']}</h4>";} ?>
    <article>
      <!-- <center> -->
      <form action='' method='post' enctype="multipart/form-data">
        Brand: <select name="brand" id="brand">
          <option value="Select a brand">Select a brand</option>
          <option value="Jordan">Jordan</option>
          <option value="Nike">Nike</option>
          <option value="Adidas">Adidas</option>
          <option value="Vans">Vans</option>
          <option value="New Balance">New Balance</option>
        </select>
        <br>
        Model: <select name="model" id="model">
          <option value="Select a brand" selected="selected">Select a brand first</option>
        </select>
        <br>
        Color:<select name="color">
          <option value="Yellow">Yellow</option>
          <option value="Blue">Blue</option>
          <option value="Red">Red</option>
          <option value="Black">Black</option>
          <option value="White">White</option>
        </select><br>
        Size: <select name="size">
          <?php for ($i = 1; $i <= 35; $i++) { ?>
            <option value="<?php echo $i; ?>"><?php echo "US Size " . $i ?></option>
            <?php if ($i != 35) { ?>
              <option value="<?php echo $i + .5; ?>"><?php echo "US Size " . $i + .5 ?></option>
            <?php } ?>
          <?php } ?>
        </select><br>
        Stock: <select name="stock">
          <?php for ($i = 1; $i <= 9; $i++) { ?>
            <option value="<?php echo $i; ?>"><?php echo $i ?></option>
          <?php } ?>
        </select><br>
        Price: <input type='number' name='price' step=".01" /><br>
        Description <input type='textarea' name='description' /><br>
        Picture: <input type='file' name='newPicture' /><br>
        <input type='submit' name='action' value='Create' />
        <!-- </center> -->
    </article>
  </div>

</body>

</html>