<?php include_once("../Projeto/conexao.php"); include("../Projeto/listar.php"); ?>
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
	<!-- ======= PAINEL PRINCIPAL ======= !-->
		<form action="index.php" method="get">
			<section id="painel"class="jumbotron jumbotron-fluid col-lg-12 col-md-12 col-sm-12 col-12">
				<div id="barraIni">
					<h4>Consulta Estabelecimentos</h4>
				</div>		
					<div id="campoPesq" class="input-group col-lg-10 col-md-10 col-sm-10 col-12">

	  					<input type="text" name="pesquisar" class="form-control" placeholder="Pesquisar...">	  				
		  				<div class="input-group-append">
		    				<button id="buscar" name="buscar" class="fas fa-search btn btn-primary" type="submit"></button>
		    				<button id="cad" type="button" class="btn btn-success ml-1" data-toggle="modal" data-target="#painelModal">Cadastrar</button>
		 				</div>
					</div>				
		</form>
		<form action="exclusao.php" method="post">
			<div id="painelCons">
			  <?php
				while ($linha = mysqli_fetch_assoc($resultado)){
			  ?>
				  <ul id="grid">
				  	<li><h5><?php echo utf8_encode ($linha["razao"]) ?></h5></li>
				  	<li><?php echo utf8_encode ($linha["cnpj"]) ?></li>
				  	<li><?php echo utf8_encode ($linha["categoria"]) ?></li>
				  	<li><a href="" class="badge badge-danger delet" id="delet" title="<?php echo $linha['id'] ?>">Excluir<i class="far fa-trash-alt" id="icon"></i></a></li>
				  	<li><a href="editar.php?codigo=<?php echo $linha['id']; ?>" class="badge badge-warning" id="edit">Editar<i class="far fa-edit" id="icon"></i></a></li>
				  </ul>
			  <?php
				}
			   ?>
			</div>
		</form>

		</section>

	<!-- ====== JANELA MODAL DE CADASTRO ====== !-->
		<div class="modal fade col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id="painelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div id="mod" class="modal-dialog modal-lg " role="document">
		    <div class="modal-content">
		      <div id="modCab" class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Preencha o formulário abaixo</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		    <div class="modal-body">

		    	<div class="mostrar"></div>

		    <form action="valida.php" method="post" class="form">
		    	<div class="form-row">
	      			<div class="col-lg-6">
			        	<b>*&nbsp;</b><label for=""><h6>Razão Social:</h6></label>
						<input type="text" class="form-control" id="razaoSoc" name="razaoSoc" maxlength="40" required="">
				    </div>		    		
					<div class="col-lg-6">			   
						<label for=""><h6>Nome Fantasia:</h6></label>
						<input type="text" class="form-control" id="nomeFant" name="nomeFant">
			    	</div>
				</div>
				<div class="form-row">
				    <div class="col-lg-5">
				        <b>*&nbsp;</b><label for=""><h6>CNPJ:</h6></label>
						<input type="text" class="form-control" id="cnpj" name="cnpj" minlength="14" value="" required="">
				   </div>
				    <div class="col-lg-3">
				        <b>*&nbsp;</b><label for=""><h6>Categoria:</h6></label>
						<select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="categ" required="">
					        <option value="">Selecione...</option>
					        <option value="Borracharia">Borracharia</option>
					        <option value="Oficina">Oficina</option>
					        <option value="Posto">Posto</option>
					        <option value="Restaurante">Restaurante</option>
					        <option value="Supermercado">Supermercado</option>
	      				</select>
				    </div>
				    <div class="col-lg-4">
				        <i id="hide">*&nbsp;</i><label for=""><h6 id="tel1">Telefone:</h6></label>
						<input type="text" class="form-control" id="tel" name="tel">
				   </div>    
	      		</div>
	      		<div class="form-row">
	      			<div class="col-lg-6">
				        <label for=""><h6>Endereço:</h6></label>
						<input type="text" class="form-control" id="end" name="end">
				   	</div>
				   	<div class="col-lg-3">
				        <label for=""><h6>Cidade:</h6></label>
						<input type="text" class="form-control" id="end" name="cid">
				    </div>
				    <!-- ==== BUSCA ESTADOS NA TABELA === !-->
				    <?php
				    	$select = "SELECT estadoID, nome FROM estados";
	    				$lista_estados = mysqli_query($conecta, $select);
	    			?>
				    <div class="col-lg-3">
				        <label for=""><h6>Estado:</h6></label>
						<select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="est">
								<option value="">Selecione...</option>
				    		<?php
	                            while($linha = mysqli_fetch_assoc($lista_estados)) {
	                        ?>
	                            <option value="<?php echo utf8_encode($linha["nome"]);  ?>">
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
						<input type="email" class="form-control" name="email" id="email">
				   	</div>
				   	<div class="col-lg-3">
				        <label for=""><h6>Agencia:</h6></label>
						<input type="text" class="form-control" name="ag" id="ag">
				   	</div>
				   	<div class="col-lg-3">
				        <label for=""><h6>Conta:</h6></label>
						<input type="text" class="form-control" name="cc" id="cc">
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
					<div class="col-lg-6"></div>
					<div class="col-lg-3 ml-4" id="campoData">
						<label for="" id="dataCad"><h6>Data de cadastro:</h6></label>
						<input type="date" class="form-control text-right col-12" name="data" id="data" value="<?php echo date('Y-m-d'); ?>" readonly>
				   	</div>
				</div>
					<br><br>

	      		<div class="modal-footer">
	      			
	         		<button type="submit" class="btn btn-primary btn-lg" id="salvar" name="salvar">Salvar</button>
       </form>

</body>
</html>