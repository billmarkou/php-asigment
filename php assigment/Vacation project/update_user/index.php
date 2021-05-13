<?php

session_start();

include("../connection.php");
include("../functions.php");

$user_data = check_login($con);

$id = $_GET["id"];
$query = "select * from users where user_id = $id limit 1";


$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) == 1) {
	$user = mysqli_fetch_assoc($result);
} else {
	echo "something went wrong";
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$user_name = $_POST['user_name'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$user_type = $_POST['user_type'];

	if (
		!empty($user_name) && !empty($first_name) && !empty($last_name)
		&& !empty($email) && !empty($user_type)
	) {

		$query = "update users set user_name = '$user_name', first_name = '$first_name',
      last_name = '$last_name', email = '$email', user_type = '$user_type'
      where user_id = '$id';";

		mysqli_query($con, $query);

		$_SESSION['updated'] = true;
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
	<title>User info update page</title>
	<link rel="stylesheet" href="styles.css">
</head>

<body>

	<header>

		<h1>Update users information and submit them</h1>

		<div>

			<a href="../user_catalog/index.php">User catalog</a>
			<a href="../logout.php">Logout</a>

		</div>

	</header>

	<div id="box">

		<form id="form" method="POST">

			<label> User name : </label> <input type="text" name="user_name" value="<?php echo $user['user_name']; ?>"> <br><br>

			<label> First name : </label> <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>"> <br><br>

			<label> Last name : </label> <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>"> <br><br>

			<label> E-mail : </label> <input type="text" name="email" value="<?php echo $user['email']; ?>"> <br><br>

			<label> User type : </label>

			<select name="user_type">
				<option value="admin" <?php if ($user['user_type'] == 'admin') {
																echo "selected";
															}; ?>> admin </option>
				<option value="employee" <?php if ($user['user_type'] == 'employee') {
																		echo "selected";
																	}; ?>> employee </option>
			</select> <br><br>

			<button type="submit" name="submit button"> Update entry </button>

		</form>

	</div>

</body>

</html>