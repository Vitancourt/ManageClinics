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
				$verif = $cont->verificaData($cont->getDataCriacao());
				$verif2 = $cont->verificaData($cont->getDataPagamento());
				$dt = $cont->getDataPagamento();
				if(($verif && $verif2) || ($verif && (empty($dt)))){
					$cont->setDataCriacao($cont->converterData($cont->getDataCriacao()));
					$cont->setDataPagamento($cont->converterData($cont->getDataPagamento()));
					echo $cont->getDataCriacao();
					echo $cont->getDataPagamento();
					echo "olá";
				}else{
					echo "não";
				}
      }
		}else{
			header("Location: index.php");
		}

?>
