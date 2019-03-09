<?php include_once("../Projeto/conexao.php"); ?>
<?php
	 include('validacnpj.php');
	 date_default_timezone_set('America/Sao_Paulo');

		$razao = utf8_decode($_POST['razaoSoc']);
		$fantasia = utf8_decode($_POST['nomeFant']);
		$cnpj = $_POST['cnpj'];
		$categoria = utf8_decode($_POST['categ']);
		$telefone = $_POST['tel'];
		$endereco = utf8_decode($_POST['end']);
		$cidade = utf8_decode($_POST['cid']);
		$estado = utf8_decode($_POST['est']);
		$email = utf8_decode($_POST['email']);
		$agencia = $_POST['ag'];
		$conta = $_POST['cc'];
		$status = $_POST['radio'];
		$data = $_POST['data'];		

		// VALIDA A MÁSCARA E O CNPJ
			$valida_cnpj = new ValidaCNPJ($cnpj);
			$formatado = $valida_cnpj->formata();			

			if ( $valida_cnpj->valida()) {
				$query = "INSERT INTO estabelecimentos (razao,fantasia,cnpj,email,endereco,cidade,estado,categoria,telefone,status,agencia,conta,datacadastro) VALUES ('$razao','$fantasia','$cnpj','$email','$endereco','$cidade','$estado','$categoria','$telefone','$status','$agencia','$conta','$data')";
				$inserir = mysqli_query($conecta,$query);

				echo "<div class='alert alert-success' role='alert'>Dados cadastrados com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

			} else {
				echo "<div class='alert alert-danger' role='alert'><b>Erro:</b> CNPJ inválido!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
			}
			

?>