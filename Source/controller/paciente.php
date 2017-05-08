<?php
		require_once("../model/Usuario.php");
		$user = new Usuario();
		$testeSessao = $user->validaSession();
		if($testeSessao){
      $id = $_POST['id'];
      require_once("../model/Paciente.php");
      $pac = new Paciente();
      if(isset($_POST['visualizar'])){
        $erro = "";
        $pac->setId($id);
        $pac->visualizarPaciente($pac->getId(), $erro);
      }else if(isset($_POST['reativar'])){
        $erro = "";
        $pac->setId($id);
        $pac->reativarPaciente($pac->getId(), $erro);
      }else if(isset($_POST['excluir'])){
        $erro = "";
        $pac->setId($id);
        $pac->excluirPaciente($pac->getId(), $erro);        
      }
		}else{
			header("Location: index.php");
		}

?>
