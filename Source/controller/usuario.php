<?php
		require_once("../model/Usuario.php");
		$user = new Usuario();
		$testeSessao = $user->validaSession();
		if($testeSessao){
      $id = $_POST['id'];
      require_once("../model/Usuario.php");
      $pac = new Usuario();
      if(isset($_POST['visualizar'])){
        $erro = "";
        $pac->setId($id);
        $pac->visualizarUsuario($pac->getId(), $erro);
      }else if(isset($_POST['reativar'])){
        $erro = "";
        $pac->setId($id);
        $pac->reativarUsuario($pac->getId(), $erro);
      }else if(isset($_POST['excluir'])){
        $erro = "";
        $pac->setId($id);
        $pac->excluirUsuario($pac->getId(), $erro);
      }else if(isset($_POST['editar'])){
				$erro = "";
        $pac->setId($id);
        $pac->visualizarUsuario($pac->getId(), $erro);
			}else if(isset($_POST['salvar'])){
				$erro = "";
				$pac->setId($id);
				$pac->setNome($_POST['nome']);
				$pac->editarUsuario($pac->getId(), $pac->getNome(), $erro);
			}
		}else{
			header("Location: index.php");
		}

?>
