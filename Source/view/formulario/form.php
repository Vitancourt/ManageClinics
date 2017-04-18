<html>
<head>
	<title>Formulário</title>
</head>
<body>
	<form action="processa.php" method="post">
			<input type="hidden" name="segredo" value="?"><br>
			Nome: <input type="text" name="nome"><br>
			Sexo: <input type="radio" name="sexo" value = "F"> Feminino
				  <input type="radio" name="sexo" value = "M"> Masculino<br>
			Curso: <select name="curso">
						<option name="direito">Direito</option>
						<option name="farmacia">Farmácia</option>
						<option name="cc">Ciência da Computação</option>
				   </select><br>
			<input type="submit" name="button" value="Enviar">

	</form>
</body>


</html>