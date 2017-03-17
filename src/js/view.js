$(document).ready(function() {


    $('.editform, .deleteform, .newuserform, .removeuserform').hide();


    $('#check_bug').click(function() {

        $('#table_bugs').toggle();

    });


});

// @desc Case system that outputs data to the screen when a user submits a form.
// Things like Success! Error! or Warning! are common outputs.
// Using bootstrap-growl plugin for easier output.
//
// @args Triggers for output. var = num
function display_input_message(n) {
    switch (n) {
        case 0:
            $.bootstrapGrowl("Bug Added to the Database Successfully.", {
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

        case 1:
            $.bootstrapGrowl("Bug Deleted from the Database Successfully.", {
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

        case 2:
            $.bootstrapGrowl("Successful Login!", {
                ele: 'body',
                type: 'info',
                align: 'right',
                offset: {
                    from: 'top',
                    amount: 40
                },
                width: 450,
                delay: 3500,
                allow_dismiss: true,
                stackup_spacing: 10
            });
            break;


        case 3:
            $.bootstrapGrowl("Logout Successful!", {
                ele: 'body',
                type: 'info',
                align: 'right',
                offset: {
                    from: 'top',
                    amount: 40
                },
                width: 450,
                delay: 3500,
                allow_dismiss: true,
                stackup_spacing: 10
            });
            break;

        case 4:
            $.bootstrapGrowl("The Account Has Been Removed Successfully.", {
                ele: 'body',
                type: 'Success',
                align: 'right',
                offset: {
                    from: 'top',
                    amount: 40
                },
                width: 450,
                delay: 3500,
                allow_dismiss: true,
                stackup_spacing: 10
            });
            break;


        case 5:
            $.bootstrapGrowl("There Is Only 1 Account Left!", {
                ele: 'body',
                type: 'danger',
                align: 'right',
                offset: {
                    from: 'top',
                    amount: 40
                },
                width: 450,
                delay: 3500,
                allow_dismiss: true,
                stackup_spacing: 10
            });
            break;


        case 6:
            $.bootstrapGrowl("New User added to the Database", {
                ele: 'body',
                type: 'Success',
                align: 'right',
                offset: {
                    from: 'top',
                    amount: 40
                },
                width: 450,
                delay: 3500,
                allow_dismiss: true,
                stackup_spacing: 10
            });
            break;

        case 7:
            $.bootstrapGrowl("MYSQL ERROR: Some requirements were not met.", {
                ele: 'body',
                type: 'danger',
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

            case 8:
                $.bootstrapGrowl("The User ID Does Not Exist!", {
                    ele: 'body',
                    type: 'danger',
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
            console.log("Error in display input func. Check args");

    }


}
