$(document).ready(function() {

  var message = $('#message').val();
  var comment_button = $('#add_comment');

  $('.editform, .deleteform, .newuserform, .removeuserform').hide();

  $('#open').click(function() {

    $('.sidebar').css("width", "425");

  });


  $('#cancel').click(function() {

    $('.sidebar').css("width", "0");

  });

  comment_button.attr("disabled", "disabled");

  $('.comment_view').hide();


  $('.comment_view textarea').keypress(function() {

    if (message.length >= 1) {

      $('#add_comment').removeAttr("disabled");

    }

  });


});

function showComments(a) {



  if (a === 1) {

    $('.comment_view').toggle();

    $('body').scrollTo('.comment_view', {
      duration: 300
    });

  } else {


    $('.comment_view').hide();


  }


}

function reveal(x) {

  $('.account_info').hide();

  switch (x) {
    case 0:
      $('.changePassword').toggle("fast");
      $('.resetLoginCount, .changeEmail').hide();
      break;

    case 1:

      $('.changeEmail').toggle("fast");
      $('.changePassword, .resetLoginCount').hide();
      break;

    case 2:

      $('.resetLoginCount').toggle("fast");
      $('.changePassword, .changeEmail').hide();
      break;
    default:

  }
}

function hideLogs() {

  $('#open').hide();


}
