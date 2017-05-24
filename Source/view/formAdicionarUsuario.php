        <!-- Begin-P�gina -->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Adicionar usuário
                        </h1>
                    </div>
                </div>
                <form action="../controller/adUsuario.php" method="post">
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-6">
                          <?php echo $erro; ?>
                            <div class="form-group">
                                    <label>Nome completo *</label>
                                    <input class="form-control" type="text" name="nome" maxlength="50" required>
                                    <label>Nome de usuario (usado para login) *</label>
                                    <input class="form-control" type="text" name="usuario" maxlength="20">
                                    <label>Senha *</label>
                                    <input class="form-control" type="text" name="sneha" maxlength="20">
                        </div>
                        <button type="submit" name="adUsuario" class="btn btn-primary "> Cadastrar </button>
                        <button type="reset" class="btn btn-warning"> Limpar </button>
                    </div>
                  </div>
          </form>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo $css; ?>js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $css; ?>js/bootstrap.js"></script>



</body>

</html>
