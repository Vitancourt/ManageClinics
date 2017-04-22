<?php
		$css = "";
		$title = "Manage Clinics - Home";
		require("head.php");
		require("../model/Usuario.php");
		$user = new Usuario();
		$testeSessao = $user->validaSession();
		if($testeSessao){
			require("menu.php");
			require("home.php");
		}else{
			header("Location: index.php");
		}

?>
