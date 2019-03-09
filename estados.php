<?php require_once("../Projeto/conexao.php"); ?>
<?php 
	if(mysqli_connect_errno()){
		die("Falha na conexão: " .mysqli_connect_errno());
	}

	$select = "SELECT estados FROM sigla";
	$lista_estados = mysqli_query($conecta,$select);
	if(!$lista_estados){
		die("Erro no banco");
	}
?>