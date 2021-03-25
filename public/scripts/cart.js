$(document).ready(function(){
  $('.cartselect1').on('click', function(){
    $('.cartinput').attr('value', '1')
    $('.cart1').attr('hidden', false)
    $('.cart2').attr('hidden', true)
    $('.cart3').attr('hidden', true)
    $('.cart4').attr('hidden', true)
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
  })
  $('.cartselect2').on('click', function(){
    $('.cartinput').attr('value', '2')
    $('.cart1').attr('hidden', true)
    $('.cart2').attr('hidden', false)
    $('.cart3').attr('hidden', true)
    $('.cart4').attr('hidden', true)
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
  })
  $('.cartselect3').on('click', function(){
    $('.cartinput').attr('value', '3')
    $('.cart1').attr('hidden', true)
    $('.cart2').attr('hidden', true)
    $('.cart3').attr('hidden', false)
    $('.cart4').attr('hidden', true)
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
  })
  $('.cartselect4').on('click', function(){
    $('.cartinput').attr('value', '4')
    $('.cart1').attr('hidden', true)
    $('.cart2').attr('hidden', true)
    $('.cart3').attr('hidden', true)
    $('.cart4').attr('hidden', false)
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
