// @desc Case system that outputs data to the screen when a user submits a form.
// Things like Success! Error! or Warning! are common outputs.
// Using bootstrap-growl plugin for easier output.
//
// @args Triggers for output. var = num


'use strict';

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
      $.bootstrapGrowl("Password Changed Successfully.", {
        ele: 'body',
        type: 'success',
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

    case 9:
      $.bootstrapGrowl("Email Updated Successfully", {
        ele: 'body',
        type: 'success',
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

    case 10:
      $.bootstrapGrowl("Bug Details Saved Successfully!", {
        ele: 'body',
        type: 'success',
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

    case 11:
      $.bootstrapGrowl("Comment added!", {
        ele: 'body',
        type: 'success',
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


    case 12:
      $.bootstrapGrowl("Comment has been deleted!!", {
        ele: 'body',
        type: 'success',
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

    case 13:
      $.bootstrapGrowl("Bug has been undeleted!", {
        ele: 'body',
        type: 'success',
        align: 'right',
        offset: {
          from: 'top',
          amount: 30
        },
        width: 450,
        delay: 3000,
        allow_dismiss: true,
        stackup_spacing: 10
      });
      break;

    case 14:
      $.bootstrapGrowl("Bug has been permanently deleted from the DB", {
        ele: 'body',
        type: 'success',
        align: 'right',
        offset: {
          from: 'top',
          amount: 50
        },
        width: 450,
        delay: 3000,
        allow_dismiss: true,
        stackup_spacing: 10
      });

      $.bootstrapGrowl("All comments associated have also been removed", {
        ele: 'body',
        type: 'info',
        align: 'right',
        offset: {
          from: 'top',
          amount: 80
        },
        width: 450,
        delay: 3500,
        allow_dismiss: true,
        stackup_spacing: 10
      });
      break;


    case 15:
      $.bootstrapGrowl("Marked Bug Status As Open.", {
        ele: 'body',
        type: 'success',
        align: 'right',
        offset: {
          from: 'top',
          amount: 30
        },
        width: 450,
        delay: 3000,
        allow_dismiss: true,
        stackup_spacing: 10
      });
      break;

    case 16:
      $.bootstrapGrowl("Marked Bug Status As In Review.", {
        ele: 'body',
        type: 'success',
        align: 'right',
        offset: {
          from: 'top',
          amount: 30
        },
        width: 450,
        delay: 3000,
        allow_dismiss: true,
        stackup_spacing: 10
      });
      break;


    case 17:
      $.bootstrapGrowl("Marked Bug Status As More Info Needed.", {
        ele: 'body',
        type: 'success',
        align: 'right',
        offset: {
          from: 'top',
          amount: 30
        },
        width: 450,
        delay: 3000,
        allow_dismiss: true,
        stackup_spacing: 10
      });
      break;


    case 18:
      $.bootstrapGrowl("Marked Bug Status As Invalid.", {
        ele: 'body',
        type: 'success',
        align: 'right',
        offset: {
          from: 'top',
          amount: 30
        },
        width: 450,
        delay: 3000,
        allow_dismiss: true,
        stackup_spacing: 10
      });
      break;

    case 19:
      $.bootstrapGrowl("All Deleted Bugs Have Been Removed.", {
        ele: 'body',
        type: 'success',
        align: 'right',
        offset: {
          from: 'top',
          amount: 30
        },
        width: 450,
        delay: 3000,
        allow_dismiss: true,
        stackup_spacing: 10
      });
      break;

    case 20:
      $.bootstrapGrowl("There Was An Error Submitting The Request!", {
        ele: 'body',
        type: 'danger',
        align: 'right',
        offset: {
          from: 'top',
          amount: 30
        },
        width: 450,
        delay: 3000,
        allow_dismiss: true,
        stackup_spacing: 10
      });
      break;
      
    case 21:
      $.bootstrapGrowl("Your Account Login Count has been reset.", {
        ele: 'body',
        type: 'success',
        align: 'right',
        offset: {
          from: 'top',
          amount: 30
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
