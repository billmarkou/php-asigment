<?php
session_start();

include("../connection.php");
include("../functions.php");

$user_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$user_id = $user_data["user_id"];
	$vacation_start = $_POST['vacation_start'];
	$vacation_end = $_POST['vacation_end'];
	$reason = $_POST['reason'];
	$days = calc_days($vacation_start, $vacation_end);
	$submission_date = date("Y-m-d H:i:s");
	$status = "pending";


	if (
		!empty($user_id) && !empty($vacation_start) && !empty($vacation_end) && !empty($reason)
		&& !empty($days) && !empty($submission_date) && !empty($status) && ($days > 0)
		&& (calc_days($submission_date, $vacation_start)) > 0
	) {
		$query = "INSERT INTO 
		vacation_requests(user_id, vacation_start, vacation_end, reason, days, submission_date, status) 
		VALUES ('$user_id','$vacation_start','	$vacation_end','$reason','	$days','$submission_date','$status');";

		mysqli_query($con, $query);

		$admin_email_query = "SELECT email FROM users where user_type = 'admin';";
		$result_admin_email_query = mysqli_query($con, $admin_email_query);
		$admin_email_array = mysqli_fetch_assoc($result_admin_email_query);
		$admin_email = $admin_email_array["email"];


		require '../PHPMailerAutoload.php';
		require '../credential.php';

		$mail = new PHPMailer;

		$mail->SMTPDebug = 4;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp1.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = EMAIL;                 // SMTP username
		$mail->Password = PASS;                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->setFrom(EMAIL, 'Vacation Portal');
		$mail->addAddress($admin_email);     // Add a recipient

		$mail->addReplyTo(EMAIL);


		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments

		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Vacation request';
		$mail->Body    = 'Dear supervisor, employee ' . $user_data["fisrt_name"] . ' ' . $user_data["last_name"] . ' 
		requested for some time off, starting on' . $vacation_start . ' and ending on ' . $vacation_end . ', 
		stating the reason: ' . $reason . ' Click on one of the below links to approve or reject the application:
		{approve_link} - {reject_link}';


		if (!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 'Message has been sent';
		}



		$_SESSION['submited_vacation_form'] = true;
		Header('Location: ../user_index/index.php');

		die;
	} else {
		echo "<script>alert('ERROR : Please enter some valid information !')</script>";
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Vacation request page</title>
	<link rel="stylesheet" href="styles.css">
</head>

<body>

	<header>

		<h1> Fill the form in order to send a vacation request </h1>

		<div>
			<a href="../logout.php">Logout</a> <br><br>
			<a href="../user_index/index.php">Return to home page</a> <br><br>
		</div>

	</header>

	<form name="vacations" method="POST" id="vacation_form">

		<div id="box">

			<label> Date from : </label> <input type="date" name="vacation_start"> <br><br>

			<label> Date to : </label> <input type="date" name="vacation_end"> <br><br>

		</div>

		<label for="reason" id="reason_label"> Reason : <textarea name="reason" form="vacation_form" id="reason"></textarea> <br><br>

			<button type="submit" name="submit button"> Submit </button>

	</form>

	<br>

</body>

</html>