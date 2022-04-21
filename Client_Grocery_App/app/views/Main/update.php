<html>

<head>
	<title>Change your password</title>
</head>

<body>
	<?php
	if (isset($_GET['error'])) {
		echo $_GET['error'];
	}
	?>
	<br />
	<a href="<?= BASE . "/Main/home" ?>">Go back to Home Page</a>
	<form method="post" action="">

        <label>New First Name: <input type="text" name="first_name" /></label><br />
        <label>New Last Name: <input type="text" name="last_name" /></label><br />
        <label>New Address : <input type="text" name="address" /></label><br />
		<label>New Password: <input type="password" name="password" /></label><br />
		<label>New Password confirmation: <input type="password" name="password_confirm" /></label><br />

		<input type="submit" name="action" value="Submit changes" />
	</form>
</body>

</html>