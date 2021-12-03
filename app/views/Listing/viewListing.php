<!DOCTYPE html>
<html lang="en">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="/app/css/style.css" rel="stylesheet">

<head>
    <title>View Listing</title>
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
            <h1 class="welcome">Listings Details</h1>
            <div class="innie" style="min-height: 600px;">
                <h4><a href="/User/index" class="button">Return to For You</a></h4><br>
                <h4><a href="/Listing/allListings" class="button">Return to all listings</a></h4><br>
                <?php
                $shoe = new app\models\Shoe();
                $shoe = $shoe->getShoeByShoeId($data['listing']->shoe_id);
                $count = count($data['reviews']);
                echo
                "
                <div class='picture-left'><img src='/uploads/{$data['listing']->filename}' style='width: 600px; height: 600px'></div>
                <div class='text-right'><h4>Shoe: {$shoe->brand} {$shoe->name}</h4>
                <h4>Seller username: {$data['listing']->seller_username}</h4>
                <h4>Shoe size: {$data['listing']->size}</h4>
                <h4>Stock left: {$data['listing']->stock}</h4>
                <h4>Price: $ {$data['listing']->price}</h4>
                <h4>Reviews ($count)</h4><br>
                ";
                if ($_SESSION['username'] != $data['listing']->seller_username) {
                    $username = $_SESSION['username'];
                    echo
                    "<h4 class='margin-bottom-button'><a class='button' href='/Message/createMessage/$username/{$data['listing']->seller_username}'>Contact Seller</a></h4>";

                    $order = new \app\models\Orders();
                    $order->listing_id = $data['listing']->listing_id;
                    $order->buyer_username = $_SESSION['username'];
                    $order = $order->getByListingAndBuyer();
                    if ($order != false) {
                        echo "<h4 class='margin-bottom-button'><a class='button' href='/Orders/removeFromCart/$order->order_id/{$data['listing']->listing_id}'>Remove From Cart</a></h4>";
                    } else {
                        echo "<h4 class='margin-bottom-button'><a class='button' href='/Orders/addToCart/{$data['listing']->listing_id}'>Add To Cart</a></h4>";
                    }

                    $wishlist = new \app\models\Wishlist();
                    $wishlist->shoe_id = $data['listing']->shoe_id;
                    $wishlist->color = $data['listing']->color;
                    $wishlist->username = $_SESSION['username'];
                    $wishlist = $wishlist->getByShoeAndColor();
                    if ($wishlist == false) {
                        echo "<h4 class='margin-bottom-button'><a class='button' href='/Wishlist/add/{$data['listing']->shoe_id}/{$data['listing']->color}/{$data['listing']->listing_id}'>Add to Wishlist</a></h4>";
                    } else {
                        echo "<h4 class='margin-bottom-button'><a class='button' href='/Wishlist/remove/{$data['listing']->shoe_id}/{$data['listing']->color}/{$data['listing']->listing_id}'>Remove from Wishlist</a></h4>";
                    }
                }
                if (count($data['reviews']) > 0) {
                    echo "<div class='reviews-list'>";
                }

                foreach ($data['reviews'] as $review) {
                    echo
                    "
                    <div class='review'>
                        <h4><u>Review from: {$review->username}</u></h4>
                        <h4 style='font-weight: 400;'>{$review->message}</h4>
                    ";
                    if ($review->username == $_SESSION['username']) {
                        echo
                        "
                        <br>
                        <h4 class='margin-bottom-button'><a class='button' href='/Review/editReview/{$data['listing']->listing_id}/{$review->review_id}'>Edit</a></h4>
                        <h4 class='margin-bottom-button'><a class='button' href='/Review/deleteReview/{$data['listing']->listing_id}/{$review->review_id}'>Delete</a></h4>
                        ";
                    }
                    echo "</div>";
                }
                if (count($data['reviews']) > 0) {
                    echo "</div>";
                }
                ?>

                <form action="" method="post">
                    <textarea class="textarea-review" placeholder="Write a review" name="message" id="message" cols="30" rows="10"></textarea>
                    <input type="submit" name="actionReview" value="Submit">
                </form>
            </div>

        </div>
    </div>
    </div>



</body>

</html>