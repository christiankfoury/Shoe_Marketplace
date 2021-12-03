<!DOCTYPE html>
<html lang="en">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="/app/css/style.css" rel="stylesheet">

<head>
    <title>Edit Listing</title>
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

    <div class="main">
        <div style="padding: 20px;">
        <a class="button" href="/User/index" >Return to For You</a>
        <a class="button" href="/Listing/allListings" >Return to all listings</a>
        <h1 class="welcome" style="margin-top:15px;">Edit your listing</h1>
            <div class="innie">
                <div class="gray-flex-box">
                    <?php if (isset($data['error'])) {
                        echo "<h4 style='color:red;'>{$data['error']}</h4>";
                    } ?>
                    <form method="post" action="" enctype="multipart/form-data" style="margin-top:10px;margin-bottom:10px;">
                        <img src="/uploads/<?php echo $data['listing']->filename; ?>"><br>
                        Picture: <input type='file' name='newPicture' style="margin-top:15px;"/><br>
                        Brand: <input class="listing" disabled type="text" value="<?php echo $data['shoe']->brand ?>"><br>
                        Model: <input class="listing" disabled type="text" value="<?php echo $data['shoe']->name ?>"><br>
                        Color: <input class="listing" disabled type="text" value="<?php echo $data['listing']->color ?>"><br>
                        Size: <select class="listing" name="size">
                            <?php for ($i = 1; $i <= 35; $i++) { ?>
                                <option value="<?php echo $i; ?>"><?php echo "US Size " . $i ?></option>
                                <?php if ($i != 35) { ?>
                                    <option value="<?php echo $i + .5; ?>"><?php echo "US Size " . $i + .5 ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select><br>
                        Stock: <select class="listing" name="stock">
                            <?php for ($i = 1; $i <= 9; $i++) { ?>
                                <option value="<?php echo $i; ?>"><?php echo $i ?></option>
                            <?php } ?>
                        </select><br>
                        Price: <input class="listing" type='number' name='price' step=".01" value="<?php echo $data['listing']->price ?>>" /><br>
                        Description <input class="listing" type='textarea' name='description' value="<?php echo $data['listing']->description ?>" /><br>
                        <input class="button" type="submit" name="edit" value="Save" style="margin-top:15px;">
                    </form>
                </div>
            </div>
        </div> 
    </div>
</body>

</html>