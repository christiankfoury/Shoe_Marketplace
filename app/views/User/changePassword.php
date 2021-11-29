<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Password</title>
    <?php 
    if (isset($data['error'])) {
        echo $data['error'];
    }
    ?>
</head>
<body>
    <h1>Change Password for <?php echo $data['user']->username ?></h1>
  <form action="" method="post">
      <label>Current Password: </label>
      <input type="password" name="current_password"></input><br>
      <label>New Password: </label>
      <input type="password" name="new_password"></input><br>
      <label>Confirm New Password: </label>
      <input type="password" name="password_confirm"></input><br>
      <input type="submit" name="action" value="Change"></input><br>
  </form>  
</body>
</html>