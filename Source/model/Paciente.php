<?php
require_once("../model/Pessoa.php");
class Paciente extends Pessoa
{
  private $cpf;
  private $dataNasc;
  private $inicioTrat;
  private $telCelular;
  private $telResidencial;
  private $telComercial;
  private $ativo;

  function setCPF($cpf){
    $this->cpf = $cpf;
  }

  function getCPF(){
    return $this->cpf;
  }

  function setDataNasc($dataNasc){
    $this->dataNasc = $dataNasc;
  }

  function getDataNasc(){
    return $this->dataNasc;
  }

  function setInicioTrat($inicioTrat){
    $this->inicioTrat = $inicioTrat;
  }

  function getInicioTrat(){
    return $this->inicioTrat;
  }

  function setTelCelular($telCelular){
    $this->telCelular = $telCelular;
  }

  function getTelCelular(){
    return $this->telCelular;
  }

  function setTelResidencial($telResidencial){
    $this->telResidencial = $telResidencial;
  }

  function getTelResidencial(){
    return $this->telResidencial;
  }

  function setTelComercial($telComercial){
    $this->telComercial = $telComercial;
  }

  function getTelComercial(){
    return $this->telComercial;
  }

  function setAtivo($ativo){
    $this->ativo = $ativo;
  }

  function getAtivo(){
    return $this->ativo;
  }

  function validaCampos($nome){
    if(empty($nome)){
      return false;
    }else{
      $this->setAtivo("1");
      return true;
    }
  }

  public function verificaData($data){
    if((strlen($data)) == 10){
      $dat = explode("/","$data"); # fatia a string $dat em pedados, usando / como referência
      $d = $dat[0];
      $m = $dat[1];
      $y = $dat[2];
      $res = checkdate($m,$d,$y);
      if ($res == 1){
        $this->data = $dat[2].'-'.$dat[1].'-'.$dat[0];
        return true;
      } else {
        return false;
      }
    }else{
      return false;
    }
  }

  public function converterData($data){
    $dat = explode("/","$data"); # fatia a string $dat em pedados, usando - como referência
    $this->data = $dat[2].'-'.$dat[1].'-'.$dat[0];
    return $this->data;
  }

  public function reverteData($data){
    $dat = explode("-","$data"); # fatia a string $dat em pedados, usando - como referência
    $this->data = $dat[2].'/'.$dat[1].'/'.$dat[0];
    return $this->data;
  }

  public function inserePaciente(){
    self::setDataNasc(self::converterData(self::getDataNasc()));
    self::setInicioTrat(self::converterData(self::getInicioTrat()));
    require_once("../model/Database.php");
    $DB = Database::conectar();
    $sql = "insert into tbPaciente (id, nome, cpf, dataNasc, inicioTrat, telCelular, telResidencial, telComercial, ativo) values (NULL, :nome, :cpf, :dataNasc, :inicioTrat, :telCelular, :telResidencial, :telComercial, '1')";
    $nomePC = self::getNome();
    $consulta = $DB->prepare($sql);
    $consulta->bindParam(':nome', $nomePC, PDO::PARAM_STR);
    $consulta->bindParam(':cpf', $this->cpf, PDO::PARAM_STR);
    $consulta->bindParam(':dataNasc', $this->dataNasc, PDO::PARAM_STR);
    $consulta->bindParam(':inicioTrat', $this->inicioTrat, PDO::PARAM_STR);
    $consulta->bindParam(':telCelular', $this->telCelular, PDO::PARAM_STR);
    $consulta->bindParam(':telResidencial', $this->telResidencial, PDO::PARAM_STR);
    $consulta->bindParam(':telComercial', $this->telComercial, PDO::PARAM_STR);
    try{
      $consulta->execute();
      //echo $consulta->rowCount();
      if($consulta->rowCount() == 1){
        return true;
      }
    }catch(PDOException $e){
      echo ($e->getMessage());
      return false;
    }
  }

