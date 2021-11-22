<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Quicksand&family=Sacramento&display=swap" rel="stylesheet">

<head>
	<title>Login</title>
</head>
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

	span {
		cursor: pointer;
		display: inline-block;
		position: relative;
		transition: 0.5s;
	}

	span:after {
		content: '\00bb';
		position: absolute;
		opacity: 0;
		top: 0;
		right: -20px;
		transition: 0.5s;
		color: #3a3a3a;
	}

	a:hover span {
		padding-right: 25px;
		color: #3a3a3a;
	}

	a:hover span:after {
		opacity: 1;
		right: 0;
	}


	.rainbow {
		cursor: pointer;
	}

	.rainbow-5:hover {
		background-image: linear-gradient(to right,
				#2196f3,
				#2196f3 16.65%,
				white 16.65%,
				white 33.3%,
				#2196f3 33.3%,
				#2196f3 49.95%,
				white 49.95%,
				white 66.6%,
				#2196f3 66.6%,
				#2196f3 83.25%,
				white 83.25%,
				white 100%,
				#2196f3 100%);
		animation: slidebg 2s linear infinite;
		transition: 0.5s;
		color: black;
	}


	@keyframes slidebg {
		to {
			background-position: 20vw;
		}
	}
</style>

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