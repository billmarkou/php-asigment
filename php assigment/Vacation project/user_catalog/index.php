<?php

session_start();

include("../connection.php");
include("../functions.php");

$user_data = check_login($con);

if (isset($_SESSION['success']) && $_SESSION['success'] === true) {
  echo "<script>alert('Form successfully submited !')</script>";

  unset($_SESSION['success']);
} else if (isset($_SESSION['updated']) && $_SESSION['updated'] === true) {
  echo "<script>alert('User data successfully updated !')</script>";

  unset($_SESSION['updated']);
}

$sql = "SELECT * FROM users;";
$result = mysqli_query($con, $sql);
$resultCheck = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html>

<head>
  <title>Users catalog page</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <header>

    <h1>Welcome mr/ms <?php echo $user_data["last_name"]; ?> to the user catalog</h1>

    <a href="../index/index.php">Create User</a>
    <a href="../logout.php">Logout</a> <br><br>

  </header>


  <div>

    <table>
      <tr>
        <th>Users first name</th>
        <th>Users last name</th>
        <th>Users E-mail</th>
        <th>Users type</th>
        <th>Click to update</th>
      </tr>

      <?php

      if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

          echo "<tr><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td><td>"
            . $row["email"] . "</td><td>" . $row["user_type"] . "</td><td> 
      <a href = ../update_user/index.php?id=" . $row['user_id'] . "> Update </a> </tb></tr>";
        }
        echo "</table>";
      } else {
        echo "There are no data entries";
      }

      ?>

  </div>

</body>

</html>