$(document).ready(function(){
});

// @desc Case system that outputs data to the screen when a user submits a form.
// Things like Success! Error! or Warning! are common outputs.
// Using bootstrap-growl plugin for easier output.
//
// @args Triggers for output. var = num
function display_input_message(n) {
  switch (n) {
    case 0:
            $.bootstrapGrowl("Success! Thank you for helping us continue make our website grow.", {
              ele: 'body',
              type: 'Success',
              align: 'right',
              offset: {from: 'top', amount: 110},
              width: 450,
              delay: 4000,
              allow_dismiss: true,
              stackup_spacing: 10
            });
            //Hides form so it cannot be submitted more than once.
            $('.addform, .requirements').hide(1000);
            break;
    case 1:
            $.bootstrapGrowl("It looks like you missed some information! Please fill in all fields.", {
                  ele: 'body',
                  type: 'danger',
                  align: 'right',
                  offset: {from: 'top', amount: 110},
                  width: 450,
                  delay: 4000,
                  allow_dismiss: false,
                  stackup_spacing: 10
                });
                break;


    default:

  }

}
