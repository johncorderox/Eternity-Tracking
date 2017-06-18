<?php
class Connect {

      public $servername = 'localhost';
      public $username   = 'root';
      public $password   = '';
      public $database   = 'tracking';


          public function connect() {

            $this->connect = new mysqli($this->servername, $this->username, $this->password, $this->database);

            return $this->connect;
          }

          public function setConnect($s,$u,$p,$d) {

            $this->servername = $s;
            $this->username = $u;
            $this->password = $p;
            $this->database = $d;

          }

          public function getConnectAll() {

            return "Servername = " .$this->servername . "<br />"
                  ."Username   = " .$this->username   . "<br />"
                  ."Database   = " .$this->database   . "<br />";



        }

        public function getServer() {

          return $this->servername;

        }

        public function getDatabase() {

          return $this->database;

        }


          public function Console() {

            if($this->connect) {

            echo  "The connection to ". $this->$servername . "was successful!";

            } else {

            echo mysqli_error(mysqli_error($this->connect()));

            }


          }

          public function destroy() {

            $close = $this->mysqli->close();

            if(!$close) {

              echo "There was a problem closing a connection to server ".$this->servername;

            }
          }


    }
?>
