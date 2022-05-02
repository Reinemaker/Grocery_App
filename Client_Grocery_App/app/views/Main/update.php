<html>

<head>
	<title>Update your account information</title>

	<?php include('C:\xampp\htdocs\Grocery_App\Client_Grocery_App\app\views\Main\navbar.php'); ?>
</head>

<body>

	<form method="post" action='/Grocery_App/Client_Grocery_App/Account/updateAccount'>

	<input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="First name" type="text" name="first_name" required/>
    <input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="Last name" type="text" name="last_name" pattern="^[A-Za-z]*$" title="Last name must only contain letters."/>
    <input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="Username" type="text" name="username" />
    <input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="Address" type="text" name="address" />
    <input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="Password" type="password" name="password" />
    <input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="Password confirmation:" type="password" name="password_confirm" />
    <input style="text-align:center; margin: 0 auto; padding-right: 30px; padding-left: 30px" class="btn btn-success d-flex justify-content-center" type="submit" name="action" value="Register" />
	
	</form>
</body>


<?php
	/*
	<input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="First name" type="text" name="first_name" required/>
    <input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="Last name" type="text" name="last_name" pattern="^[A-Za-z]*$" title="Last name must only contain letters."/>
    <input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="Username" type="text" name="username" />
    <input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="Address" type="text" name="address" />
    <input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="Password" type="password" name="password" />
    <input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="Password confirmation:" type="password" name="password_confirm" />
    <input style="text-align:center; margin: 0 auto; padding-right: 30px; padding-left: 30px" class="btn btn-success d-flex justify-content-center" type="submit" name="action" value="Register" />
	*/

	/*
		<label>New First Name: <input type="text" name="first_name" /></label><br />
        <label>New Last Name: <input type="text" name="last_name" /></label><br />
        <label>New Address : <input type="text" name="address" /></label><br />
		<label>New Password: <input type="password" name="password" /></label><br />
		<label>New Password confirmation: <input type="password" name="password_confirm" /></label><br />

		<input type="submit" name="action" value="Submit changes" />
	*/
?>
</html>