$(document).ready(function() {

  var message = $('#message').val();
  var comment_button = $('#add_comment');

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
