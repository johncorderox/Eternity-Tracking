'use strict';


$(document).ready(function() {

    $('.greeting').hide();


    $("#name").keyup(function(event) {

        if (event.keyCode == 13) {

            $('#next-button').click();

        }

    });

    $('#title').keyup(function(event) {


        if (event.keyCode == 13) {

            $('#message').focus();

        }

    });

    $('#message').keyup(function(event) {


        if (event.keyCode == 13) {

            $('#submit-button').click();

        }

    });

});

var personDetails = {

    name: "",
    usage: ""


};

var infoCount = 0;

function info() {


    switch (infoCount) {
        case 0:
            var name = $('#name').val();

            if (name == '') {

                $('#name-span').css("color", "red");
                return;

            }

            personDetails.name = name;
            document.getElementById('name').value = "";
            infoCount = 1;
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

    document.getElementById('hello').innerHTML =` ${greeting[rand]}, ${ personDetails.name}! `;

}




function main_menu(num) {


    greeting();
    $('.greeting, .left-module').show("slow");




}

function showTask() {

    $('.task-cp').show();
}


function addTask() {

  var title = $('#title').val();
  var contents = $('#message').val();

  var li = document.createElement('li');
  
  li.text = `<h2>Title: ${title} </h2> <br>
                <p>Task: ${contents}</p> <br>`;

$('#test').append(li);



}





function clearTaskFields() {



    $('#title').val('');
    $('#message').val('');


    $('#title, #message').removeClass('error-output');


}




// SUGGESTIONS
//==========================================
/*
<div class="panel panel-default">
  <div class="panel-heading">Panel Heading</div>
  <div class="panel-body">Panel Content</div>
</div>
*/

// timer that adds a value in the input field so it shows that it changes the color for them

//ajax request to show colors when being typed.


//ajax comon things like names/ shopping/ to do
