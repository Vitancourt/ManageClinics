<?php
		$css = "";
		$title = "Manage Clinics - Procurar contas";
		require_once("head.php");
		require_once("../model/Usuario.php");
		$user = new Usuario();
		$testeSessao = $user->validaSession();
		if($testeSessao){
			require_once("menu.php");
			$erro = "";
			require_once("procurarConta.php");
		}else{
			header("Location: index.php");
		}

?>
