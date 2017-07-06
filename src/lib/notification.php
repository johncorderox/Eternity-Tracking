<?php

  class Notification {


    public function redirects() {

        if(isset($_GET['add'])) {

          header("location: add_main.php");
          exit();
        }

        else if(isset($_GET['delete'])) {

          header("location: delete_main.php");
          exit();
        }

        else if(isset($_GET['add_new'])) {

          header("location: add_new_main.php");
          exit();
        }

        else if(isset($_GET['remove_user'])) {

            header("location: remove_user_main.php");
            exit();

          }


    }

    public function notifications() {

      if (isset($_GET['successbug']) && $_GET['successbug']=='1') {

        echo '<script type="text/javascript">
              display_input_message(0);
              </script>';

      }

      if (isset($_GET['deletebug']) && $_GET['deletebug']=='1') {

        echo '<script type="text/javascript">
              display_input_message(1);
              </script>';

      }

      if (isset($_GET['login']) && $_GET['login']=='1') {

        echo '<script type="text/javascript">
              display_input_message(2);
              </script>';

      }

      if (isset($_GET['removeuser']) && $_GET['removeuser']=='1') {

        echo '<script type="text/javascript">
              display_input_message(4);
              </script>';

      }

      if (isset($_GET['newuser']) && $_GET['newuser']=='1') {

        echo '<script type="text/javascript">
              display_input_message(6);
              </script>';

      }

      if (isset($_GET['savebug']) && $_GET['savebug']=='1') {

        echo '<script type="text/javascript">
              display_input_message(0);
              </script>';

      }
      if (isset($_GET['accept']) && $_GET['accept']=='1') {

        echo '<script type="text/javascript">
              display_input_message(6);
              </script>';

      }

      if (isset($_GET['successcomment']) && $_GET['successcomment']=='1') {

        echo '<script type="text/javascript">
              display_input_message(11);
              </script>';

      }

      if (isset($_GET['deletecomment']) && $_GET['deletecomment']=='1') {

        echo '<script type="text/javascript">
              display_input_message(12);
              </script>';

      }

    }



  }


 ?>
