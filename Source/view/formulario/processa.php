<?php
	//verifica se o botão foi pressionado
if(isset($_POST['button'])){

	echo "Nome: " .$_POST['nome']."<br>";
	if($_POST['sexo'] == "M")
		$sexo = "Masculino";
	else
		$sexo = "Feminino";
	echo "Sexo: " .$sexo."<br>";
	if($_POST['curso'] == 'direito')
		$curso = "Direito";
	else if ($_POST['curso'] == 'farmacia')
		$curso = "Farmácia";
	else
		$curso = "Ciência da Computação";
	echo "Curso: " .$_POST['curso']."<br>";
	echo "Segredo: " .$_POST['segredo']."<br>";
	echo $curso;
}

?>