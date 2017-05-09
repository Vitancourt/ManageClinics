<?php
		$css = "";
		$title = "Manage Clinics - Adicionar conta";
		require("head.php");
		require("../model/Usuario.php");
		$user = new Usuario();
		$testeSessao = $user->validaSession();
		if($testeSessao){
			require("menu.php");
			$erro = "";
			require("formAdicionarConta.php");
		}else{
			header("Location: index.php");
		}

?>
