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
    $sql = "insert into tbContas (id, descricao, data, valor, dataefetiva, baixa, tipo) values (NULL, :descricao, :data, :valor, :dataefetiva, :baixa, :tipo)";
    $consulta = $DB->prepare($sql);
    $consulta->bindParam(':descricao', $this->desc, PDO::PARAM_STR);
    $consulta->bindParam(':data', $this->dataCriacao, PDO::PARAM_STR);
    $consulta->bindParam(':valor', $this->valor, PDO::PARAM_STR);
    $consulta->bindParam(':dataefetiva', $this->dataPagamento, PDO::PARAM_STR);
    $consulta->bindParam(':baixa', $this->pago, PDO::PARAM_STR);
    $consulta->bindParam(':tipo', $this->tipo, PDO::PARAM_STR);
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
    $sql = "select * from tbContas order by dataefetiva asc;";
    $consulta = $DB->prepare($sql);
    try{
      $consulta->execute();
      //echo $consulta->rowCount();
      if($consulta->rowCount() >0){
        $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach($linha as $row){
          $date = self::reverteData($row['dataefetiva']);
          if($row['baixa'] == 1){
            $cor = "bgcolor=\"#D14545\"";
          }else{
            $cor = "";
          }
          if($row['tipo'] == 1){
            $tipo = "A pagar";
          }else{
            $tipo = "A receber";
          }
          if($row['baixa'] == 1){
            $baixa = "Pago";
          }else{
            $baixa = "Não";
          }
          echo "
          <form action=\"../view/visualizarConta.php\" method=\"post\">
            <tr>
                <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                <td ".$cor.">".$date."</td>
                <td ".$cor.">".$tipo."</td>
                <td ".$cor.">".$baixa."</td>
                <td><button type=\"submit\" name=\"visualizar\" class=\"btn btn-primary \"> Visualizar </button></td>
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
        //echo "data e desc";
        $descricao = "%".$desc."%";
        if(!empty($data)){
          $datac = self::converterData($data);
        }
        $sql = "select * from tbContas where descricao like :descricao and dataefetiva >= :data and baixa = :filtro order by dataefetiva asc;";
        $consulta = $DB->prepare($sql);
        $consulta->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $consulta->bindParam(':data', $datac, PDO::PARAM_STR);
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
                $cor = "bgcolor=\"#D14545\"";
              }else{
                $cor = "";
              }
              if($row['tipo'] == 1){
                $tipo = "A pagar";
              }else{
                $tipo = "A receber";
              }
              if($row['baixa'] == 1){
                $baixa = "Pago";
              }else{
                $baixa = "Não";
              }
              echo "
              <form action=\"../controller/conta.php\" method=\"post\">
                <tr>
                    <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                    <td ".$cor.">".$date."</td>
                    <td ".$cor.">".$tipo."</td>
                    <td ".$cor.">".$baixa."</td>
                    <td><button type=\"submit\" name=\"visualizar\" class=\"btn btn-primary \"> Visualizar </button></td>
                </tr>
              </form>
              ";
            }
          }
        }catch(PDOException $e){
          echo ($e->getMessage());
          return false;
        }
      }else if((empty($desc)) && (!empty($data))){
        if(!empty($data)){
          $datac = self::converterData($data);
        }
        $sql = "select * from tbContas where dataefetiva>=:data and baixa=:filtro order by dataefetiva asc;";
        $consulta = $DB->prepare($sql);
        $consulta->bindParam(':data', $datac, PDO::PARAM_STR);
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
                $cor = "bgcolor=\"#D14545\"";
              }else{
                $cor = "";
              }
              if($row['tipo'] == 1){
                $tipo = "A pagar";
              }else{
                $tipo = "A receber";
              }
              if($row['baixa'] == 1){
                $baixa = "Pago";
              }else{
                $baixa = "Não";
              }
              echo "
              <form action=\"../controller/conta.php\" method=\"post\">
                <tr>
                    <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                    <td ".$cor.">".$date."</td>
                    <td ".$cor.">".$tipo."</td>
                    <td ".$cor.">".$baixa."</td>
                    <td><button type=\"submit\" name=\"visualizar\" class=\"btn btn-primary \"> Visualizar </button></td>
                </tr>
              </form>
              ";
            }
          }
        }catch(PDOException $e){
          echo ($e->getMessage());
          return false;
        }
      }else if((empty($data)) && (!empty($desc))){
        $descricao = "%".$desc."%";
        $sql = "select * from tbContas where descricao like :descricao and baixa = :filtro order by dataefetiva asc;";
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
                $cor = "bgcolor=\"#D14545\"";
              }else{
                $cor = "";
              }
              if($row['tipo'] == 1){
                $tipo = "A pagar";
              }else{
                $tipo = "A receber";
              }
              if($row['baixa'] == 1){
                $baixa = "Pago";
              }else{
                $baixa = "Não";
              }
              echo "
              <form action=\"../controller/conta.php\" method=\"post\">
                <tr>
                    <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                    <td ".$cor.">".$date."</td>
                    <td ".$cor.">".$tipo."</td>
                    <td ".$cor.">".$baixa."</td>
                    <td><button type=\"submit\" name=\"visualizar\" class=\"btn btn-primary \"> Visualizar </button></td>
                </tr>
              </form>
              ";
            }
          }
        }catch(PDOException $e){
          echo ($e->getMessage());
          return false;
        }
      }else{
        $sql = "select * from tbContas where baixa = :filtro order by dataefetiva asc;";
        $consulta = $DB->prepare($sql);
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
                $cor = "bgcolor=\"#D14545\"";
              }else{
                $cor = "";
              }
              if($row['tipo'] == 1){
                $tipo = "A pagar";
              }else{
                $tipo = "A receber";
              }
              if($row['baixa'] == 1){
                $baixa = "Pago";
              }else{
                $baixa = "Não";
              }
              echo "
              <form action=\"../controller/conta.php\" method=\"post\">
                <tr>
                    <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                    <td ".$cor.">".$date."</td>
                    <td ".$cor.">".$tipo."</td>
                    <td ".$cor.">".$baixa."</td>
                    <td><button type=\"submit\" name=\"visualizar\" class=\"btn btn-primary \"> Visualizar </button></td>
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
    }else if($filtro == "npago"){
      if((!empty($desc)) && (!empty($data))){
        //echo "data e desc";
        $descricao = "%".$desc."%";
        if(!empty($data)){
          $datac = self::converterData($data);
        }
        $sql = "select * from tbContas where descricao like :descricao and dataefetiva >= :data and  baixa = :filtro order by dataefetiva asc;";
        $consulta = $DB->prepare($sql);
        $consulta->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $consulta->bindParam(':data', $datac, PDO::PARAM_STR);
        $filt = 0;
        $consulta->bindParam(':filtro', $filt, PDO::PARAM_STR);
        try{
          $consulta->execute();
          //echo $consulta->rowCount();
          if($consulta->rowCount() > 0){
            $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
            foreach($linha as $row){
              $date = self::reverteData($row['dataefetiva']);
              if($row['baixa'] == 1){
                $cor = "bgcolor=\"#D14545\"";
              }else{
                $cor = "";
              }
              if($row['tipo'] == 1){
                $tipo = "A pagar";
              }else{
                $tipo = "A receber";
              }
              if($row['baixa'] == 1){
                $baixa = "Pago";
              }else{
                $baixa = "Não";
              }
              echo "
              <form action=\"../controller/conta.php\" method=\"post\">
                <tr>
                    <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                    <td ".$cor.">".$date."</td>
                    <td ".$cor.">".$tipo."</td>
                    <td ".$cor.">".$baixa."</td>
                    <td><button type=\"submit\" name=\"visualizar\" class=\"btn btn-primary \"> Visualizar </button></td>
                </tr>
              </form>
              ";
            }
          }
        }catch(PDOException $e){
          echo ($e->getMessage());
          return false;
        }
      }else if((empty($desc)) && (!empty($data))){
        if(!empty($data)){
          $datac = self::converterData($data);
        }
        $sql = "select * from tbContas where dataefetiva>=:data and baixa=:filtro order by dataefetiva asc;";
        $consulta = $DB->prepare($sql);
        $consulta->bindParam(':data', $datac, PDO::PARAM_STR);
        $filt = 0;
        $consulta->bindParam(':filtro', $filt, PDO::PARAM_STR);
        try{
          $consulta->execute();
          //echo $consulta->rowCount();
          if($consulta->rowCount() > 0){
            $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
            foreach($linha as $row){
              $date = self::reverteData($row['dataefetiva']);
              if($row['baixa'] == 1){
                $cor = "bgcolor=\"#D14545\"";
              }else{
                $cor = "";
              }
              if($row['tipo'] == 1){
                $tipo = "A pagar";
              }else{
                $tipo = "A receber";
              }
              if($row['baixa'] == 1){
                $baixa = "Pago";
              }else{
                $baixa = "Não";
              }
              echo "
              <form action=\"../controller/conta.php\" method=\"post\">
                <tr>
                    <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                    <td ".$cor.">".$date."</td>
                    <td ".$cor.">".$tipo."</td>
                    <td ".$cor.">".$baixa."</td>
                    <td><button type=\"submit\" name=\"visualizar\" class=\"btn btn-primary \"> Visualizar </button></td>
                </tr>
              </form>
              ";
            }
          }
        }catch(PDOException $e){
          echo ($e->getMessage());
          return false;
        }
      }else if((empty($data)) && (!empty($desc))){
        $descricao = "%".$desc."%";
        $sql = "select * from tbContas where descricao like :descricao and baixa = :filtro order by dataefetiva asc;";
        $consulta = $DB->prepare($sql);
        $consulta->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $filt = 0;
        $consulta->bindParam(':filtro', $filt, PDO::PARAM_STR);
        try{
          $consulta->execute();
          //echo $consulta->rowCount();
          if($consulta->rowCount() > 0){
            $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
            foreach($linha as $row){
              $date = self::reverteData($row['dataefetiva']);
              if($row['baixa'] == 1){
                $cor = "bgcolor=\"#D14545\"";
              }else{
                $cor = "";
              }
              if($row['tipo'] == 1){
                $tipo = "A pagar";
              }else{
                $tipo = "A receber";
              }
              if($row['baixa'] == 1){
                $baixa = "Pago";
              }else{
                $baixa = "Não";
              }
              echo "
              <form action=\"../controller/conta.php\" method=\"post\">
                <tr>
                    <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                    <td ".$cor.">".$date."</td>
                    <td ".$cor.">".$tipo."</td>
                    <td ".$cor.">".$baixa."</td>
                    <td><button type=\"submit\" name=\"visualizar\" class=\"btn btn-primary \"> Visualizar </button></td>
                </tr>
              </form>
              ";
            }
          }
        }catch(PDOException $e){
          echo ($e->getMessage());
          return false;
        }
      }else{
        $sql = "select * from tbContas where baixa = :filtro order by dataefetiva asc;";
        $consulta = $DB->prepare($sql);
        $filt = 0;
        $consulta->bindParam(':filtro', $filt, PDO::PARAM_STR);
        try{
          $consulta->execute();
          //echo $consulta->rowCount();
          if($consulta->rowCount() > 0){
            $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
            foreach($linha as $row){
              $date = self::reverteData($row['dataefetiva']);
              if($row['baixa'] == 1){
                $cor = "bgcolor=\"#D14545\"";
              }else{
                $cor = "";
              }
              if($row['tipo'] == 1){
                $tipo = "A pagar";
              }else{
                $tipo = "A receber";
              }
              if($row['baixa'] == 1){
                $baixa = "Pago";
              }else{
                $baixa = "Não";
              }
              echo "
              <form action=\"../controller/conta.php\" method=\"post\">
                <tr>
                    <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                    <td ".$cor.">".$date."</td>
                    <td ".$cor.">".$tipo."</td>
                    <td ".$cor.">".$baixa."</td>
                    <td><button type=\"submit\" name=\"visualizar\" class=\"btn btn-primary \"> Visualizar </button></td>
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
    }else if($filtro =="tipoPagar"){
      if((!empty($desc)) && (!empty($data))){
        //echo "data e desc";
        $descricao = "%".$desc."%";
        if(!empty($data)){
          $datac = self::converterData($data);
        }
        $sql = "select * from tbContas where descricao like :descricao and dataefetiva >= :data and tipo = 1 order by dataefetiva asc;";
        $consulta = $DB->prepare($sql);
        $consulta->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $consulta->bindParam(':data', $datac, PDO::PARAM_STR);
        try{
          $consulta->execute();
          //echo $consulta->rowCount();
          if($consulta->rowCount() > 0){
            $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
            foreach($linha as $row){
              $date = self::reverteData($row['dataefetiva']);
              if($row['baixa'] == 1){
                $cor = "bgcolor=\"#D14545\"";
              }else{
                $cor = "";
              }
              if($row['tipo'] == 1){
                $tipo = "A pagar";
              }else{
                $tipo = "A receber";
              }
              if($row['baixa'] == 1){
                $baixa = "Pago";
              }else{
                $baixa = "Não";
              }
              echo "
              <form action=\"../controller/conta.php\" method=\"post\">
                <tr>
                    <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                    <td ".$cor.">".$date."</td>
                    <td ".$cor.">".$tipo."</td>
                    <td ".$cor.">".$baixa."</td>
                    <td><button type=\"submit\" name=\"visualizar\" class=\"btn btn-primary \"> Visualizar </button></td>
                </tr>
              </form>
              ";
            }
          }
        }catch(PDOException $e){
          echo ($e->getMessage());
          return false;
        }
      }else if((empty($desc)) && (!empty($data))){
        if(!empty($data)){
          $datac = self::converterData($data);
        }
        $sql = "select * from tbContas where dataefetiva>=:data and tipo = 1 order by dataefetiva asc;";
        $consulta = $DB->prepare($sql);
        $consulta->bindParam(':data', $datac, PDO::PARAM_STR);
        $filt = 0;
        $consulta->bindParam(':filtro', $filt, PDO::PARAM_STR);
        try{
          $consulta->execute();
          //echo $consulta->rowCount();
          if($consulta->rowCount() > 0){
            $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
            foreach($linha as $row){
              $date = self::reverteData($row['dataefetiva']);
              if($row['baixa'] == 1){
                $cor = "bgcolor=\"#D14545\"";
              }else{
                $cor = "";
              }
              if($row['tipo'] == 1){
                $tipo = "A pagar";
              }else{
                $tipo = "A receber";
              }
              if($row['baixa'] == 1){
                $baixa = "Pago";
              }else{
                $baixa = "Não";
              }
              echo "
              <form action=\"../controller/conta.php\" method=\"post\">
                <tr>
                    <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                    <td ".$cor.">".$date."</td>
                    <td ".$cor.">".$tipo."</td>
                    <td ".$cor.">".$baixa."</td>
                    <td><button type=\"submit\" name=\"visualizar\" class=\"btn btn-primary \"> Visualizar </button></td>
                </tr>
              </form>
              ";
            }
          }
        }catch(PDOException $e){
          echo ($e->getMessage());
          return false;
        }
      }else if((empty($data)) && (!empty($desc))){
        $descricao = "%".$desc."%";
        $sql = "select * from tbContas where descricao like :descricao and tipo = 1  order by dataefetiva asc;";
        $consulta = $DB->prepare($sql);
        $consulta->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $filt = 0;
        $consulta->bindParam(':filtro', $filt, PDO::PARAM_STR);
        try{
          $consulta->execute();
          //echo $consulta->rowCount();
          if($consulta->rowCount() > 0){
            $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
            foreach($linha as $row){
              $date = self::reverteData($row['dataefetiva']);
              if($row['baixa'] == 1){
                $cor = "bgcolor=\"#D14545\"";
              }else{
                $cor = "";
              }
              if($row['tipo'] == 1){
                $tipo = "A pagar";
              }else{
                $tipo = "A receber";
              }
              if($row['baixa'] == 1){
                $baixa = "Pago";
              }else{
                $baixa = "Não";
              }
              echo "
              <form action=\"../controller/conta.php\" method=\"post\">
                <tr>
                    <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                    <td ".$cor.">".$date."</td>
                    <td ".$cor.">".$tipo."</td>
                    <td ".$cor.">".$baixa."</td>
                    <td><button type=\"submit\" name=\"visualizar\" class=\"btn btn-primary \"> Visualizar </button></td>
                </tr>
              </form>
              ";
            }
          }
        }catch(PDOException $e){
          echo ($e->getMessage());
          return false;
        }
      }else{
        $sql = "select * from tbContas where tipo = 1 order by dataefetiva asc;";
        $consulta = $DB->prepare($sql);
        $filt = 0;
        $consulta->bindParam(':filtro', $filt, PDO::PARAM_STR);
        try{
          $consulta->execute();
          //echo $consulta->rowCount();
          if($consulta->rowCount() > 0){
            $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
            foreach($linha as $row){
              $date = self::reverteData($row['dataefetiva']);
              if($row['baixa'] == 1){
                $cor = "bgcolor=\"#D14545\"";
              }else{
                $cor = "";
              }
              if($row['tipo'] == 1){
                $tipo = "A pagar";
              }else{
                $tipo = "A receber";
              }
              if($row['baixa'] == 1){
                $baixa = "Pago";
              }else{
                $baixa = "Não";
              }
              echo "
              <form action=\"../controller/conta.php\" method=\"post\">
                <tr>
                    <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                    <td ".$cor.">".$date."</td>
                    <td ".$cor.">".$tipo."</td>
                    <td ".$cor.">".$baixa."</td>
                    <td><button type=\"submit\" name=\"visualizar\" class=\"btn btn-primary \"> Visualizar </button></td>
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
      if((!empty($desc)) && (!empty($data))){
        //echo "data e desc";
        $descricao = "%".$desc."%";
        if(!empty($data)){
          $datac = self::converterData($data);
        }
        $sql = "select * from tbContas where descricao like :descricao and dataefetiva >= :data and tipo = 0 order by dataefetiva asc;";
        $consulta = $DB->prepare($sql);
        $consulta->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $consulta->bindParam(':data', $datac, PDO::PARAM_STR);
        try{
          $consulta->execute();
          //echo $consulta->rowCount();
          if($consulta->rowCount() > 0){
            $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
            foreach($linha as $row){
              $date = self::reverteData($row['dataefetiva']);
              if($row['baixa'] == 1){
                $cor = "bgcolor=\"#D14545\"";
              }else{
                $cor = "";
              }
              if($row['tipo'] == 1){
                $tipo = "A pagar";
              }else{
                $tipo = "A receber";
              }
              if($row['baixa'] == 1){
                $baixa = "Pago";
              }else{
                $baixa = "Não";
              }
              echo "
              <form action=\"../controller/conta.php\" method=\"post\">
                <tr>
                    <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                    <td ".$cor.">".$date."</td>
                    <td ".$cor.">".$tipo."</td>
                    <td ".$cor.">".$baixa."</td>
                    <td><button type=\"submit\" name=\"visualizar\" class=\"btn btn-primary \"> Visualizar </button></td>
                </tr>
              </form>
              ";
            }
          }
        }catch(PDOException $e){
          echo ($e->getMessage());
          return false;
        }
      }else if((empty($desc)) && (!empty($data))){
        if(!empty($data)){
          $datac = self::converterData($data);
        }
        $sql = "select * from tbContas where dataefetiva>=:data and tipo = 0 order by dataefetiva asc;";
        $consulta = $DB->prepare($sql);
        $consulta->bindParam(':data', $datac, PDO::PARAM_STR);
        $filt = 0;
        $consulta->bindParam(':filtro', $filt, PDO::PARAM_STR);
        try{
          $consulta->execute();
          //echo $consulta->rowCount();
          if($consulta->rowCount() > 0){
            $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
            foreach($linha as $row){
              $date = self::reverteData($row['dataefetiva']);
              if($row['baixa'] == 1){
                $cor = "bgcolor=\"#D14545\"";
              }else{
                $cor = "";
              }
              if($row['tipo'] == 1){
                $tipo = "A pagar";
              }else{
                $tipo = "A receber";
              }
              if($row['baixa'] == 1){
                $baixa = "Pago";
              }else{
                $baixa = "Não";
              }
              echo "
              <form action=\"../controller/conta.php\" method=\"post\">
                <tr>
                    <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                    <td ".$cor.">".$date."</td>
                    <td ".$cor.">".$tipo."</td>
                    <td ".$cor.">".$baixa."</td>
                    <td><button type=\"submit\" name=\"visualizar\" class=\"btn btn-primary \"> Visualizar </button></td>
                </tr>
              </form>
              ";
            }
          }
        }catch(PDOException $e){
          echo ($e->getMessage());
          return false;
        }
      }else if((empty($data)) && (!empty($desc))){
        $descricao = "%".$desc."%";
        $sql = "select * from tbContas where descricao like :descricao and tipo = 0  order by dataefetiva asc;";
        $consulta = $DB->prepare($sql);
        $consulta->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $filt = 0;
        $consulta->bindParam(':filtro', $filt, PDO::PARAM_STR);
        try{
          $consulta->execute();
          //echo $consulta->rowCount();
          if($consulta->rowCount() > 0){
            $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
            foreach($linha as $row){
              $date = self::reverteData($row['dataefetiva']);
              if($row['baixa'] == 1){
                $cor = "bgcolor=\"#D14545\"";
              }else{
                $cor = "";
              }
              if($row['tipo'] == 1){
                $tipo = "A pagar";
              }else{
                $tipo = "A receber";
              }
              if($row['baixa'] == 1){
                $baixa = "Pago";
              }else{
                $baixa = "Não";
              }
              echo "
              <form action=\"../controller/conta.php\" method=\"post\">
                <tr>
                    <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                    <td ".$cor.">".$date."</td>
                    <td ".$cor.">".$tipo."</td>
                    <td ".$cor.">".$baixa."</td>
                    <td><button type=\"submit\" name=\"visualizar\" class=\"btn btn-primary \"> Visualizar </button></td>
                </tr>
              </form>
              ";
            }
          }
        }catch(PDOException $e){
          echo ($e->getMessage());
          return false;
        }
      }else{
        $sql = "select * from tbContas where tipo = 0 order by dataefetiva asc;";
        $consulta = $DB->prepare($sql);
        $filt = 0;
        $consulta->bindParam(':filtro', $filt, PDO::PARAM_STR);
        try{
          $consulta->execute();
          //echo $consulta->rowCount();
          if($consulta->rowCount() > 0){
            $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
            foreach($linha as $row){
              $date = self::reverteData($row['dataefetiva']);
              if($row['baixa'] == 1){
                $cor = "bgcolor=\"#D14545\"";
              }else{
                $cor = "";
              }
              if($row['tipo'] == 1){
                $tipo = "A pagar";
              }else{
                $tipo = "A receber";
              }
              if($row['baixa'] == 1){
                $baixa = "Pago";
              }else{
                $baixa = "Não";
              }
              echo "
              <form action=\"../controller/conta.php\" method=\"post\">
                <tr>
                    <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                    <td ".$cor.">".$date."</td>
                    <td ".$cor.">".$tipo."</td>
                    <td ".$cor.">".$baixa."</td>
                    <td><button type=\"submit\" name=\"visualizar\" class=\"btn btn-primary \"> Visualizar </button></td>
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
  }

  public function visualizarConta($id, $erro){
    require_once("../model/Database.php");
    $DB = Database::conectar();
    $sql = "select * from tbContas where id= :id;";
    $consulta = $DB->prepare($sql);
    $consulta->bindParam(':id', $id, PDO::PARAM_STR);

    try{
      $consulta->execute();
      //echo $consulta->rowCount();
      if($consulta->rowCount() == 1){
        $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach($linha as $row){
          echo "
          <form action=\"../view/visualizarConta.php\" method=\"post\">
                  ".$erro."
                  <div class=\"form-group\">
                          <input type=\"hidden\" name=\"id\" value=\"".$row['id']."\" />
                          <label>Descricao</label>
                          <input class=\"form-control\" type=\"text\" name=\"descricao\" maxlength=\"50\" required value=\"".$row['descricao']."\" >
                          <label>Data de criação (DD/MM/AAAA)</label>
                          <input onkeypress=\"mascara(this, mdata);\" class=\"form-control\" type=\"datetime\" name=\"data\" maxlength=\"10\" value=\"".self::reverteData($row['data'])."\"  >
                          <label>Data efetiva (DD/MM/AAAA)</label>
                          <input onkeypress=\"mascara(this, mdata);\" class=\"form-control\" type=\"text\" name=\"dataefetiva\" maxlength=\"10\" value=\"".self::reverteData($row['dataefetiva'])."\">
                          <label>Valor (R$)</label>
                          <input onkeypress=\"moeda(this);\" class=\"form-control\" type=\"text\" name=\"valor\" maxlength=\"50\" value=\"".$row['valor']."\">
              <button type=\"submit\" name=\"salvar\" class=\"btn btn-primary\"> Salvar alterações </button>
              <button type=\"submit\" name=\"excluir\" class=\"btn btn-danger\"> Excluir </button>
          </form>
          ";



        }
      }
    }catch(PDOException $e){
      echo ($e->getMessage());
      return false;
    }
  }

  public function excluirConta($id, $erro){
    require_once("../model/Database.php");
    $DB = Database::conectar();
    $sql = "delete from tbContas where id= :id;";
    $consulta = $DB->prepare($sql);
    $consulta->bindParam(':id', $id, PDO::PARAM_STR);

    try{
      $consulta->execute();
      echo "<h3 style=\"color:red;\">*Conta excluído*</h3>";
    }catch(PDOException $e){
      echo ($e->getMessage());
      return false;
    }
  }

  public function editarConta($id, $descricao, $data, $dataefetiva, $valor, $erro){
    $data = self::converterData($data);
    $dataefetiva = self::converterData($dataefetiva);
    require_once("../model/Database.php");
    $DB = Database::conectar();
    $sql = "update tbContas set descricao = :descricao, valor = :valor, data = :data, dataefetiva = :dataefetiva where id = :id;";
    $consulta = $DB->prepare($sql);
    $consulta->bindParam(':id', $id, PDO::PARAM_STR);
    $consulta->bindParam(':descricao', $descricao, PDO::PARAM_STR);
    $consulta->bindParam(':valor', $valor, PDO::PARAM_STR);
    $consulta->bindParam(':data', $data, PDO::PARAM_STR);
    $consulta->bindParam(':dataefetiva', $dataefetiva, PDO::PARAM_STR);

    try{
      $consulta->execute();
      if($consulta->rowCount() == 1){
        $erro = "<h3 style=\"color:red;\">*Alterações salvas*</h3>";
        self::visualizarConta($id, $erro);
      }else if($consulta->rowCount() == 0){
        $erro = "<h3 style=\"color:red;\">*Nada feito*</h3>";
        self::visualizarConta($id, $erro);
      }
    }catch(PDOException $e){
      echo ($e->getMessage());
      return false;
    }
  }

  public function filtrar($datainicio, $datafim, $erro){
    $datainicio = self::converterData($datainicio);
    $datafim = self::converterData($datafim);
    require_once("../model/Database.php");
    $DB = Database::conectar();
    $sql = "select SUM(valor) as valor from tbContas where dataefetiva BETWEEN :datainicio and :datafim;";
    $consulta = $DB->prepare($sql);
    $consulta->bindParam(':datainicio', $datainicio, PDO::PARAM_STR);
    $consulta->bindParam(':datafim', $datafim, PDO::PARAM_STR);

    try{
      $consulta->execute();
      if($consulta->rowCount() == 1){
        $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
          foreach($linha as $row){

            echo  "<h3 style=\"color:red;\">*Fluxo = ".$row["valor"]."*</h3>";
            //require_once("../view/mostrarFluxo.php");
          }

      }else if($consulta->rowCount() == 0){
        $erro = "<h3 style=\"color:red;\">*Nada feito*</h3>";
      }
    }catch(PDOException $e){
      echo ($e->getMessage());
      return false;
    }
  }

}

?>
