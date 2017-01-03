$(document).ready(function() {


      $("#name").keyup(function(event) {

          if (event.keyCode == 13) {

            $('#next-button').click();

          }

      });

      $('#main').hide();

});

var personDetails = {

  name : "",
  usage : ""


};


function start () {


  var name = $('#name').val();

  document.getElementById('questions').innerHTML = "And what is this used for?";
  personDetails.name = name;
  start_two();



}

function start_two() {

  document.getElementById('name').value = "";

  var usage = $('#name').val();
  personDetails.usage = usage;
  $('#main').show("fast");
  $('#next-button').hide();



}

function main_menu () {

  $('.main').remove();




}
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
