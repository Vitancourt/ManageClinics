<?php
class Usuario
{
	private $id;
	private $nome;
	private $usuario;
	private $senha;
	private $cargo;
	private $ativo;

	function __construct(){

	}

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setUsuario($usuario){
		$this->usuario = md5($usuario);
	}

	public function getUsuario(){
		return $this->usuario;
	}

	public function setSenha($senha){
		$this->senha = md5($senha);
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setCargo($cargo){
		$this->cargo = $cargo;
	}

	public function getCargo(){
		return $this->cargo;
	}

	public function setAtivo($ativo){
		$this->ativo = $ativo;
	}

	public function getAtivo(){
		return $this->ativo;
	}

	//Teste entrada, usuário e senha
	public function validaUsuarioSenha($u, $s){
		if(($u == NULL) || ($s == NULL)){
			return false;
		}else{
			return true;
		}
	}

	//Verifica usuário, senha e se o usuário é ativo no banco de dados, (usuário e senha md5 crypt);
	public function logar($usuario, $senha){
		if(($usuario != NULL) && ($senha != NULL)){
				require("../model/Database.php");
				$DB = Database::conectar();
				$sql = "select id, usuario, senha, ativo from tbUsuario where usuario = :usuario and senha = :senha and ativo = \"1\"";
				$consulta = $DB->prepare($sql);

				$consulta->bindParam(':usuario', $usuario, PDO::PARAM_STR);
				$consulta->bindParam(':senha', $senha, PDO::PARAM_STR);
				try{
					$consulta->execute();
					//echo $consulta->rowCount();
					if($consulta->rowCount() == 1){
						if(!session_id()){
							session_start();
						}
						foreach($consulta as $linha){
							$_SESSION['id'] = $linha['id'];
						}
						return true;
					}
				}catch(PDOException $e){
					echo ($e->getMessage());
					return false;
				}
		}
		return false;
	}

	//Seta sessão para o usuário
	public function iniciaSession($retornoLogar){
		if($retornoLogar){
			if (!session_id()){
      	session_start();
			}
        	$_SESSION['usuario'] = md5($this->usuario);
        	if(!cargo){
        		$_SESSION['cargo'] = md5("1");
        	}else{
        		$_SESSION['cargo'] = md5($this->cargo);
        	}
        	return true;
		}else{
			return false;
		}
	}

	//Valida sessão
	public function validaSession(){
		if(!session_id()){
			session_start();
		}
		if(empty($_SESSION['usuario']) || empty($_SESSION['id'])){
			return false;
		}else{
			return true;
		}
	}

	//Consulta o nome do usuario a partir do id da sessão
	public function buscaNomeUsuario($idUsuario){
		require("../model/Database.php");
		$DB = Database::conectar();
		$sql = "select nome from tbUsuario where id = :id and ativo = \"1\"";
		$consulta = $DB->prepare($sql);
		$consulta->bindParam(':id', $idUsuario, PDO::PARAM_STR);		
		try{
			$consulta->execute();
			//echo $consulta->rowCount();
			if($consulta->rowCount() == 1){
				if(!session_id()){
					session_start();
				}
				foreach($consulta as $linha){
					$_SESSION['nomeUsuario'] = $linha['nome'];
				}
				return true;
			}
		}catch(PDOException $e){
			echo ($e->getMessage());
			return false;
		}
	}

	public function verificaSessionNomeUsuario($idUsuario){
		if(!session_id()){
			session_start();
		}
		if(empty($_SESSION['nome'])){
			$this->buscaNomeUsuario($idUsuario);
		}
	}

}

?>
