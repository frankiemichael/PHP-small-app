
<div id='overlayWrapper'>
  <div id='overlay'>

<?php
include('../../inc/db_connect.php');

 ?>
 <div class='formwrap'>
   <button class='close'>x</button>
 <form action='newproduct.php' id='nextForm' method='POST'>
   <div class="form-group">
     <label for="productOrFolder">Create New</label>
     <select name="productfolder" class="form-control" id="productOrFolder">
       <option value="0">Product</option>
       <option value="1">Folder</option>
     </select>
 <div class="form-group">
   <label for="name">Name</label>
   <input type="text" class="form-control" name='name' required>
 </div>
 <div id='parent' class="form-group">
   <label for="parentid">Parent Folder</label>
   <select name='parentid' class="form-control" id="parentid">
     <option value="0">None</option>
     <?php
     $sql = "SELECT * FROM shop_categories WHERE cat_parentid = '0' ORDER BY cat_name";
     $query = mysqli_query($conn, $sql);
     while($result = mysqli_fetch_assoc($query)){
     ?>
     <option value='<?php echo $result['cat_id']; ?>'><?php echo $result['cat_name']; ?></option>
   <?php } ?>
   </select>
 </div>
 <div id='subcategorydiv' class="form-group">
   <label for="subcategory">Sub Folder</label>
   <select name='subcategory' class="form-control" id="subCategory">
     <option value="0">None</option>

   </select>
 </div>
 <div id='desc' class="form-group">
   <label for="description">Description</label>
   <textarea class="form-control" name="description" rows="3"required></textarea>
 </div>
 <div id='price' class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text">£</span>
   </div>
   <input name="price" type="text" class="form-control" aria-label="Amount (to the nearest pound)"required>
 </div>
 <div id='stock' class="input-group mb-3">
   <label for="stock">Stock</label>
   <input name="stock" type="number" class="form-control"required>
 </div>

 <input name="image" type="text" class='imageform'hidden></input>

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

 <button style="margin-top:2px;" type="submit" class="btn btn-primary" id='toImage'>Finish</button>
</form>

<script type="text/javascript">
$(document).ready(function(){


$('.imgthumb').on('click', function(){
  $(this).addClass('borderadd')
  $('.imgthumb').not(this).removeClass('borderadd')
  var name = $(this).attr("name");
  $('.imageform').attr('value', name)


})
$('#productOrFolder').on('change', function(){
  if ($(this).val() == 0) {
    var parentid =
    $('#nextForm').attr('action', 'newproduct.php')
    $('#subcategorydiv').show()
    $('#subcategorydiv').after("<div id='desc' class='form-group'><label for='description'>Description</label><textarea class='form-control' name='description' rows='3'required></textarea></div>")
    $('#desc').after("<div id='price' class='input-group mb-3'><div class='input-group-prepend'><span class='input-group-text'>£</span></div><input name='price' type='text' class='form-control' aria-label='Amount (to the nearest pound)'required><div id='stock' class='input-group mb-3'><label for='stock'>Stock</label><input name='stock' type='number' class='form-control'required></div>")
    console.log("Product")

  }else if($(this).val() == 1) {
    console.log("Folder")
    $('#nextForm').attr('action', 'newfolder.php')
    $('#desc').remove()
    $('#price').remove()
    $('#sku').remove()
    $('#subcategorydiv').hide()

  }
})
$('#nextForm').submit(function(e){

  e.preventDefault();

  var form = $(this);
  var url = form.attr('action');
  $.ajax({
    type: "POST",
         url: url,
         data: form.serialize(), // serializes the form's elements.
         success: function(data)
         {
             alert(data); // show response from the php script.
                 $('#overlayWrapper').empty();
                 location.reload()
         }
  })
});
$('#parentid').on('change', function(){
  var subcat_id = this.value;
  $.ajax({
    url:"subcatselect.php",
    type: "POST",
    data: {
        subcat_id: subcat_id
      },
      cache: false,
    success: function(result){
      $("#subCategory").html(result);
      }
  })
})
});
</script>
</div>
</div>
</div>
