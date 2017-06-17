<?php
/**
 * Classe de conexão ao banco de dados usando PDO no padrão Singleton.
 * Modo de Usar:
 * require_once './Database.class.php';
 * $db = Database::conexao();
 * E agora use as funções do PDO (prepare, query, exec) em cima da variável $db.
 */
class Database
{
    # Variável que guarda a conexão PDO.
    protected static $db;
    # Private construct - garante que a classe só possa ser instanciada internamente.
    private function __construct()
    {
        # Informações sobre o banco de dados:
        $db_host = "localhost";
        $db_nome = "manageclinic";
        //$db_usuario = "manageclinics";
        //$db_senha = "manageclinics";
        $db_usuario = "root";
        $db_senha= "";
        $db_driver = "mysql";
        # Informações sobre o sistema:
        $sistema_titulo = "Manage Clinic";
        $sistema_email = "";
        try
        {
            # Atribui o objeto PDO à variável $db.
            self::$db = new PDO("$db_driver:host=$db_host; dbname=$db_nome", $db_usuario, $db_senha);
            # Garante que o PDO lance exceções durante erros.
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            # Garante que os dados sejam armazenados com codificação UFT-8.
            self::$db->exec('SET NAMES utf8');
        }
        catch (PDOException $e)
        {
            # Envia um e-mail para o e-mail oficial do sistema, em caso de erro de conexão.
            //mail($sistema_email, "PDOException em $sistema_titulo", $e->getMessage());
            # Então não carrega nada mais da página.
            echo ($e->getMessage());
            die("Connection Error: " . $e->getMessage());

        }
    }
    # Método estático - acessível sem instanciação.
    public static function conectar()
    {
        # Garante uma única instância. Se não existe uma conexão, criamos uma nova.
        if (!self::$db)
        {
            //echo"conectado";
            new Database();

        }
        # Retorna a conexão.
        return self::$db;
    }
}

  //Database::conectar();
?>
