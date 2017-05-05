<?php
  if(!session_id()){
    session_start();
  }
  session_destroy();
  unset($_SESSION);
  header("Location: ../../index.php");
?>
