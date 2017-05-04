<?php
	if(!session_id()){
		session_start();
	}
	if(empty($_SESSION['id']) || empty($_SESSION['usuario'])){
		header("Location: ../../index.php");
	}else{
		require_once("../model/Usuario.php");
		$user = new Usuario();
		$user->verificaSessionNomeUsuario($_SESSION['id']);
	}
?>