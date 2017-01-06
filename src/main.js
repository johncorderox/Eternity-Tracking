$(document).ready(function() {

    $('.greeting').hide();


    $("#name").keyup(function(event) {

        if (event.keyCode == 13) {

            $('#next-button').click();

        }

    });

    $('#title').keyup(function(event) {


      if(event.keyCode == 13) {

        $('#message').focus();

      }

    })

});

var personDetails = {

    name: "",
    usage: ""


};

var taskDetails = {

    title: "",
    content: ""


};

var infoCount = 0;

function info() {


  switch (infoCount) {
    case 0:
            var name = $('#name').val();

            if(name == '') {
              alert("no new name");
              var name_color = document.getElementById('questions').innerHTML;
              var new_name_color = name_color.search("name");
              $(new_name_color).css("color", "red");

            }
            //working on changing name to red when empty field.
            // case 1 is not eing called.

            personDetails.name = name;
            document.getElementById('name').value = "";
            infoCount+1;
            document.getElementById('questions').innerHTML = "And what is this task about?";
            $('#name').attr('placeholder', 'i.e. Shopping, Homework');
            break;

    case 1:

            var usage = $('#name').val();
            personDetails.usage = usage;
            $('.intro').remove();
            main_menu();
            break;


    default:

            console.log("There was an error in the info function when asking for a name or task subject.")

  }

}


function greeting() {



  var rand = Math.floor((Math.random() * 3) + 1);
   var greeting = ["Hello", "Hey", "Hi", "How are you"];



     document.getElementById('hello').innerHTML = greeting[rand] + ", " + personDetails.name + ".";




}






function main_menu(num) {


      greeting();
      $('.greeting').show("slow");




}


function addTask() {


  $('.add-task .form-control').each(function() {

      if($(this).val() === '') {

        $(this).addClass('error-output');
      }

  });

}

function clearTaskFields() {





}




// SUGGESTIONS
//==========================================
// what is this used for? Icons like a shopping cart, a paper and pencil, homework, etc


// have colors at almost every text

//show me how?

// timer that adds a value in the input field so it shows that it changes the color for them

//ajax request to show colors when being typed.


// add english and spanish translation || japanese


// COLORFUL task list-unstyled

// shows your tasks with random colors.

//ajax comon things like names/ shopping/ to do


// counter for tasks.

// Hello John. It is (date) and you have 5 tasks

// go back button

// error input for empty fields


//grid system for bottom half of application
