<?php
session_start();

include("../connection.php");
include("../functions.php");

$user_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$user_name = $_POST['user_name'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$password = $_POST['password'];
	$password1 = $_POST['password1'];
	$email = $_POST['email'];
	$user_type = $_POST['user_type'];

	if (
		!empty($user_name) && !empty($first_name) && !empty($last_name)
		&& !empty($password) && !empty($email) && !empty($user_type)
		&& ($password === $password1)
	) {


		$user_id = random_num(20);
		$query = "insert into users 
			(user_id, user_name, first_name, last_name, password, email, user_type) values 
			('$user_id', '$user_name', '$first_name', '$last_name', '$password', '$email', '$user_type')";

		mysqli_query($con, $query);

		$_SESSION['success'] = true;
		Header('Location: ../user_catalog/index.php');
		die;
	} else {
		echo "<script>alert('ERROR : Please enter some valid information !')</script>";
	}
}

?>


<!DOCTYPE html>
<html>

<head>
	<title>New user add page</title>
	<link rel="stylesheet" href="styles.css">
</head>

<body>

	<header>

		<h1>Fill out the form with new user credentials</h1>
		<div>
			<a href="../logout.php">Logout</a>
			<a href="../user_catalog/index.php">Go to users catalog</a>
		</div>

	</header>


	<div id="box">

		<form id="form" method="POST">

			<label for="user_name"> User name : </label> <input type="text" name="user_name" id="user_name"> <br><br>

			<label for="first_name"> First name : </label> <input type="text" name="first_name" id="first_name"> <br><br>

			<label for="last_name"> Last name : </label> <input type="text" name="last_name" id="last_name"> <br><br>

			<label for="password"> Password : </label> <input type="text" name="password" id="password"> <br><br>

			<label for="password1"> Confirm password : </label> <input type="text" name="password1" id="password1"> <br><br>

			<label for="email"> E-mail : </label> <input type="text" name="email" id="email"> <br><br>

			<label> User type : </label>
			<select name="user_type">
				<option value="admin">admin</option>
				<option value="employee">employee</option>
			</select> <br><br>

			<button type="submit" name="submit button"> Submit </button>

		</form>

	</div>

</body>

</html>