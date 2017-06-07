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

	public function validaInsert($nome, $usuario, $senha, $cargo, $ativo){
		if((empty($nome)) && (empty($usuario)) && (empty($senha)) && (empty($cargo)) && (empty($ativo))){
			return false;
		}else {
			return true;
		}
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


	//método que imprime todos usuáReflectionClass
	public function listarUsuario(){
    require_once("../model/Database.php");
    $DB = Database::conectar();
    $sql = "select * from tbUsuario order by nome asc;";
    $consulta = $DB->prepare($sql);
    try{
      $consulta->execute();
      // $consulta->rowCount();
      if($consulta->rowCount() >0){
        $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach($linha as $row){
          if($row['ativo'] == 0){
            $cor = "bgcolor=\"red;\"";
          }else{
            $cor = "";
          }
          echo "
          <form action=\"../controller/conta.php\" method=\"post\">
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

	public function insereUsuario(){
    require_once("../model/Database.php");
    $DB = Database::conectar();
		$sql = "insert into tbUsuario (id, nome, cargo, usuario, senha, ativo) values (NULL, :nome, :cargo, :usuario, :senha, :ativo)";
    $consulta = $DB->prepare($sql);
		$ativ = "1";
    $consulta->bindParam(':nome', $this->nome, PDO::PARAM_STR);
    $consulta->bindParam(':cargo', $this->cargo, PDO::PARAM_STR);
    $consulta->bindParam(':usuario', $this->usuario, PDO::PARAM_STR);
    $consulta->bindParam(':senha', $this->senha, PDO::PARAM_STR);
		$consulta->bindParam(':ativo', $ativ, PDO::PARAM_STR);
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
