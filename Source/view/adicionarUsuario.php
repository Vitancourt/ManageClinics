<?php
		$css = "";
		$title = "Manage Clinics - Adicionar usuário";
		require("head.php");
		require("../model/Usuario.php");
		$user = new Usuario();
		$testeSessao = $user->validaSession();
		if($testeSessao){
			require("menu.php");
			$erro = "";
			require("formAdicionarPaciente.php");
		}else{
			header("Location: index.php");
		}

?>
