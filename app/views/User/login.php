<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Quicksand&family=Sacramento&display=swap" rel="stylesheet">

<head>
	<title>Login</title>
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
	<?php
	if ($data != null) {
		echo $data;
	}
	?>
	<h1>Sneaker Marketplace</h1>
	<h3>Login</h3>
	<center>
		<div class="box">
			<div style="text-align: left;">
				<form action='' method='post'>
					Username: <br><input type='text' name='username' /><br>
					Password: <br><input type='password' name='password' /><br>
					<input type='submit' name='action' value='Login' />
				</form>
				<a href="/User/register">Register Here</a>
			</div>
		</div>
	</center>

</body>

</html>