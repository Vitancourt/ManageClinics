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
    return $cpf;
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
    $dat = explode("-","$data"); # fatia a string $dat em pedados, usando - como referência
    $this->data = $dat[2].'/'.$dat[1].'/'.$dat[0];
  }

  public function inserePaciente(){
    require_once("../model/Database.php");
    $DB = Database::conectar();
    $sql = "insert into tbPaciente (id, nome, cpf, dataNasc, inicioTrat, telCelular, telResidencial, telComercial, ativo) values (NULL, :nome, :cpf, :dataNasc, :inicioTrat, :telCelular, :telResidencial, :telComercial, '1')";
    $consulta = $DB->prepare($sql);
    $consulta->bindParam(':nome', self::getNome(), PDO::PARAM_STR);
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
    $sql = "select * from tbpaciente order by nome asc";
    $consulta = $DB->prepare($sql);
    /*
    $consulta->bindParam(':nome', self::getNome(), PDO::PARAM_STR);
    $consulta->bindParam(':cpf', $this->cpf, PDO::PARAM_STR);
    $consulta->bindParam(':dataNasc', $this->dataNasc, PDO::PARAM_STR);
    $consulta->bindParam(':inicioTrat', $this->inicioTrat, PDO::PARAM_STR);
    $consulta->bindParam(':telCelular', $this->telCelular, PDO::PARAM_STR);
    $consulta->bindParam(':telResidencial', $this->telResidencial, PDO::PARAM_STR);
    $consulta->bindParam(':telComercial', $this->telComercial, PDO::PARAM_STR);
    */
    try{
      $consulta->execute();
      //echo $consulta->rowCount();
      if($consulta->rowCount() == 1){
        $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach($linha as $row){
          if($row['ativo'] == 0){
            $cor = "bgcolor=\"red\"";
          }else{
            $cor = "";
          }
          echo "
          <form action=\"paciente.php\" method=\"post\">
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
    $sql = "select * from tbpaciente where nome like :nome order by nome asc;";
    $consulta = $DB->prepare($sql);
    $consulta->bindParam(':nome', $nome, PDO::PARAM_STR);

    try{
      $consulta->execute();
      //echo $consulta->rowCount();
      if($consulta->rowCount() == 1){
        $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach($linha as $row){
          echo "
          <form action=\"paciente.php\" method=\"post\">
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


}

?>
