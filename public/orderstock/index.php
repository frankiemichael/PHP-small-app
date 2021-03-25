<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
  header('Location: ../../index.html');
	exit;
}
include_once("../../inc/db_connect.php");
include("../../inc/config.inc.php");
include("../../inc/header.php");

?>
<title>Order Stock</title>

<link href="/tremenheere/public/css/pos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/tremenheere/public/scripts/cart.js"></script>
<?php include('../../inc/container.php');?>
<div class='top'>
<button id="editproduct" class="btn btn-primary"style="margin:10px;margin-left:50vw;">Edit</button>
<button id="newproduct" class="btn btn-primary"style="margin:10px;">+</button>
</div>
<div style="margin-left: 0;" class="container">
  <div style="margin-left: 0; width:95vw;height:100%;"class="row">
<div style="left:0;" style="margin-right:0;" class='col-sm-8 productwrap'>

   <?php

   $sql = "SELECT * FROM trereife_categories WHERE cat_parentid = '0'";
   $query = mysqli_query($conn, $sql);
   while($result = mysqli_fetch_assoc($query)){
     ?>
     <div name="<?php echo $result['cat_name'];?>" class="card" style="margin-top:10px;width: 11rem;height:auto;display:inline-flex;">
       <img style="width:11rem;height:11rem;object-fit: cover;" class="card-img-top" src="<?php if($result['cat_image'] == NULL){$image = "../images/placeholder.jpeg";}else{$image = $result['cat_image'];} echo $image;?>" alt="">
       <div class="card-body">
         <h5 class="card-title"><?php echo $result['cat_name'];?></h5>
         <p class="card-text">Category</p>
         <input name='cat_id' class="id" value="<?php echo $result['cat_id'];?>" hidden></input>
         <input name='cat_parentid' class="id" value="<?php echo $result['cat_parentid'];?>" hidden></input>
         <button id="<?php echo $result['cat_name'];?>" style="margin-top:75px;" class="openfolder btn btn-dark">Open Folder</button>

       </div>
     </div> <?php }?>
     <?php
     $sql2 = "SELECT * FROM trereife_products WHERE parentid = '0' AND product_stock > '0' ORDER BY product_name";
     $query2 = mysqli_query($conn, $sql2);
     while($result2 = mysqli_fetch_assoc($query2)){
       ?>
       <form class="product-form">
       <div name="<?php echo $result2['product_name'];?>" class="card" style="margin-top:10px;width: 11rem;height:auto;display:inline-flex;">
         <img class="product_image" style="width:11rem;height:11rem;object-fit: cover;" class="card-img-top" src="<?php if($result2['product_image'] == NULL){$image = "../images/placeholder.jpeg";}else{$image = $result2['product_image'];} echo $image;?>" alt="">
         <div class="card-body">
           <h5 class="card-title"><?php echo $result2['product_name'];?></h5>
           <p class="card-text"><?php echo $result2['product_desc'];?></p>
           <div class="price text-success"><h5 class="mt-4"><?php echo $currency, $result2['product_price'];?></h5></div>
           <div class="product-box">
           <label for="product_qty">Quantity</label>
           <input style="width:40px;"type="number" name="product_qty" value='1'></input> / <?php echo $result2['product_stock'];?>
           </div>
           <input name='id' class="id" value="<?php echo $result2['id'];?>" hidden></input>
           <button type="submit" class="btn btn-primary">Add to Cart</button>

         </div>
       </div> </form><?php }?>
</div>
<div class="col-sm-4 " style="height:100%; width: 20vw; background-color: lightblue;">
  <?php
  include('view_cart.php'); ?>
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
          console.log(result)
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
