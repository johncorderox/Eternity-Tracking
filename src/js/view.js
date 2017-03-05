$(document).ready(function() {


    $('.addform2, .editform, .deleteform, .newuserform, .removeuserform').hide();

    //  display_input_message(0);

});

// @desc Case system that outputs data to the screen when a user submits a form.
// Things like Success! Error! or Warning! are common outputs.
// Using bootstrap-growl plugin for easier output.
//
// @args Triggers for output. var = num
function display_input_message(n) {
    switch (n) {
            case 0:
                $.bootstrapGrowl("Bug Added to the Database Succcessfully.", {
                    ele: 'body',
                    type: 'Success',
                    align: 'right',
                    offset: {
                        from: 'top',
                        amount: 40
                    },
                    width: 450,
                    delay: 3000,
                    allow_dismiss: true,
                    stackup_spacing: 10
                });
                break;

        default:
            console.log("Error in display_input func. Check args");

    }


}
