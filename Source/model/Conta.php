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
      self::setDataCriacao(self::converterData(self::getDataCriacao()));
    }
    if(!empty(self::getDataPagamento())){
      self::setDataPagamento(self::converterData(self::getDataPagamento()));
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

}

?>
