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
      }else if(isset($_POST['editar'])){
				$erro = "";
        $pac->setId($id);
        $pac->visualizarPaciente($pac->getId(), $erro);
			}else if(isset($_POST['salvar'])){
				$erro = "";
				$pac->setId($id);
				$pac->setNome($_POST['nome']);
				$pac->setCPF($_POST['cpf']);
				$pac->setDataNasc($_POST['datanasc']);
				$pac->setInicioTrat($_POST['datainicio']);
				$pac->setTelCelular($_POST['telefoneCel']);
				$pac->setTelResidencial($_POST['telefoneRes']);
				$pac->setTelComercial($_POST['telefoneCom']);
				$pac->editarPaciente($pac->getId(), $pac->getNome(), $pac->getCPF(), $pac->getDataNasc(), $pac->getInicioTrat(), $pac->getTelCelular(), $pac->getTelResidencial(), $pac->getTelComercial(), $erro);
			}
		}else{
			header("Location: index.php");
		}

?>
