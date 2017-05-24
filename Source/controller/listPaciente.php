<?php
  require_once("../model/Usuario.php");
  $user = new Usuario();
  $testeSessao = $user->validaSession();
  if($testeSessao){
    require_once("../model/Paciente.php");
    $pac = new Paciente();
    $pac->buscarPacientesAtivos();
  }else{
    header("Location: index.php");
  }

?>
