<?php
require_once 'functions.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(isset($_POST['delete_consult'])){
    echo deleteConsult($_POST['consultatieID']);
  }

}

?>
