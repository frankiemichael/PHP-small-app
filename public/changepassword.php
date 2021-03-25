<?php
session_start();
include('../inc/db_connect.php');
if (isset($_POST["oldpassword"]))
{
$id = $_SESSION['id'];
$old_pwd = $_POST['oldpassword'];
$pwd = $_POST['newpassword'];
 $c_pwd = $_POST['confirmpassword'];
 $new_pw = password_hash($c_pwd, PASSWORD_DEFAULT);
 if($old_pwd!="" && $pwd!="" && $c_pwd!="") :
  if($pwd == $c_pwd) :
  if($pwd!=$old_pwd) :
$sql = "SELECT id, password FROM accounts WHERE id = $id";
$db_check=$conn->query($sql);
 if(password_verify($old_pwd,$db_check->fetch_assoc()['password'])):
$fetch=$conn->query("UPDATE accounts SET password = '$new_pw' WHERE id ='$id'");
else:
  $error = "Old password is incorrect. Please try again.";
endif;
else :
  $error = "Old password and new password are the same. Please try again.";
endif;
else:
  $error = "New password and confirm password do not match.";
endif;
else :
  $error = "Please fill all the fields";
endif;

header('Location: profile.php');
echo '<script type="text/javascript">alert("Your password has been changed.")</script>';
}
else
{
  echo "No password supplied";
}
 ?>
