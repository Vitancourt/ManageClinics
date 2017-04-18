
<?php
$css = "../view/";
require("../view/head.php");
$index = "../view/";
require("../view/menus.php");
//verifica se o botão foi pressionado
if($_POST['usuario'] == NULL){
	echo "
      <!-- LOGIN -->
        <div class=\"row\">
            <div class=\"col-md-6 col-md-offset-2\">
                <div class=\"login-panel panel panel-default\">
                    <div class=\"panel-heading\">
                        <h3 class=\"panel-title\">Por favor, insira seu usuário e senha:</h3>
                        <h3>*O campo usuário não pode ser vazio!</h3>
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
else if($_POST['password'] == NULL){
	echo "
      <!-- LOGIN -->
        <div class=\"row\">
            <div class=\"col-md-6 col-md-offset-2\">
                <div class=\"login-panel panel panel-default\">
                    <div class=\"panel-heading\">
                        <h3 class=\"panel-title\">Por favor, insira seu usuário e senha:</h3>
                        <h3>*O campo senha não pode ser vazio!</h3>
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
}else{
	require("../model/Database.php");
	$DB = new Database();
	$DB->conexao();

}



?>
