<?php
/**Teste de sessão**/
require_once("../model/Usuario.php");
if(!session_id()){
  session_start();
}
$user = new Usuario();
$testeSessao = $user->validaSession();
if(!$testeSessao){
  header("Location: ../../index.php");
}

#Verificação do botao
if(isset($_POST['adUsuario'])){
    $css = "../view/";
    $title = "Manage Clinics - Adicionar Paciente";
    require_once("../view/head.php");
    require_once("../view/menu.php");
    $nome = $_POST["nome"];
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    $user->setNome($nome);
    $user->setUsuario(md5($usuario));
    $user->setSenha(md5($senha));
    $user->setCargo("1");
    $user->setAtivo("1");

    $valida = $user->validaInsert($user->getNome(), $user->getUsuario(), $user->getSenha(), $user->getCargo(), $user->getAtivo());

    if($valida){

      $testeinsert = $user->insereUsuario();

      if($testeinsert){
        $erro = "<h5 style=\"color:red;\">*Usuário inserido.*</h5>";
        require_once("../view/formAdicionarUsuario.php");
      }else{
        $erro = "<h5 style=\"color:red;\">*Erro ao inserir usuário.*</h5>";
        require_once("../view/formAdicionarUsuario.php");
      }
    }else{
      $erro = "<h5 style=\"color:red;\">*Falha no DB.*</h5>";
      require_once("../view/formAdicionarUsuario.php");
    }
}else{
  header("Location: ../view/index.php");
}
?>
