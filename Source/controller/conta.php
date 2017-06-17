<?php
		require_once("../model/Usuario.php");
		$user = new Usuario();
		$testeSessao = $user->validaSession();
		if($testeSessao){
	      require("../model/Conta.php");
	      $cont = new Conta();
	      if(isset($_POST['adConta'])){
	      	      	$cont->setDesc($_POST['descricao']);
			      	$cont->setDataCriacao($_POST['data']);
			      	$cont->setDataPagamento($_POST['datapgto']);
			      	$valor = $_POST['valor'];
			      	$valor = str_replace(",", ".", $valor);
			      	$cont->setValor($valor);
			      	$cont->setTipo($_POST['tipo']);
			      	$cont->setPago($_POST['pago']);
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
	      }else if(isset($_POST['visualizar'])){
					$id = $_POST['id'];
					$erro = "";
					$cont->visualizarConta($id, $erro);
	      }else if(isset($_POST['excluir'])){
	        $erro = "";
					$id = $_POST['id'];
	        $cont->excluirConta($id, $erro);
	      }else if(isset($_POST['salvar'])){
					$erro = "";
					$id = $_POST['id'];
					$cont->editarConta($id, $_POST['descricao'], $_POST['data'], $_POST['dataefetiva'], $_POST['valor'], $erro);
				}
		}else{
			header("Location: index.php");
		}

?>
