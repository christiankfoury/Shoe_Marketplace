<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Quicksand&family=Sacramento&display=swap" rel="stylesheet">
<link href="/app/css/style.css" rel="stylesheet">

<head>
	<title>Register</title>
</head>

<body>
	<a href="/User/login"><span>Login Here</span></a><br><br>
	<h1>Register for new user!</h1>
	<center>
		<div class="box">
			<?php
			if ($data != null) {
				echo "<div class=\"alert alert-danger\" role=\"alert\" style=\"width: 400px; height: 50px;\">$data</div>";
			} else {
				// echo "<div class=\"alert alert-light\" role=\"alert\">Registration</div>";
				echo "<br><br>";
			}

			?>
			<form action='' method='post'>
				<div style="text-align: left;">
					First Name: <br> <input type='text' name='first_name' />
					<br>
					Last Name: <br><input type='text' name='last_name' /><br>
					Favorite Color: <br> <select name="favorite_color">
						<?php
						$colors = ['Yellow', 'Blue', 'Red', 'Black', 'White']; ?>
						<?php foreach ($colors as $color) { ?>
							<option value="<?php echo $color; ?>"><?php echo $color; ?></option>
						<?php } ?>
					</select><br>

					Size: <br> <select name="size">
						<?php for ($i = 1; $i <= 35; $i++) { ?>
							<option value="<?php echo $i; ?>"><?php echo "US Size " . $i ?></option>
							<?php if ($i != 35) { ?>
								<option value="<?php echo $i + .5; ?>"><?php echo "US Size " . $i + .5 ?></option>
							<?php } ?>
						<?php } ?>
					</select><br><br>
					Username: <br> <input type='text' name='username' /><br>
					Password: <br> <input type='password' name='password' /><br>
					Password confirmation: <br> <input type='password' name='password_confirm' /><br>
					<input class="rainbow rainbow-5" type='submit' name='action' value='Register' />
				</div>
			</form>
		</div>
	</center>
</body>

</html>