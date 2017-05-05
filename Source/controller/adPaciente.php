<?php
/**Teste de sessão**/
require_once("../model/Usuario.php");
if(!session_id()){
  session_start();
}
$user = new Usuario();
$testeSessao = $user->validaSession();
if(!$testeSessao){
  header("Location: ../../index.php");
}

#Verificação do botao
if(isset($_POST['adPaciente'])){
    $css = "../view/";
    $title = "Manage Clinics - Adicionar Paciente";
    require_once("../view/head.php");
    require_once("../view/menu.php");
    require_once("../model/Paciente.php");
    $pac = new Paciente();
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $datanasc = $_POST['datanasc'];
    $datainicio = $_POST['datainicio'];
    $telcel = $_POST['telefoneCel'];
    $telres = $_POST['telefoneRes'];
    $telcom = $_POST['telefoneCom'];

    $pac->setNome($nome);
    $pac->setCPF($cpf);
    $pac->setDataNasc($datanasc);
    $pac->setInicioTrat($datainicio);
    $pac->setTelCelular($telcel);
    $pac->setTelResidencial($telres);
    $pac->setTelComercial($telcom);
    $pac->setAtivo("1");

    $valida = $pac->validaCampos($pac->getNome());

    if($valida){
        $validaDataNasc = $pac->verificaData($pac->getDataNasc());

        $validaInicioTrat = $pac->verificaData($pac->getInicioTrat());

      if(($validaInicioTrat) && ($validaDataNasc)){
        $insere = $pac->inserePaciente();
        if($insere){
          $css = "../view/";
          require_once("../view/head.php");
          require_once("../view/menu.php");
          $erro = "<h5 style=\"color:red;\">*Paciente inserido.*</h5>";
          require_once("../view/formAdicionarPaciente.php");
        }else{
          $css = "../view/";
          require_once("../view/head.php");
          require_once("../view/menu.php");
          $erro = "<h5 style=\"color:red;\">*Ocorreu um erro no cadastro, contate o dev.*</h5>";
          require_once("../view/formAdicionarPaciente.php");
        }
      }else{
        $css = "../view/";
        require_once("../view/head.php");
        require_once("../view/menu.php");
        $erro = "<h5 style=\"color:red;\">*Data inválida! (Formato adequado = 15/04/1993)*</h5>";
        require_once("../view/formAdicionarPaciente.php");
      }
    }else{
      $css = "../view/";
      require_once("../view/head.php");
      require_once("../view/menu.php");
      $erro = "<h5 style=\"color:red;\">*O campo \"Nome\" é obrigatório!*</h5>";
      require_once("../view/formAdicionarPaciente.php");
    }
}else{
  header("Location: ../view/index.php");
}
?>