  public function buscarPacientesAtivos(){
    require_once("../model/Database.php");
    $DB = Database::conectar();
    $sql = "select * from tbPaciente order by nome asc;";
    $consulta = $DB->prepare($sql);
    try{
      $consulta->execute();
      //echo $consulta->rowCount();
      if($consulta->rowCount() >0){
        $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach($linha as $row){
          if($row['ativo'] == 0){
            $cor = "bgcolor=\"red\"";
          }else{
            $cor = "";
          }
          echo "
          <form action=\"visualizarPaciente.php\" method=\"post\">
            <tr>
                <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                <td ".$cor.">".$row['nome']."</td>
                <td><button type=\"submit\" name=\"visualizar\" class=\"btn btn-primary \"> Visualizar </button></td>
                <td><button type=\"submit\" name=\"editar\" class=\"btn btn-warning \"> Editar </button></td>
                <td><button type=\"submit\" name=\"excluir\" class=\"btn btn-danger \"> Excluir </button></td>
            </tr>
          </form>
          ";
        }
      }
    }catch(PDOException $e){
      echo ($e->getMessage());
      return false;
    }
  }


  public function buscarPacientesNome($nome){
    $nome = "%".$nome."%";
    require_once("../model/Database.php");
    $DB = Database::conectar();
    $sql = "select * from tbPaciente where nome like :nome order by nome asc;";
    $consulta = $DB->prepare($sql);
    $consulta->bindParam(':nome', $nome, PDO::PARAM_STR);

    try{
      $consulta->execute();
      //echo $consulta->rowCount();
      if($consulta->rowCount() == 1){
        $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach($linha as $row){
          echo "
          <form action=\"visualizarPaciente.php\" method=\"post\">
            <tr>
                <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                <td>".$row['nome']."</td>
                <td><button type=\"submit\" name=\"visualizar\" class=\"btn btn-primary \"> Visualizar </button></td>
                <td><button type=\"submit\" name=\"editar\" class=\"btn btn-warning \"> Editar </button></td>
                <td><button type=\"submit\" name=\"excluir\" class=\"btn btn-danger \"> Excluir </button></td>
            </tr>
          </form>
          ";
        }
      }
    }catch(PDOException $e){
      echo ($e->getMessage());
      return false;
    }
  }

  public function visualizarPaciente($id, $erro){
    require_once("../model/Database.php");
    $DB = Database::conectar();
    $sql = "select * from tbPaciente where id= :id;";
    $consulta = $DB->prepare($sql);
    $consulta->bindParam(':id', $id, PDO::PARAM_STR);

    try{
      $consulta->execute();
      //echo $consulta->rowCount();
      if($consulta->rowCount() == 1){
        $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach($linha as $row){
          echo "
          <form action=\"visualizarPaciente.php\" method=\"post\">
              <!-- /.row -->
              <div class=\"row\">
                  <div class=\"col-lg-8\">
                      ".$erro."
                      <div class=\"form-group\">
                              <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                              <label>Nome de paciente</label>
                              <input class=\"form-control\" type=\"text\" name=\"nome\" maxlength=\"50\" required value=\"".$row['nome']."\" >
                              <label>CPF</label>
                              <input class=\"form-control\" type=\"text\" name=\"cpf\" value=\"".$row['CPF']."\" >
                              <label>Data de nascimento (DD/MM/AAAA)</label>
                              <input onkeypress=\"mascara(this, mdata);\" class=\"form-control\" maxlength=\"19\" type=\"datetime\" name=\"datanasc\" maxlength=\"10\" value=\"".self::reverteData($row['dataNasc'])."\"  >
                              <label>Data de início do tratamento (DD/MM/AAAA)</label>
                              <input onkeypress=\"mascara(this, mdata);\" class=\"form-control\" type=\"text\" name=\"datainicio\" maxlength=\"10\" value=\"".self::reverteData($row['inicioTrat'])."\">
                              <label>Telefone celular</label>
                              <input onkeypress=\"mascara(this, mtel);\" id=\"telefone\" class=\"form-control\" type=\"text\" name=\"telefoneCel\" maxlength=\"15\" value=\"".$row['telCelular']."\">
                              <label>Telefone residencial</label>
                              <input onkeypress=\"mascara(this, mtel);\" id=\"telefone\" class=\"form-control\" type=\"text\" name=\"telefoneRes\" maxlength=\"15\" value=\"".$row['telResidencial']."\">
                              <label>Telefone comercial</label>
                              <input onkeypress=\"mascara(this, mtel);\" id=\"telefone\" class=\"form-control\" type=\"text\" name=\"telefoneCom\" maxlength=\"15\" value=\"".$row['telComercial']."\">
                  </div>
            ";
            if($row['ativo'] == 0){
              echo "
                  <button type=\"submit\" name=\"reativar\" class=\"btn btn-warning\"> Reativar </button>
              ";
            }
            echo "
                  <button type=\"submit\" name=\"salvar\" class=\"btn btn-primary\"> Salvar alterações </button>
                  <button type=\"submit\" name=\"excluir\" class=\"btn btn-danger\"> Excluir </button>
              </div>
            </div>
    </form>
          ";
        }
      }
    }catch(PDOException $e){
      echo ($e->getMessage());
      return false;
    }
  }

