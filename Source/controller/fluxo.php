<?php
		require_once("../model/Usuario.php");
		$user = new Usuario();
		$testeSessao = $user->validaSession();
		if($testeSessao){
	      require_once("../model/Conta.php");
	      $cont = new Conta();
	      if(isset($_POST['filtrar'])){
          $cont->filtrar($_POST['datainicio'], $_POST['datafim'], "");
          //require_once("../view/mostrarFluxo.php");
        }else{
          $erro = "";
          echo "
          <form action=\"../controller/fluxo.php\" method=\"post\">
                  ".$erro."
                  <div class=\"form-group\">
                          <label>Data de início (DD/MM/AAAA)</label>
                          <input onkeypress=\"mascara(this, mdata);\" class=\"form-control\" type=\"datetime\" name=\"datainicio\" maxlength=\"10\" value=\"\"  >
                          <label>Data fim (DD/MM/AAAA)</label>
                          <input onkeypress=\"mascara(this, mdata);\" class=\"form-control\" type=\"text\" name=\"datafim\" maxlength=\"10\" value=\"\">

              <button type=\"submit\" name=\"filtrar\" class=\"btn btn-primary\"> Filtrar </button>
          </form>";
        }
		}else{
			header("Location: index.php");
		}

?>
