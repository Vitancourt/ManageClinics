<!-- LOGIN -->
<div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Por favor, insira seu usuário e senha:</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="../controller/logar.php" method="post">
                        <?php echo $erro; ?>
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Usuário" name="usuario" type="text" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Senha" name="password" type="password" value="">
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <input name="buttonlogar" type="submit" value="Entrar" class="btn btn-lg btn-success btn-block">                                
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
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/morris.min.js"></script>
<script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>