  public function reativarPaciente($id, $erro){
    require_once("../model/Database.php");
    $DB = Database::conectar();
    $sql = "update tbPaciente set ativo='1' where id= :id;";
    $consulta = $DB->prepare($sql);
    $consulta->bindParam(':id', $id, PDO::PARAM_STR);

    try{
      $consulta->execute();
      $erro = "<h3 style=\"color:red;\">*Paciente reativado*</h3>";
      self::visualizarPaciente($id, $erro);
    }catch(PDOException $e){
      echo ($e->getMessage());
      return false;
    }
  }

  public function excluirPaciente($id, $erro){
    require_once("../model/Database.php");
    $DB = Database::conectar();
    $sql = "update tbPaciente set ativo='0' where id= :id;";
    $consulta = $DB->prepare($sql);
    $consulta->bindParam(':id', $id, PDO::PARAM_STR);

    try{
      $consulta->execute();
      $erro = "<h3 style=\"color:red;\">*Paciente excluído*</h3>";
      self::visualizarPaciente($id, $erro);
    }catch(PDOException $e){
      echo ($e->getMessage());
      return false;
    }
  }

  public function editarPaciente($id, $nome, $cpf, $dataNasc, $dataInicio, $telCel, $telRes, $telCom, $erro){
    $dataNasc = self::converterData($dataNasc);
    $dataInicio = self::converterData($dataInicio);
    require_once("../model/Database.php");
    $DB = Database::conectar();
    $sql = "update tbPaciente set nome = :nome, CPF = :cpf, dataNasc = :dataNasc, inicioTrat = :dataInicio, telCelular = :telCel, telResidencial = :telResidencial, telComercial = :telComercial  where id= :id;";
    $consulta = $DB->prepare($sql);
    $consulta->bindParam(':id', $id, PDO::PARAM_STR);
    $consulta->bindParam(':nome', $nome, PDO::PARAM_STR);
    $consulta->bindParam(':cpf', $cpf, PDO::PARAM_STR);
    $consulta->bindParam(':dataNasc', $dataNasc, PDO::PARAM_STR);
    $consulta->bindParam(':dataInicio', $dataInicio, PDO::PARAM_STR);
    $consulta->bindParam(':telCel', $telCel, PDO::PARAM_STR);
    $consulta->bindParam(':telResidencial', $telRes, PDO::PARAM_STR);
    $consulta->bindParam(':telComercial', $telCom, PDO::PARAM_STR);
    try{
      $consulta->execute();
      if($consulta->rowCount() == 1){
        $erro = "<h3 style=\"color:red;\">*Alterações salvas*</h3>";
        self::visualizarPaciente($id, $erro);
      }
    }catch(PDOException $e){
      echo ($e->getMessage());
      return false;
    }
  }




}

?>
