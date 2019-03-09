<?php include_once("../Projeto/conexao.php"); ?>
<?php
	if(mysqli_connect_errno()){
		die("A conexão falhou: " . mysqli_connect_errno());
	}
	if(isset($_POST["id"])){
		$id = $_POST["id"];

		$exclusao = "DELETE FROM estabelecimentos WHERE id = {$id}";
		$deleta = mysqli_query($conecta,$exclusao);

		if ($deleta) {
			$retorno["sucesso"] = true;
			$retorno["mensagem"] = "Excluido com sucesso";
		}
		else{
			$retorno["sucesso"] = false;
			$retorno["mensagem"] = "Falha no sistema";
		}
	}
	echo json_encode($retorno);

	mysqli_close($conecta);

?>