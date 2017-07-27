'use strict';

$(document).ready(function() {

  var message = $('#message').val();
  var comment_button = $('#add_comment');

  $('#user-table').css("width", "35%");


  $('#radio_default').prop("checked", true);



  $('.login-logs, .deleteform, #hiddenInput, .removeuserform, .newuserform').hide();


  $('.comment_view, .addform').hide();


  $('#search-button').on("click", function(){

    $('#review-default-table').toggle();

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
    $('body').scrollTo('body', {
      duration: 300
    });



  }


}

function reveal(x) {

  $('.account_info').hide();

  switch (x) {
    case 0:
      $('.login-logs').fadeIn();
      $('.main-logs').fadeOut();
      break;

    case 1:
      $('.main-logs').fadeIn();
      $('.login-logs').fadeOut();
      break;

    case 2:
      $('.addform').show();
      $('.deleteform, table, .searchform, .bug-review-search').hide();
      break;

    case 3:
      $('.deleteform, #bug_table').show();
      $(' .addform, .searchform, .bug-review-search').hide();
      break;

      //  case 4:
      //  $('.searchform').show();
      //break;

    case 5:

      $('.addform').hide();
      $('table, .bug-review-search').show();
      break;

    case 6:

      $('.deleteform').hide();
      $('.bug-review-search, table').show();

      break;

    case 7:

      $('.newuserform').toggle();
      $('.removeuserform').hide();
      break;

    case 8:

      $('.newuserform').hide();
      break;

      case 9:

        $('.removeuserform').toggle();
        $('.newuserform').hide();
        break;


    default:

  }
}
