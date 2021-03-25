<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
  header('Location: ../../index.html');
	exit;
}

include('../../../inc/db_connect.php');
include('../../../inc/header.php');
include('../../../inc/container.php');
 ?>
 <title>Trereife Stock Management</title>
 <link rel="stylesheet" href="../../css/stock.css">
 <div class='stockheaddiv'>
 <a class='products' style='float:left;' href="#">Products</a>
  |
 <a class='categories' href="#">Categories</a>
</div>
 <table>
   <thead>
     <tr>
      <th width="5%">ID</th>
      <th width="22.5%">Name</th>
      <th class='thhide' width="15%">SKU</th>
      <th width="12.5%">Category</th>
      <th class='thhide' width="20%">Description</th>
      <th width="15%">Image</th>
      <th class='thhide' width="5%">Price</th>
      <th class='thhide' width="5%">Stock</th>
    </tr>
  </thead>
  <tbody>

  </tbody>
 </table>
 <button id='newproduct'>New</button>
<script type="text/javascript">
$('.products').on('click', function(){
$('.thhide').show()
$('td').remove()

$.ajax({
url: "getproducts.php",
type: "GET",
cache: false,
success: function(result){
  $('tbody').append(result)
  $('.data').on('change', function(){
    var column = $(this).attr('name')
    var id = $(this).closest('tr').find('input[name="id"]').val()
    var data = $(this).val()
    $.ajax({
      url: "insertproduct.php",
      type: "POST",
      data: {
          column: column,
          id: id,
          data: data
        },
        success: function(result){
          console.log(result)
        }
    })
  })
  $('#editImage').on('click', function(){
    var id = $(this).attr('name')
    $('body').prepend("<div id='overlayWrapper'><div id='overlay'><button class='close'>x</button><div id='images'></div></div></div>")
    $.ajax({
      url: "image.php",
      type:"GET",
      cache: false,
      success: function(result){
        $('#images').append(result)
        $('.imgthumb').on('click', function(){
          $(this).addClass('borderadd')
          $('.imgthumb').not(this).removeClass('borderadd')
          var name = $(this).attr("name");
          $('button[name="'+id+'"]').attr('value', name)


        })
      }
    })
    $('.close').on('click', function(){
      console.log('hello')
      $('#overlayWrapper').remove()
      $('body').css({ 'overflow-y': 'auto'})
    })

  })
}
})
})
$('.categories').on('click', function(){
  $('.thhide').hide()
  $('td').remove()
  $.ajax({
    url: "getcategories.php",
    type: "GET",
    cache: false,
    success:function(result){
      $('tbody').append(result)
      $('.data').on('change', function(){
        var column = $(this).attr('name')
        var id = $(this).closest('tr').find('input[name="id"]').val()
        var data = $(this).val()
        $.ajax({
          url: "insertcategory.php",
          type: "POST",
          data: {
              column: column,
              id: id,
              data: data
            },
            success: function(result){
              console.log(result)
            }
        })
      })
      $('#editImage').on('click', function(){
        var id = $(this).attr('name')
        $('body').prepend("<div id='overlayWrapper'><div id='overlay'><button class='close'>x</button><div id='images'></div></div></div>")
        $.ajax({
          url: "image.php",
          type:"GET",
          cache: false,
          success: function(result){
            $('#images').append(result)
            $('.imgthumb').on('click', function(){
              $(this).addClass('borderadd')
              $('.imgthumb').not(this).removeClass('borderadd')
              var name = $(this).attr("name");
              $('button[name="'+id+'"]').attr('value', name)


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

</script>
