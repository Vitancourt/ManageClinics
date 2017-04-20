<?php
if(isset($_POST['buttonlogar'])){
    require("../model/Usuario.php");
    $user = new Usuario();
    $usuario = $_POST['usuario'];
    $senha = $_POST['password'];
    $user->setUsuario($usuario);
    $user->setSenha($senha);
    $validacao = $user->validaUsuarioSenha($user->getUsuario(), $user->getSenha());
    //verifica se o botão foi pressionado
    if(!$validacao){
            $css = "../view/";
            $title = "Manage Clinics - Login";
            require("../view/head.php");
            $index = "../view/";
            require("../view/menuoff.php");
            $erro = "<h5 style=\"color: red; font-weight: bold;\">*O campo usuário e senha são obrigatórios!*</h3>";
            require("../view/formlogin.php");
    }else{
        $login = $user->logar($user->getUsuario(), $user->getSenha());
        if($login){
            $user->iniciaSession($login);
            if($user){
                header("Location: ../view/homepage.php");
            }else{
                echo "ERRO SESSÃO";
            }
        }else{
            $css = "../view/";
            $title = "Manage Clinics - Login";
            require("../view/head.php");
            $index = "../view/";
            require("../view/menuoff.php");
            $erro = "<h5 style=\"color: red; font-weight: bold;\">*A combinação de dados está incorreta!*</h3>";
            require("../view/formlogin.php");            
        }
    }  
}
?>
