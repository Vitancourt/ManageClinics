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

<script>
function moeda(z){
v = z.value;
v=v.replace(/\D/g,"") // permite digitar apenas numero
//v=v.replace(/(\d{1})(\d{17})$/,"$1.$2") // coloca ponto antes dos ultimos digitos
//v=v.replace(/(\d{1})(\d{13})$/,"$1.$2") // coloca ponto antes dos ultimos 13 digitos
//v=v.replace(/(\d{1})(\d{10})$/,"$1.$2") // coloca ponto antes dos ultimos 10 digitos
//v=v.replace(/(\d{1})(\d{7})$/,"$1.$2") // coloca ponto antes dos ultimos 7 digitos
v=v.replace(/(\d{1})(\d{0,1})$/,"$1,$2") // coloca virgula antes dos ultimos 4 digitos
z.value = v;
}
</script>

        <!-- Begin-P�gina -->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Adicionar conta
                        </h1>
                    </div>
                </div>
                <form action="../controller/conta.php" method="post">
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-6">
                          <?php echo $erro; ?>
                            <div class="form-group">
                                    <label>Descrição</label>
                                    <textarea class="form-control" name="descricao" maxlength="150" placeholder="Descrição" rows="5" required></textarea>
                                    <label>Data de criação (DD/MM/AAAA)</label>
                                    <input onkeypress="mascara(this, mdata);" class="form-control" type="datetime" name="data" maxlength="10" value="<?php date_default_timezone_set('America/Sao_Paulo');  echo date("d/m/Y"); ?>"placeholder="15/04/1993" readonly="true">
                                    <label>Data de pagamento (DD/MM/AAAA)</label>
                                    <input onkeypress="mascara(this, mdata);" class="form-control" type="text" name="datapgto" maxlength="10" placeholder="15/04/1993" required>
                                    <label>Valor (R$)</label>
                                    <input onkeypress="moeda(this);" class="form-control" type="text" name="valor" maxlength="50" placeholder="80,00">
                                    <label>Tipo</label>
                                    <div class="radio">
                                      <label><input type="radio" name="tipo" value="1" checked="true"/>A pagar</label>
                                    </div>
                                    <div class="radio">
                                      <label><input type="radio" name="tipo" value="0"/>A receber</label>
                                    </div>
                                    <label>Pago</label>
                                    <div class="radio">
                                      <label><input type="radio" name="pago" value="1" checked="true"/>Sim</label>
                                    </div>
                                    <div class="radio">
                                      <label><input type="radio" name="pago" value="0"/>Não</label>
                                    </div>
                        </div>
                        <button type="submit" name="adConta" class="btn btn-primary "> Cadastrar </button>
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
