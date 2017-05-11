<?php
		require_once("../model/Usuario.php");
		$user = new Usuario();
		$testeSessao = $user->validaSession();
		if($testeSessao){
      require("../model/Conta.php");
      $cont = new Conta();
      $cont->setDesc($_POST['descricao']);
      $cont->setDataCriacao($_POST['data']);
      $cont->setDataPagamento($_POST['datapgto']);
      $cont->setValor($_POST['valor']);
      $cont->setTipo($_POST['tipo']);
      $cont->setPago($_POST['pago']);
      if(isset($_POST['adConta'])){
				$title = ("Manage Clinics - Adicionar Conta");
				$css = ("../view/");
				require("../view/head.php");
				require("../view/menu.php");
				$verif = $cont->verificaData($cont->getDataCriacao());
				$verif2 = $cont->verificaData($cont->getDataPagamento());
				$dt = $cont->getDataPagamento();
				if(($verif && $verif2) || ($verif && (empty($dt)))){
					$testInsert = $cont->insereConta();
					if($testInsert){
							$erro = "<h3 style=\"color:red;\">*Conta inserida*</h3>";
							require("../view/formAdicionarConta.php");
					}else{
						$erro = "<h3 style=\"color:red;\">*Erro ao inserir conta*</h3>";
						require("../view/formAdicionarConta.php");
					}

				}else{
					$erro = "<h3 style=\"color:red;\">*Formato de data incorreto*</h3>";
					require("../view/formAdicionarConta.php");
				}
      }
		}else{
			header("Location: index.php");
		}

?>
