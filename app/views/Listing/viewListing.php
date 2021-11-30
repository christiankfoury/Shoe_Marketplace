<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Listing</title>
</head>

<body>
    <a href="/User/index">Return to For You</a><br>
    <a href="/Listing/allListings">Return to all listings</a>
    <center>
        <h1>View Listing</h1>
        <?php
        echo
        "
    <h4><img src='/uploads/$data->filename' style='width: 100px'></h4>
    <h4>$data->shoe_id</h4>
    <h4>$data->seller_username</h4>
    <h4>$data->size</h4>
    <h4>$data->stock</h4>
    <h4>$data->price</h4>
    ";
        if ($_SESSION['username'] != $data->seller_username) {
            $username = $_SESSION['username'];
            echo
            "
        <h4><a href='/Message/createMessage/$username/$data->seller_username'>Contact Seller</a></h4>
        <h4><a href=''>Purchase</a></h4>";
        
        $wishlist = new \app\models\Wishlist();
        $wishlist->shoe_id = $data->shoe_id;
        $wishlist->color = $data->color;
        $wishlist->username = $_SESSION['username'];
        $wishlist = $wishlist->getByShoeAndColor();
        if($wishlist == false){
            echo "<h4><a href='/Wishlist/add/$data->shoe_id/$data->color/$data->listing_id'>Add to Wishlist</a></h4>";
        }
        else{
            echo "<h4><a href='/Wishlist/remove/$data->shoe_id/$data->color/$data->listing_id'>Remove from Wishlist</a></h4>";
        }
        }
        ?>
    </center>
</body>

</html>