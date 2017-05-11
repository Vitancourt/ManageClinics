<?php
class Conta{
  private $desc;
  private $dataCriacao;
  private $dataPagamento;
  private $valor;
  private $tipo;
  private $pago;

  function setDesc($desc){
    $this->desc = $desc;
  }

  function getDesc(){
    return $this->desc;
  }

  function setDataCriacao($datacriacao){
    $this->dataCriacao  = $datacriacao;
  }

  function getDataCriacao(){
    return $this->dataCriacao;
  }

  function setDataPagamento($dataPagamento){
    $this->dataPagamento = $dataPagamento;
  }

  function getDataPagamento(){
    return $this->dataPagamento;
  }

  function setValor($valor){
    $this->valor = $valor;
  }

  function getValor(){
    return $this->valor;
  }

  function setTipo($tipo){
    $this->tipo = $tipo;
  }

  function getTipo(){
    return $this->tipo;
  }

  function setPago($pago){
    $this->pago = $pago;
  }

  function getPago(){
    return $this->pago;
  }

  function validaCampos($desc, $tipo, $pago){
    if(empty($desc) || (empty($tipo) || empty($pago))){
      return false;
    }else{
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
    $data = $dat[2].'-'.$dat[1].'-'.$dat[0];
    return $data;
  }

  public function reverteData($data){
    $dat = explode("-","$data"); # fatia a string $dat em pedados, usando - como referência
    $data = $dat[2].'/'.$dat[1].'/'.$dat[0];
    return $data;
  }

  public function insereConta(){
    if(!empty(self::getDataCriacao())){
      $test = self::verificaData(self::getDataCriacao());
      if(!$test){
        return false;
      }
      self::setDataCriacao(self::converterData(self::getDataCriacao()));
    }
    if(!empty(self::getDataPagamento())){
      $test = self::verificaData(self::getDataPagamento());
      if(!$test){
        return false;
      }
      self::setDataPagamento(self::converterData(self::getDataPagamento()));
    }else{
      return false;
    }
    require_once("../model/Database.php");
    $DB = Database::conectar();
    $sql = "insert into tbcontas (id, descricao, data, valor, dataefetiva, baixa, tipo) values (NULL, :descricao, :data, :valor, :dataefetiva, :baixa, :tipo)";
    $consulta = $DB->prepare($sql);
    $consulta->bindParam(':descricao', self::getDesc(), PDO::PARAM_STR);
    $consulta->bindParam(':data', self::getDataCriacao(), PDO::PARAM_STR);
    $consulta->bindParam(':valor', self::getValor(), PDO::PARAM_STR);
    $consulta->bindParam(':dataefetiva', self::getDataPagamento(), PDO::PARAM_STR);
    $consulta->bindParam(':baixa', self::getPago(), PDO::PARAM_STR);
    $consulta->bindParam(':tipo', self::getTipo(), PDO::PARAM_STR);
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

  public function listarConta(){
    require_once("../model/Database.php");
    $DB = Database::conectar();
    $sql = "select * from tbcontas order by dataefetiva asc;";
    $consulta = $DB->prepare($sql);
    try{
      $consulta->execute();
      //echo $consulta->rowCount();
      if($consulta->rowCount() >0){
        $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach($linha as $row){
          $date = self::reverteData($row['dataefetiva']);
          if($row['baixa'] == 1){
            $cor = "bgcolor=\"red\"";
          }else{
            $cor = "";
          }
          echo "
          <form action=\"../controller/conta.php\" method=\"post\">
            <tr>
                <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                <td ".$cor.">".$date."</td>
                <td ".$cor.">".$row['tipo']."</td>
                <td ".$cor.">".$row['baixa']."</td>
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

  public function buscarConta($desc, $data, $filtro){
    require_once("../model/Database.php");
    $DB = Database::conectar();
    if(($filtro == "pago")){
      if((!empty($desc)) && (!empty($data))){
        $descricao = "%".$desc."%";
        $datac = self::converterData($data);
        $sql = "select * from tbcontas where descricao like :descricao and dataefetiva >= :data and baixa = :filtro order by dataefetiva asc;";
        $consulta = $DB->prepare($sql);
        $consulta->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $consulta->bindParam(':data', $data, PDO::PARAM_STR);
        $filt = 1;
        $consulta->bindParam(':filtro', $filt, PDO::PARAM_STR);
        try{
          $consulta->execute();
          //echo $consulta->rowCount();
          if($consulta->rowCount() > 0){
            $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
            foreach($linha as $row){
              $date = self::reverteData($row['dataefetiva']);
              if($row['baixa'] == 1){
                $cor = "bgcolor=\"red\"";
              }else{
                $cor = "";
              }
              echo "
              <form action=\"../controller/conta.php\" method=\"post\">
                <tr>
                    <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                    <td ".$cor.">".$date."</td>
                    <td ".$cor.">".$row['tipo']."</td>
                    <td ".$cor.">".$row['baixa']."</td>
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
      }else if(empty($desc)){
        $datac = self::converterData($data);
        $sql = "select * from tbcontas where dataefetiva >= :data and baixa = :filtro order by dataefetiva asc;";
        $consulta = $DB->prepare($sql);
        $consulta->bindParam(':data', $data, PDO::PARAM_STR);
        $filt = 1;
        $consulta->bindParam(':filtro', $filt, PDO::PARAM_STR);
        try{
          $consulta->execute();
          //echo $consulta->rowCount();
          if($consulta->rowCount() > 0){
            $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
            foreach($linha as $row){
              $date = self::reverteData($row['dataefetiva']);
              if($row['baixa'] == 1){
                $cor = "bgcolor=\"red\"";
              }else{
                $cor = "";
              }
              echo "
              <form action=\"../controller/conta.php\" method=\"post\">
                <tr>
                    <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                    <td ".$cor.">".$date."</td>
                    <td ".$cor.">".$row['tipo']."</td>
                    <td ".$cor.">".$row['baixa']."</td>
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
      }else if(empty($data)){
        $descricao = "%".$desc."%";
        $sql = "select * from tbcontas where descricao like :descricao and baixa = :filtro order by dataefetiva asc;";
        $consulta = $DB->prepare($sql);
        $consulta->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $filt = 1;
        $consulta->bindParam(':filtro', $filt, PDO::PARAM_STR);
        try{
          $consulta->execute();
          //echo $consulta->rowCount();
          if($consulta->rowCount() > 0){
            $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
            foreach($linha as $row){
              $date = self::reverteData($row['dataefetiva']);
              if($row['baixa'] == 1){
                $cor = "bgcolor=\"red\"";
              }else{
                $cor = "";
              }
              echo "
              <form action=\"../controller/conta.php\" method=\"post\">
                <tr>
                    <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                    <td ".$cor.">".$date."</td>
                    <td ".$cor.">".$row['tipo']."</td>
                    <td ".$cor.">".$row['baixa']."</td>
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
    }else{

    }

  }

}

?>
