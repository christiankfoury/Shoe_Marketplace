<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="/app/css/style.css" rel="stylesheet">

<head>
	<title>Login</title>
</head>

<body class="login-register-body">
	<h1 class="login-h">Sneaker Marketplace</h1>
	<h3 class="login-h">Login</h3>
	<center>
		<div class="login-register-box">
			<?php
			if ($data != null) {
				echo "<div class=\"alert alert-danger\" role=\"alert\" style=\"width: 400px; height: 50px;\">$data</div>";
			} else {
				// echo "<div class=\"alert alert-light\" role=\"alert\">Registration</div>";
				echo "<br><br>";
			}
			?>
			<div style="text-align: left;">
				<form class="login-register-form" action='' method='post'>
					Username: <br><input class="login-register" type='text' name='username' /><br>
					Password: <br><input class="login-register" type='password' name='password' /><br><br>
					<input class="login-register-button rainbow rainbow-5" type='submit' name='action' value='Login' />
				</form>
				<a class="login-register-button" href="/User/register"><span class="slide-arrow">Register Here</span></a>
			</div>
		</div>
	</center>

</body>

</html>