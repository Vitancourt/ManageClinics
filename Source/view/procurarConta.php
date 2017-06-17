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
<!-- Begin-Página -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="col-lg-12">
            <h2>Procurar conta</h2>
            <form action="listarConta.php" method="post">
              <div class="form-group">
              <label>Buscar por descrição:</label>
              <input class="form-control" type="text" name="desc" maxlength="50">
              <label>Buscar por data:</label>
              <input class="form-control" onkeypress="mascara(this, mdata);" type="text" name="data" maxlength="10">
              </div>
              <div>
                <label>Filtro sobre a baixa:</label>
                <label><input type="radio" name="filtro" value="pago" checked= "true" />Pago</label>
                <label><input type="radio" name="filtro" value="npago" />Não pago</label>
              </div>
              <div>
                <label>Filtro sobre o tipo:</label>
                <label><input type="radio" name="filtro" value="tipoPagar" />Pagar</label>
                <label><input type="radio" name="filtro" value="tipoReceber" />Receber</label>
              </div>
              <button type="submit" name="procurar" class="btn btn-primary "> Procurar </button>
            </form>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Data efetiva</th>
                            <th>Tipo</th>
                            <th>Baixa</th>
                            <th>Visualizar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          if(isset($_POST['procurar'])){
                            require_once("../controller/buscarConta.php");
                          }else{
                            //Chama função que imprime todos Pacientes ativos
                            require_once("../controller/listConta.php");
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
