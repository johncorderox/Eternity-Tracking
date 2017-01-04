$(document).ready(function() {

    $('.greeting').hide();


    $("#name").keyup(function(event) {

        if (event.keyCode == 13) {

            $('#next-button').click();

        }

    });

});

var personDetails = {

    name: "",
    usage: ""


};

var taskDetails = {

    title: "",
    content: ""




};

function info() {

    $('#skip-button').hide();

    if (personDetails.name == "") {

        var name = $('#name').val();
        personDetails.name = name;
        document.getElementById('name').value = "";

    }

    if (personDetails.name) {

        var usage = $('#name').val();

        document.getElementById('questions').innerHTML = "And what is this task about?";
        $('#name').attr('placeholder', 'i.e. Shopping, Homework');
        personDetails.usage = usage;

    }

    if (personDetails.name && personDetails.usage) {

        $('.intro').remove();
        main_menu();

    }


}

function greeting(num) {

    var rand = Math.floor((Math.random() * 3) + 1);
    var greeting = ["Hello", "Hey", "Hi", "How are you"];


    if (num != 0) {

        document.getElementById('hello').innerHTML = greeting[rand] + "!";

    } else

        document.getElementById('hello').innerHTML = greeting[rand] + ", " + personDetails.name + ".";

}


function main_menu(num) {

    if (num === 0) {

        greeting(0);

    }
    greeting();
    $('.greeting').show("slow");


}


function addTask() {



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
