<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
  header('Location: ../tremenheere/public/index.html');
	exit;
}
include('../inc/db_connect.php');
include('../inc/header.php');
include('../inc/container.php');
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $conn->prepare('SELECT password, email FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
    <link href="css/css.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<div class="content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Password:</td>
            <td><a class='change' href="#">Change</a>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
				</table>
			</div>
		</div>
    <script type="text/javascript">
    $('.change').on('click', function(){
      $(this).hide()
      $(this).after('<form action="changepassword.php" method="POST"><input id="oldPassword" type="text" name="oldpassword" placeholder="Current Password"></input><input id="newPassword" placeholder="New Password" type="text" name="newpassword"></input><input id="confirmPassword" placeholder="Confirm New Password" type="text" name="confirmpassword"></input><button class="submit btn btn-primary" type="submit">Change</button></form>')

    })

    </script>
	</body>
</html>
