<?php
	$consulta = "SELECT id, razao, cnpj, categoria FROM estabelecimentos ";
		if (isset($_GET["pesquisar"])) {
			$estabelecimento = $_GET["pesquisar"];
			$consulta .= "WHERE razao LIKE '%{$estabelecimento}%' ";
		}
	$resultado = mysqli_query($conecta, $consulta);
		if (!$resultado) {
			die("Falha na consulta ao banco");
		}
?>