$(document).ready(function(){

    $('#submit_button, .second').hide();
    $('#answer_del').focus();

    $('#answer_del').keypress(function(){


        $('#submit_button').fadeIn(1000);

    });

    $('#answer_del').keypress(function (e) {

    if(e.which ==13)

          $('#submit_button').click();
          $('#del_pass').focus();

  });

});


function getDeleteAnswer () {

  var  ans = $('#answer_del').val();

    if (ans.toLowerCase() === 'no') {

        window.location = "main.php";

    }

    else if (ans.toLowerCase() === 'yes') {
      $('.first').hide();
      $('.second').fadeIn("fast");

      $('#del_pass').focus();

    }

    else {

      window.location = "main.php";
    }


}
