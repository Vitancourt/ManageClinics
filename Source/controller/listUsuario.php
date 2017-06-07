<?php
  require_once("../model/Usuario.php");
  $user = new Usuario();
  $testeSessao = $user->validaSession();
  if($testeSessao){
    //Chama método que imprimeS
    $user->listarUsuario();
  }else{
    header("Location: index.php");
  }

?>
