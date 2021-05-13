<?php

session_start();

include("../connection.php");
include("../functions.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$user_name = $_POST['user_name'];
	$password = $_POST['password'];

	if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {

		$query = "select * from users where user_name = '$user_name' limit 1";
		$result = mysqli_query($con, $query);

		if ($result) {
			if ($result && mysqli_num_rows($result) > 0) {

				$user_data = mysqli_fetch_assoc($result);

				if ($user_data['password'] === $password) {

					if ($user_data["user_type"] === "admin") {
						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: ../user_catalog/index.php");
						die;
					} else if ($user_data["user_type"] === "employee") {
						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: ../user_index/index.php");
						die;
					}
				}
			}
		}

		echo "<script>alert('ERROR : wrong username or password!')</script>";
	} else {
		echo "<script>alert('ERROR : wrong username or password!')</script>";
	}
}

?>


<!DOCTYPE html>
<html>

<head>
	<title>Login page</title>
	<link rel="stylesheet" href="styles.css">
</head>

<body>
	<div id="box">

		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Login</div>

			<input id="text" type="text" name="user_name" placeholder="Username"><br><br>

			<input id="text" type="password" name="password" placeholder="Password"><br><br>

			<input id="button" type="submit" value="Login"><br><br>

		</form>
	</div>
</body>

</html>