<?php
  require_once("../model/Usuario.php");
  $user = new Usuario();
  $testeSessao = $user->validaSession();
  if($testeSessao){
    require_once("../model/Conta.php");
    $cont = new Conta();
    $cont->buscarConta($_POST['desc'], $_POST['data'], $_POST['filtro']);
  }else{
    header("Location: index.php");
  }

?>
