<?php
session_start();
include('../inc/db_connect.php');

if ( !isset($_POST['email'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the email and password fields!');
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $conn->prepare('SELECT id, username, password, privileges FROM accounts WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
  if ($stmt->num_rows > 0) {
  	$stmt->bind_result($id, $username, $password, $privileges);
  	$stmt->fetch();
  	// Account exists, now we verify the password.
  	// Note: remember to use password_hash in your registration file to store the hashed passwords.
		$pw = $_POST['password'];
		if (password_verify($pw, $password)) {
  		// Verification success! User has logged-in!
  		// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
  		session_regenerate_id();
  		$_SESSION['loggedin'] = TRUE;
  		$_SESSION['name'] = $username;
  		$_SESSION['id'] = $id;
			$_SESSION['admin'] = $privileges;
  		header('Location: home.php');
  	} else {
  		// Incorrect password
  		echo 'Incorrect password!';
  	}
  } else {
  	// Incorrect username
  	echo 'Incorrect email!';
  }

	$stmt->close();
}
?>
