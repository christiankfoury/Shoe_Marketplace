<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Quicksand&family=Sacramento&display=swap" rel="stylesheet">

<head>
	<title>Register</title>
</head>

<body>
	<style>
		body {
			background: url(/uploads/background.jpg) no-repeat fixed center;
			top: 0;
			bottom: 0;
			right: 0;
			left: 0;
			background-position: center center;
			background-repeat: no-repeat;
			background-size: cover;
			margin: 25px;
			font-family: 'Quicksand', sans-serif;
		}

		form {
			font-size: 25px;
		}

		a,
		input,
		select {
			text-decoration: none;
			background-color: #EEEEEE;
			color: #333333;
			width: fit-content;
			padding: 10px;
			border-radius: 50px;
		}

		input,
		select {
			margin-bottom: 15px;
			width: 500px;
		}

		div.box {
			background: rgb(179 179 179 / 75%);
			width: fit-content;
			padding: 50px;
			border-radius: 100px;
			box-shadow: 0px 0px 100PX 100PX rgb(96 96 96 / 75%);
		}

		input[type=submit],
		a {
			background-color: #2196f3;
			color: white;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
			color: white;
		}
	</style>
	<a href="/User/login">Login Here</a><br><br>
	<h1>Register for new user!</h1>
	<center>
		<div class="box">
			<?php
			if ($data != null) {
				echo "<h3>$data</h3>";
			}
			?>
			<form action='' method='post'>
				<div style="text-align: left;">
					First Name: <br> <input type='text' name='first_name' />
					<br>
					Last Name: <br><input type='text' name='last_name' /><br>
					Favorite Color: <br> <select name="favorite_color">
						<?php
						$colors = ['yellow', 'green', 'blue', 'violet', 'red', 'orange', 'black', 'white', 'pink']; ?>
						<?php foreach ($colors as $color) { ?>
							<option value="<?php echo $color; ?>"><?php echo ucfirst($color); ?></option>
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
					<input type='submit' name='action' value='Register' />
				</div>
			</form>
		</div>
	</center>
</body>

</html>