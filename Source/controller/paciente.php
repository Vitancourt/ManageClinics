<?php
		require_once("../model/Usuario.php");
		$user = new Usuario();
		$testeSessao = $user->validaSession();
		if($testeSessao){
      if(isset($_POST['visualizar'])){
        $erro = "";
  			$id = $_POST['id'];
        require_once("../model/Paciente.php");
        $pac = new Paciente();
        $pac->setId($id);
        $pac->visualizarPaciente($pac->getId(), $erro);
      }
		}else{
			header("Location: index.php");
		}

?>
