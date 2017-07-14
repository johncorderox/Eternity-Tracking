$(document).ready(function() {

  var message        = $('#message').val();
  var comment_button = $('#add_comment');
  var title          = $('#title');


  $('.login-logs').hide();

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
function showLogin() {

$('.main-logs').hide();
$('.login-logs').show();
}

function showAction() {
  $('.main-logs').show();
  $('.login-logs').hide();

}

function add_bug() {

  $('.addform').toggle();
  $('#bug_table').toggle();

}
