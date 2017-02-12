$(document).ready(function(){

  $('#title').focusout(function() {
    $('#title').val().length > 5 ? $('#dt').css("color","green") : $('#dt').css("color","red");

  });
  $('#message').focusout(function() {
      $('#message').val().length < 5 ? $('#dm').css("color","red") : $('#dm').css("color","green");

  });


});

// @desc Case system that outputs data to the screen when a user submits a form.
// Things like Success! Error! or Warning! are common outputs.
// Using bootstrap-growl plugin for easier output.
//
// @args Triggers for output. var = num
function display_input_message(n) {
  switch (n) {
    case 0:
    $.bootstrapGrowl("It looks like you missed some information! Please fill in all fields.", {
          ele: 'body',
          type: 'danger',
          align: 'right',
          offset: {from: 'top', amount: 10},
          width: 450,
          delay: 4000,
          allow_dismiss: false,
          stackup_spacing: 10
        });
        break;

      case 1:
      $.bootstrapGrowl("Success! Thank you for helping us continue make our website grow.", {
        ele: 'body',
        type: 'Success',
        align: 'right',
        offset: {from: 'top', amount: 110},
        width: 450,
        delay: 4000,
        allow_dismiss: true,
        stackup_spacing: 10
      });
      //Hides form so it cannot be submitted more than once.
      $('.addform, .requirements').hide(1000);
      break;

    default:
            console.log("Error in display_input func. Check args");

  }

}
function add_bug() {

  $('.ui-main-button-group').hide("fast");
}


function cancel(n) {

  if(n == 0) {

    $('.ui-main-button-group').show("fast");
  }

}
