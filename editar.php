<?php include_once("../Projeto/conexao.php"); include("../Projeto/listar.php"); ?>
<?php
	include('validacnpj.php');

	if(isset($_POST["razaoSoc"])){
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
		$nid = $_POST['id'];

			$valida_cnpj = new ValidaCNPJ($cnpj);
			$formatado = $valida_cnpj->formata();			

			if ( $valida_cnpj->valida()) {
			echo "<div class='alert alert-success' role='alert' style='width: 800px; margin: 0px auto 0px auto;'>Dados alterados com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

				$alterar = "UPDATE estabelecimentos SET razao = '$razao', fantasia = '$fantasia', cnpj = '$cnpj', email = '$email', endereco = '$endereco', cidade = '$cidade', estado = '$estado',categoria = '$categoria',telefone = '$telefone', status = '$status', agencia = '$agencia' , conta = '$conta' , datacadastro = '$data' WHERE id = {$nid}";
				$operacao_alterar = mysqli_query($conecta,$alterar);
			}else{
				echo "<div class='alert alert-danger' role='alert' style='width: 800px; margin: 0px auto 0px auto;'><b>Erro:</b> CNPJ inválido!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
			}

	}
	
	
	$procura = "SELECT * FROM estabelecimentos ";
	if(isset($_GET["codigo"])){
		$id = $_GET["codigo"];
		$procura .= "WHERE id = {$id} ";
	} else{
		$procura .= "WHERE id = 1";
	}
	$inserir = mysqli_query($conecta,$procura);

	$info_dados = mysqli_fetch_assoc($inserir);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>FitCard</title>
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/jquery.mask.min.js"></script>
		<script src="bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="js/funcoes.js"></script>

		<link rel="stylesheet" type="text/css" href="bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
		<link rel="stylesheet" type="text/css" href="css/grid.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>
<body>
	<div>
	
</div>
	<form action="editar.php" method="post">
		<section id="painelEdit"class="jumbotron jumbotron-fluid col-md-12 col-sm-12 col-12">			
			<div id="barraIni">
				<h4 id="editar"><a id="voltar" title="voltar" href="index.php"><i class="far fa-arrow-alt-circle-left"></i></a>Editar Cadastro</h4>
			</div>
				<div id="painelEdit2">
					<div class="form-row">
			      			<div class="col-lg-6">
					        	<label for=""><h6>Razão Social:</h6></label>
								<input type="text" class="form-control" id="razaoSoc" name="razaoSoc" value="<?php echo utf8_encode($info_dados["razao"]); ?>" required="">
						    </div>		    		
							<div class="col-lg-6">			   
								<label for=""><h6>Nome Fantasia:</h6></label>
								<input type="text" class="form-control" id="nomeFant" name="nomeFant" value="<?php echo utf8_encode($info_dados["fantasia"]); ?>">
					    	</div>
						</div>
						<div class="form-row">
						    <div class="col-lg-5">
						        <label for=""><h6>CNPJ:</h6></label>
								<input type="text" class="form-control" id="cnpj" name="cnpj" minlength="14" value="<?php echo $info_dados["cnpj"]; ?>" required="">
						   </div>
						    <div class="col-lg-3">
						        <label for=""><h6>Categoria:</h6></label>
								<select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="categ" value="<?php echo $info_dados["categoria"]; ?>" required>
							        <option value="">Selecione...</option>
							        <option value="Borracharia">Borracharia</option>
							        <option value="Oficina">Oficina</option>
							        <option value="Posto">Posto</option>
							        <option value="Restaurante">Restaurante</option>
							        <option value="Supermercado">Supermercado</option>
			      				</select>
						    </div>
						    <div class="col-lg-4">
						        <label for=""><h6 id="tel1">Telefone:</h6></label>
								<input type="text" class="form-control" id="tel" name="tel" value="<?php echo $info_dados["telefone"]; ?>">
						   </div>    
			      		</div>
			      		<div class="form-row">
			      			<div class="col-lg-6">
						        <label for=""><h6>Endereço:</h6></label>
								<input type="text" class="form-control" id="end" name="end" value="<?php echo utf8_encode($info_dados["endereco"]); ?>">
						   	</div>
						   	<div class="col-lg-3">
						        <label for=""><h6>Cidade:</h6></label>
						        <input type="text" class="form-control" id="end" name="cid" value="<?php echo utf8_encode($info_dados["cidade"]); ?>">
						    </div>
						    <?php
						    	$select = "SELECT estadoID, nome FROM estados";
			    				$lista_estados = mysqli_query($conecta, $select);
			    			?>
						    <div class="col-lg-3">
						        <label for=""><h6>Estado:</h6></label>
								<select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="est" required="">
										<option value="Selecione...">Selecione...</option>
						    		<?php
			                            while($linha = mysqli_fetch_assoc($lista_estados)) {
			                        ?>
			                            <option value="<?php echo utf8_encode($linha["estadoID"]);  ?>">
			                                <?php echo utf8_encode($linha["nome"]);  ?>
			                            </option>
			                        <?php
			                            }
			                        ?> 				      
			      				</select>
						    </div>
			      		</div>
			      		<div class="form-row">
			      			<div class="col-lg-6">
						        <label for=""><h6>E-mail:</h6></label>
								<input type="email" class="form-control" name="email" id="email" value="<?php echo $info_dados["email"]; ?>">
						   	</div>
						   	<div class="col-lg-3">
						        <label for=""><h6>Agencia:</h6></label>
								<input type="text" class="form-control" name="ag" id="ag" value="<?php echo $info_dados["agencia"]; ?>">
						   	</div>
						   	<div class="col-lg-3">
						        <label for=""><h6>Conta:</h6></label>
								<input type="text" class="form-control" name="cc" id="cc" value="<?php echo $info_dados["conta"]; ?>">
						   	</div>
			      		</div><br>
			      		<label><h6 id="labStatus">Status:</h6></label>
			      		<div class="form-row" id="radioStatus">
				      		<div class="custom-control custom-radio custom-control-inline mt-5">
				  				<input type="radio" id="customRadioInline1" name="radio" class="custom-control-input" value="ativo" checked>
				  				<label class="custom-control-label" for="customRadioInline1"><h6>Ativo</h6></label>
							</div>
							<div class="custom-control custom-radio custom-control-inline mt-5">
							  	<input type="radio" id="customRadioInline2" name="radio" class="custom-control-input" value="inativo">
							 	<label class="custom-control-label" for="customRadioInline2"><h6>Inativo</h6></label>	 	
							</div>
							<div class="col-xl-5 col-lg-5"></div>
							<div class="col-lg-3 col-md-12 col-sm-12 col-12 ml-4" id="campoData">
								<label for="" id="dataAlt"><h6>Data de alteração:</h6></label>
								<input type="date" class="form-control text-right" name="data" id="dataEdit" value="<?php echo date('Y-m-d'); ?>" readonly>
						   	</div>
						</div>
						<input type="hidden" name="id" value="<?php echo $info_dados["id"]; ?>">
					<button type="submit" class="btn btn-primary btn-lg" id="salvarEdit" name="salvar">Salvar</button>
				</div>
		</section>					
	</form>

</body>
</html>