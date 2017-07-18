'use strict';

$(document).ready(function() {

  var message        = $('#message').val();
  var comment_button = $('#add_comment');





  $('.login-logs, .deleteform, #hiddenInput').hide();


  $('.comment_view, .addform').hide();




});






function showComments(a) {



  if (a === 1) {

    $('.comment_view').toggle();

    $('body').scrollTo('.comment_view', {
      duration: 300
    });

  } else {

    $('.comment_view').hide();
    $('body').scrollTo('body', {
      duration: 300
    });



  }


}

function reveal(x) {

  $('.account_info').hide();

  switch (x) {
    case 0:
      $('.login-logs').show();
      $('.main-logs').hide();
      break;

    case 1:
      $('.main-logs').show();
      $('.login-logs').hide();
      break;

    case 2:
      $('.addform').show();
      $('.deleteform, #bug_table, .searchform').hide();
      break;

    case 3:
      $('.deleteform, #bug_table').show();
      $(' .addform, .searchform').hide();
      break;

  //  case 4:
    //  $('.searchform').show();
      //break;

    case 5:

      $('.addform').hide();
      $('#bug_table').show();
      break;

    case 6:

      $('.deleteform').hide();

      break;



    default:

  }
}
