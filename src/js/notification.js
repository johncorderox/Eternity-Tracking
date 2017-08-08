
'use strict';

function display_input_message(num, status) {

  var phrases = ['Bug Added to the Database Successfully.',
                 'Bug Deleted from the Database Successfully.',
                 'Successful Login!',
                 'Logout Successful!',
                 'The Account Has Been Removed Successfully.',
                 'There Is Only 1 Account Left!',
                 'New User added to the Database',
                 'MYSQL ERROR: Some requirements were not met.',
                 'Password Changed Successfully.',
                 'Email Updated Successfully,',
                 'Bug Details Saved Successfully!',
                 'Comment added!',
                 'Comment has been deleted!',
                 'Bug has been undeleted!',
                 'Bug has been permanently deleted from the Database.',
                 'Marked Bug Status As Open.',
                 'Marked Bug Status As In Review.',
                 'Marked Bug Status As More Info Needed.',
                 'Marked Bug Status As Invalid.',
                 'All Deleted Bugs Have Been Removed.',
                 'There Was An Error Submitting The Request!',
                 'Your Account Login Count has been reset.',
                 'Your Account Has Been Deleted. Goodbye!'

               ];

          var status = status;

          $.bootstrapGrowl(phrases[num], {
            ele: 'body',
            type: status,
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

}
