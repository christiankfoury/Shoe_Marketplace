<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Listing</title>
</head>
<body>
    <a href="/Listing/index">Return to Listings</a>
    <center><h1>View Listing</h1>
    <img src="<?php echo $data->filename; ?>">
    <?php 
    echo 
    "
    <h4>$data->shoe_id</h4>
    <h4>$data->seller_username</h4>
    <h4>$data->size</h4>
    <h4>$data->stock</h4>
    <h4>$data->price</h4>
    ";
    if(!$_SESSION['username'] == $data->seller_username){
        $username = $_SESSION['username'];
        echo 
        "
        <h4><a href='\Message\createMessage\\$username\\$data->seller_username'>Contact Seller</a></h4>
        <h4><a href=''>Purchase</a></h4>";
    }
    ?>
    </center>
</body>
</html>