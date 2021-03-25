<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
  header('Location: ../index.html');
	exit;
}
require("../../inc/header.php");
include("../../inc/db_connect.php");
include("../../inc/config.inc.php");
require('../../inc/container.php');
?>

<title>TremenheerePOS</title>
<link href="/tremenheere/public/css/pos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/tremenheere/public/scripts/cart.js"></script>

<div style="margin-left: 0;" class="container">
  <div style="margin-left: 0; width:95vw;height:100%;"class="row">
<div style="left:0;" style="margin-right:0;" class='col-sm-8 productwrap'>

   <?php

   $sql = "SELECT * FROM shop_categories WHERE cat_parentid = '0'";
   $query = mysqli_query($conn, $sql);
   while($result = mysqli_fetch_assoc($query)){
     ?>
     <div name="<?php echo $result['cat_name'];?>" class="card" style="margin-top:10px;width: 11rem;height:400px;display:inline-flex;">
       <img style="width:11rem;height:11rem;object-fit: cover;" class="card-img-top" src="<?php if($result['cat_image'] == NULL){$image = "../images/placeholder.jpeg";}else{$image = $result['cat_image'];} echo $image;?>" alt="">
       <button id="<?php echo $result['cat_name'];?>"  class="openfolder btn btn-dark">Open Folder</button>
       <div class="card-body">
         <h5 class="card-title"><?php echo $result['cat_name'];?></h5>
         <p class="card-text">Base Folder</p>
         <input name='cat_id' class="id" value="<?php echo $result['cat_id'];?>" hidden></input>
         <input name='cat_parentid' class="id" value="<?php echo $result['cat_parentid'];?>" hidden></input>

       </div>
     </div> <?php }?>
     <?php
     $sql2 = "SELECT * FROM shop_products WHERE parentid = '0' AND product_stock > '0' ORDER BY product_name";
     $query2 = mysqli_query($conn, $sql2);
     while($result2 = mysqli_fetch_assoc($query2)){
       ?>
       <form class="product-form">
       <div name="<?php echo $result2['product_name'];?>" class="card" style="margin-top:10px;width: 11rem;height:100px;display:inline-flex;">
         <img class="product_image" style="width:11rem;height:11rem;object-fit: cover;" class="card-img-top" src="<?php if($result2['product_image'] == NULL){$image = "../images/placeholder.jpeg";}else{$image = $result2['product_image'];} echo $image;?>" alt="">
         <button type="submit" class="btn btn-primary">Add to Cart</button>
         <div class="card-body">
           <h5 class="card-title"><?php echo $result2['product_name'];?></h5>
           <p class="card-text"><?php echo $result2['product_desc'];?></p>
           <div class="price"><?php echo $currency, $row2['product_price'];?></div>
           <div class="product-box">
             <input type="number" name="product_qty" value='1'></input>
             <label for="product_qty"> <?php echo $row2['product_stock'];?> in stock</label>
           </div>
           <input name='id' class="id" value="<?php echo $result2['id'];?>" hidden></input>

         </div>
       </div> </form><?php }?>
</div>
<div class="col-sm-4 " style=" width: 20vw; border-radius: 10px; background: linear-gradient(to bottom, #33ccff 0%, #F9F9F9 40%);">
<div class='cartchange'><input value='1'class='cartinput'hidden></input><a href='#' class='cartselect1'>1</a> | <a href='#' class='cartselect2'>2</a> | <a href='#' class='cartselect3'>3</a> | <a href='#' class='cartselect4'>4 </a></div>

  <div class='cart1'><?php  include('view_cart1.php'); ?></div>
  <div class='cart2'hidden><?php  include('view_cart2.php'); ?></div>
  <div class='cart3'hidden><?php  include('view_cart3.php'); ?></div>
  <div class='cart4'hidden><?php  include('view_cart4.php'); ?></div>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  $('.openfolder').on('click', function(){
    $('body').css({ 'overflow-y': 'hidden'})
    var divclone = $('#overlay').clone()
    var cat_parentid = $(this).closest('div').find('.id').val()
    var subcat = $(this).closest('div').find('.subcat')
    var buttonid = $(this).attr('id')
    $.ajax({
    url: "fetch-subcategory-by-category.php",
    type: "POST",
    data: {
    cat_parentid: cat_parentid
    },
    cache: false,
    success: function(result){
    $('body').append(result);
    $('.close').on('click', function(){
      console.log('hello')
      $('#overlayWrapper').remove()
      $('body').css({ 'overflow-y': 'auto'})
    })
    $('.opensubfolder').on('click', function(){
      var subbuttonid = $(this).attr('id')
      var cat_parentid = $(this).closest('div').find('.id').val()

      $.ajax({
        url: "subproducts.php",
        type: "POST",
        data: {
        cat_parentid: cat_parentid
        },
        cache: false,
        success: function(result){
          console.log(this)
          $('#overlayWrapper').hide();
          $('body').prepend(result)
          $('.close').on('click', function(){
            $('#overlayWrapper1').remove()
            $('#overlayWrapper').remove()
            $('body').css({ 'overflow-y': 'auto'})
          })
          $('.back').on('click', function(){
            $('#overlayWrapper1').remove()
            $('#overlayWrapper').show()

          })
        }
        })
    })

    }

  })

})
$('#newproduct').on('click', function(){
  $.ajax({
  url: "new.php",
  type: "GET",
  cache: false,
  success: function(result){
    $('body').append(result)

    $('.close').on('click', function(){
      $('#overlayWrapper').remove()
    })

  }
  })
})
var buttonClone = $('#editproduct').clone();
$('#editproduct').on('click', function(){

  $(this).off()
  $(this).text('Finish')
  $('.card').append("<button class='productEdit btn btn-danger' type='button'>Edit</button>")
  $('.productEdit').on('click', function(){
    $.ajax({
      url: "edit.php",
      type:"GET",
      cache: false,
      success: function(result){
        console.log(result)
      },
      error:function(error){
        console.log(error)
      }
    })
  })
  $(this).on('click',function(){
    location.reload();
    $(this).replaceWith(buttonClone.clone());
  })
})
$('.close').on('click', function(){
  console.log('hello')
  $('#overlayWrapper').remove()
  $('body').css({ 'overflow-y': 'auto'})
})

})
</script>
</div>
</div>

<?php require('../../inc/footer.php'); ?>
