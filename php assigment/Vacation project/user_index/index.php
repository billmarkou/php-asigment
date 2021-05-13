<?php
session_start();

include("../connection.php");
include("../functions.php");

$user_data = check_login($con);

if (isset($_SESSION['submited_vacation_form']) && $_SESSION['submited_vacation_form'] === true) {
	echo "<script>alert('Form successfully submited !')</script>";

	unset($_SESSION['submited_vacation_form']);
}

$id = $user_data["user_id"];
$query = "SELECT * FROM vacation_requests where user_id = $id;";
$result = mysqli_query($con, $query);
$resultCheck = mysqli_num_rows($result);

?>


<!DOCTYPE html>
<html>

<head>
	<title>Vacation request catalog page</title>
	<link rel="stylesheet" href="styles.css">
</head>

<body>
	<header>

		<h1> Welcome mr/ms <?php echo $user_data["last_name"]; ?> to your vacation request catalog </h1>

		<a href="../logout.php">Logout</a> <br><br>
		<a href="../user_submit_vacation_form/index.php">Submit for vacation</a> <br><br>

	</header>

	<div id="container">

		<?php

		if ($resultCheck > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo
				"

				 	<div id = 'card'>

				 		<label>Date submited :</label> <label>" . $row["submission_date"] . "</label> <br><br>
	 
				 		<label>Vacation start :</label> <label>" . $row["vacation_start"] . "</label> <br><br>
	 
					 <label>Vacation end :</label> <label>" . $row["vacation_end"] . "</label> <br><br>
	 
					 <label>Days Requested :</label> <label>" . $row["days"] . "</label> <br><br>
	 
					 <label>Status :</label> <label>" . $row["status"] . "</label> 
	 
			 		</div>
				 
				 ";
			}
		} else {
			echo "You have not submited any vacation forms";
		}

		?>

	</div>

</body>

</html>