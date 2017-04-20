<?php
if(isset($_POST['buttonlogar'])){
    $css = "../view/";
    require("../view/head.php");
    $index = "../view/";
    require("../view/menuoff.php");

    //verifica se o botão foi pressionado
    if(($_POST['usuario'] == NULL) || ($_POST['password'] == NULL)){
            $erro = "<h3>O campo usuário e senha são obrigatórios!</h3>";
            require("../view/formlogin.php");
    }   
}

/*else if($_POST['password'] == NULL){
	
}else{ //Se ambos campos não estão vazios, realiza interação com Usuario e Database.
    require("../model/Usuario.php");
    $usuario = $_POST['usuario'];
    $senha = $_POST['password'];
    $user = new Usuario();
    $user->setUsuario($usuario);
    $user->setSenha($senha);
    $login = $user->logar($user->getUsuario(), $user->getSenha());
    if($login){
        //Início de sessão com o nome de usuário
        session_start();
        $_SESSION['usuario'] = $user->getUsuario();
        echo $_SESSION['usuario'];
        //header("Location: ../view/homepage.php")
    }else{
    echo "
      <!-- LOGIN -->
        <div class=\"row\">
            <div class=\"col-md-6 col-md-offset-2\">
                <div class=\"login-panel panel panel-default\">
                    <div class=\"panel-heading\">
                        <h3 class=\"panel-title\">Por favor, insira seu usuário e senha:</h3>
                        <h3>*Combinação de valores incorretos!</h3>
                    </div>
                    <div class=\"panel-body\">
                        <form role=\"form\" action=\"logar.php\" method=\"post\">
                            <fieldset>
                                <div class=\"form-group\">
                                    <input class=\"form-control\" placeholder=\"Usuário\" name=\"usuario\" type=\"text\" autofocus>
                                </div>
                                <div class=\"form-group\">
                                    <input class=\"form-control\" placeholder=\"Senha\" name=\"password\" type=\"password\" value=\"\">
                                </div>
                                <div class=\"checkbox\">
                                    <label>
                                        <input name=\"remember\" type=\"checkbox\" value=\"Remember Me\">Lembrar - me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input name=\"buttonlogar\" type=\"submit\" value=\"Entrar\" class=\"btn btn-lg btn-success btn-block\">                                
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
    <!-- LOGIN -->
                

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src=\"../view/js/jquery.js\"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src=\"../view/js/bootstrap.min.js\"></script>

    <!-- Morris Charts JavaScript -->
    <script src=\"../view/js/plugins/morris/raphael.min.js\"></script>
    <script src=\"../view/js/plugins/morris/morris.min.js\"></script>
    <script src=\"../view/js/plugins/morris/morris-data.js\"></script>

    </body>

    </html>

    ";          
    }
}
*/


?>
