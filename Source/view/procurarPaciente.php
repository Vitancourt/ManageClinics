        <!-- Begin-Página -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="col-lg-6">
                    <h2>Procurar paciente</h2>
                    <form action="listarPaciente.php" method="post">
                      <div class="form-group">
                      <label>Nome do paciente</label>
                      <input class="form-control" type="text" name="nome" maxlength="50" required>
                      </div>
                      <button type="submit" name="procurar" class="btn btn-primary "> Procurar </button>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Nome do paciente</th>
                                    <th>Visualizar</th>
                                    <th>Editar</th>
                                    <th>Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                  if(isset($_POST['procurar'])){
                                    require_once("../controller/buscarPaciente.php");
                                  }else{
                                    //Chama função que imprime todos Pacientes ativos
                                    require_once("../controller/listPaciente.php");
                                  }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
