<?php
$target_dir = "../../images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["upload"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
    echo "<script type='text/javascript'>alert('Uploaded!');</script>";
  }else {
    $uploadOk = 0;
  //  header('Location: index.php');
    echo "<script type='text/javascript'>alert('File is not an image.');</script>";
  }
    // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    $uploadOk = 0;
    //header('Location: index.php');
    echo "<script type='text/javascript'>alert('Sorry, your file is too large.');</script>";
  }
  // Check if file already exists
  if (file_exists($target_file)) {
    $uploadOk = 0;
    //header('Location: index.php');
    echo "<script type='text/javascript'>alert('Sorry, file already exists.');</script>";

  }
  // Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "<script type='text/javascript'>alert('Sorry, your file was not uploaded.');</script>";

// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "<script type='text/javascript'>alert('Sorry, there was an error uploading your file.');</script>";

  }
}
}
?>
