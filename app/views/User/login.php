<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Quicksand&family=Sacramento&display=swap" rel="stylesheet">
<link href="/app/css/style.css" rel="stylesheet">
<head>
	<title>Login</title>
</head>

<body>
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
					<input class="rainbow rainbow-5" type='submit' name='action' value='Login' />
				</form>
				<a href="/User/register"><span>Register Here</span></a>
			</div>
		</div>
	</center>

</body>

</html>