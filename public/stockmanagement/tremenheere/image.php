<div id='imageUpload'>
<form action='upload.php' method='POST' enctype="multipart/form-data">
  Select image to upload:
  <input style='opacity:1;background-color: lightgrey;' type="file" name="fileToUpload" class="custom-file-input" id="fileToUpload">
  <input class='btn btn-primary' type="submit" value="Upload Image" name="upload">
</form>
</div>
<div class="gallery">
<?php
$dirname = "../../images/";
$images = glob($dirname."*");

foreach($images as $image) {
   echo '<div class="img" style="object-fit:contain;width:80px;height:80px;margin:2px;padding:2px;"><img style="margin:10px;" height="80px" width="80px" class="imgthumb img-rounded img-responsive" src="'.$image.'" name="'.$image.'"></div>';
}
?>
</div>
