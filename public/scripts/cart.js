$(document).ready(function(){
  $('.cartselect').on('click', function(){
    var cartnumber = $(this).text()
    console.log(cartnumber)
    var viewcart = "view_cart"
    var php = ".php"
    var url = viewcart + cartnumber + php
    $.ajax({
      type:"GET",
      url:url,

      success:function(result){
        $('.cartdiv').append(result)
      }
    })
  })
	// update product quantity in cart
    $(".quantity").change(function() {
		 var element = this;
		 setTimeout(function () { update_quantity.call(element) }, 2000);
	});
	function update_quantity() {
		var pcode = $(this).attr("data-code");
		var quantity = $(this).val();
		$(this).parent().parent().fadeOut();
		$.getJSON( "manage_cart"+cartnumber+".php", {"update_quantity":pcode, "quantity":quantity} , function(data){
			window.location.reload();
		});
	}
	// add item to cart
	$(".product-form").submit(function(e){
		var form_data = $(this).serialize();
		var button_content = $(this).find('button[type=submit]');
		button_content.html('Adding...');
    var cartnumber = $('.cartinput').val()
		$.ajax({
			url: "manage_cart"+cartnumber+".php",
			type: "POST",
			dataType:"json",
			data: form_data,
		    success: function(data){
          console.log('hello')
			$("#cart-container").html(data.products);
			button_content.html('Add to Cart');
      window.location.reload();
		},
    error: function(error){
    }

	});
  e.preventDefault();
})
	//Remove items from cart
  $("#shopping-cart-results").on('click', 'a.remove-item', function(e) {
    console.log('test')
    e.preventDefault();
    var pcode = $(this).attr("data-code");
    var cartnumber = $('.cartinput').val()
    $(this).parent().parent().fadeOut();
    $.getJSON( "manage_cart"+cartnumber+".php", {"remove_code":pcode} , function(data){
      $("#cart-container").html(data.products);
      window.location.reload();
    });
  });
});
