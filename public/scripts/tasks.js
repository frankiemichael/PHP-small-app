$(document).ready(function(){
  $(".statuscolour").text(function(){
    if ($(this).text() === '0'){
      $(this).text('Incomplete')
    }
  })
  $(".statuscolour").text(function(){
    return  $(this).text().replace("1", "Complete");
  })
$("span:contains(Complete)").css("color","green");
$("span:contains(Incomplete)").css("color","red");
$("span:contains(Low)").css("color","green");
$("span:contains(Medium)").css("color","orange");
$("span:contains(High)").css("color","red");
$(".date").html(function(i, oldHTML) {
    return oldHTML.replace(/ /g, '<br/>');
});


$("table").find('.deadline').each(function() {
  // Parse the date
  var date = Date.parse($(this).text());
  // Create a date to compare against
  var oneDaysAgo = new Date();
  // Subtract 5 days from it
  oneDaysAgo.setDate(oneDaysAgo.getDate()+1);
  // Compare to see if the date in the table is older than 5 days
  if(date < oneDaysAgo) $(this).css('color', 'orange');
});
$("table").find('.deadline').each(function() {
  // Parse the date
  var date = Date.parse($(this).text());
  // Create a date to compare against
  var oneHourLeft = new Date();
  // Subtract 5 days from it
  oneHourLeft.setHours(oneHourLeft.getHours()+3);
  // Compare to see if the date in the table is older than 5 days
  if(date < oneHourLeft) $(this).css('color', 'red');
});
$('.weekly').on('change', function(){
  if($(this).val() == 1){
  $('.task_input').after("<br><label for='day' class='day'>Day</label> <select name='day' class='day'><option value='Monday'>Monday</option><option value='Tuesday'>Tuesday</option><option value='Wednesday'>Wednesday</option><option value='Thursday'>Thursday</option><option value='Friday'>Friday</option><option value='Saturday'>Saturday</option><option value='Sunday'>Sunday</option></select>")
  $('.setdeadline').attr({
    hidden: true,
    type: 'text',
    value: '2021-03-24T00:00:00'
  })
}else if ($(this).val() == 0) {
  $('.setdeadline').attr({
    hidden: false,
    type: 'datetime-local',
    value: ''
  })
  $('.day').remove()
}else if ($(this).val() == 2) {
  $('.setdeadline').attr({
    hidden: false,
    type: 'time',
    value: ''
  })
  $('.day').remove()
  $(this).after("<input class='hiddentime' name='dailytime' type='datetime-local'hidden></input>")
  $('.setdeadline').on('change', function(){
    var hour = $(this).val()
    $('.hiddentime').val('2021-03-24T' + hour + ":00")
  })
}
})
if ($(window).width() < 960) {
  $('table').css({
    width: '100%',
  })
  $('.input_form').css(	'width', '100%')
  $('.date, .setfor, .status').hide()

  $('tr').on('click', function(){
    $(this).next('tr').off()
    $(this).next('tr').fadeToggle(500)


    })
}
else {
  $('.date, .task').show()
}
$('.staff').on('click')
$('.staffAll').on('click', function(){
  $('input:checkbox').not(this).prop('checked', this.checked)
})
})
