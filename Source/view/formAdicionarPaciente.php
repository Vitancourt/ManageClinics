<script type="text/javascript">
/* Máscaras Data */
function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
function mdata(v){
    v=v.replace(/\D/g,"");                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{2})(\d)/,"$1/$2");
    v=v.replace(/(\d{2})(\d)/,"$1/$2");
    v=v.replace(/(\d{2})(\d{2})$/,"$1$2");
    return v;
}

function id( el ){
	return document.getElementById( el );
}
function next( el, next )
{
	if( el.value.length >= el.maxLength )
		id( next ).focus();
}
</script>

<!--Mascara tel -->
<script>
/* Máscaras ER */
function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
function mtel(v){
    v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
    return v;
}
</script>

        <!-- Begin-P�gina -->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Adicionar paciente
                        </h1>
                    </div>
                </div>
                <form action="../controller/adPaciente.php" method="post">
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-6">
                          <?php echo $erro; ?>
                            <div class="form-group">
                                    <label>Nome de paciente</label>
                                    <input class="form-control" type="text" name="nome" required>
                                    <label>CPF</label>
                                    <input class="form-control" type="text" name="cpf">
                                    <label>Data de nascimento (DD/MM/AAAA)</label>
                                    <input onkeypress="mascara(this, mdata);" class="form-control" type="datetime" name="datanasc" maxlength="10" placeholder="15/04/1993">
                                    <label>Data de início do tratamento (DD/MM/AAAA)</label>
                                    <input onkeypress="mascara(this, mdata);" class="form-control" type="text" name="datainicio" maxlength="10" placeholder="25/07/2018">
                                    <label>Telefone celular</label>
                                    <input onkeypress="mascara(this, mtel);" id="telefone" class="form-control" type="text" name="telefoneCel" maxlength="15" placeholder="(55) 99191-9191">
                                    <label>Telefone residencial</label>
                                    <input onkeypress="mascara(this, mtel);" id="telefone" class="form-control" type="text" name="telefoneRes" maxlength="15" placeholder="(55) 99191-9191">
                                    <label>Telefone comercial</label>
                                    <input onkeypress="mascara(this, mtel);" id="telefone" class="form-control" type="text" name="telefoneCom" maxlength="15" placeholder="(55) 99191-9191">
                        </div>
                        <button type="submit" name="adPaciente" class="btn btn-primary "> Entrar </button>
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
