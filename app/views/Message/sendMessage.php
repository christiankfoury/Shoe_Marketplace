<!DOCTYPE html>
<html lang="en">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="/app/css/style.css" rel="stylesheet">

<head>
    <title>Create a Message</title>
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

    <div class="main">
        <div style="padding: 20px;">
            <h1 class="welcome">Create a Message</h1>
            <center>
                <div class="login-register-box" style="margin-bottom: 20px;">
                    <div style="text-align: left;">
                        <form action="" method="post">
                            <label>Sender</label><br>
                            <input class="login-register" disabled type="text" name="sender" value="<?php echo $data->sender; ?>"> </input><br>
                            <label>Receiver</label><br>
                            <input class="login-register" disabled type="text" name="sender" value="<?php echo $data->receiver; ?>"> </input><br>
                            <label>Message</label><br>
                            <textarea style="resize: both; max-width: 500px;" name="message" placeholder="Type your message here..."></textarea><br>
                            <input class="login-register-button" type="submit" name="action" value="Send"></input>
                        </form>
                    </div>
                </div>
            </center>
        </div>
    </div>
</body>

</html>