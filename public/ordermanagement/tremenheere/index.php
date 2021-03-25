<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
  header('Location: ../../index.html');
	exit;
}
if( $_SESSION['admin'] == 0){
  echo "<script> alert('Unauthorised access.');
  window.setTimeout(function(){


      window.location.href = '/tremenheere/public/home.php';

  }, 1000);
  </script>";
  exit;
}
include('../../../inc/header.php');
include('../../../inc/container.php');
 ?>
 <link rel="stylesheet" href="../../css/stock.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<table>
  <thead>
    <tr>
    <th>ID</th>
    <th>Date/Time</th>
    <th>Created By</th>
    <th>Order Total</th>
    <th>Order Notes</th>
  </tr>
  </thead>
  <tbody>

  </tbody>
</table>

<script type="text/javascript">
$(document).ready(function(){
  $.ajax({
    url: "getorders.php",
    type: "GET",
    cache: false,
    success:function(result){
      $('tbody').html(result)
      $('.moredetails').on('click', function(){
        var id = $(this).closest('tr').find('td[name="id"]').text()
        console.log(id)
        $('body').append("<div id='overlayWrapper'><div id='overlay'><button class='close'>x</button><table><thead><tr><th>Name</th><th>SKU</th><th>Quantity</th></tr><tbody></tbody></div></div>")
        $.ajax({
          url: "getitems.php",
          type: "POST",
          data:{orderid:id},
          cache: false,
          success:(function(result){
            $('#overlay tbody').html(result)
          })
        })

        $('.close').on('click', function(){
          $('#overlayWrapper').remove()
          $('body').css({ 'overflow-y': 'auto'})
        })
      })
    }
  })
})
</script>
<?php
require('../../../inc/footer.php'); ?>
