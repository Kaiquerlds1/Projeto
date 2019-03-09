//  ABRE MODAL
$('#painelModal').modal('show');

//  VALIDAÇÕES E MÁSCARA DE FORMULÁRIO
$(document).ready(function(){
	$("#cnpj").mask("00.000.000/0000-00");
	$("#tel").mask("(00) 0000-0000");
	$("#ag").mask("000-0");
	$("#cc").mask("00.000-0");
});
// FUNÇÃO AJAX
$(function(){
	$('.form').submit(function(){
       $.ajax({
       		url: 'valida.php',
       		type: 'POST',
       		data: $('.form').serialize(),
       		success: function(data){
				$('.mostrar').html(data);
       		}
   		});
       setTimeout(function() {
      		$('#painelModal').modal('hide');
    		}, 2000);
	    return false;
	});
});	 
// FUNÇÃO DA CATEGORIA SUPERMERCADO
$(function(){
	$("#inlineFormCustomSelect").change(function(){
	$("#inlineFormCustomSelect option:selected");
		if($(this).val() != 'Supermercado'){
			$("#hide").css("color","white");
			$("#hide").css("margin-left","-10px");
			$("#tel").attr("required", this.value == 'false');
		}
		else{
			$("#hide").css("color","red");
			$("#hide").css("margin-left","0px");
			$("#tel").attr("required", "");
		}										
	});
});
// HABILITA REQUIRED PARA O CAMPO E-MAIL APÓS O DÍGITO
$(function(){
	$('#email').change(function(){
		if($(this).val() <= '0'){
			$('#email').attr("required", this.value == 'false');
		}else{
			$('#email').attr("required", "");
		}
	});
});
// EXCLUSÃO DE ITENS DA LISTA
$(function(){
	$('#painelCons ul li a.delet').click(function(e){
		e.preventDefault();
		var id= $(this).attr("title");
		var elemento = $(this).parent().parent();

		$.ajax({
			type: "POST",
			data:"id=" + id,
			url:"exclusao.php",
			async:false
		}).done(function(data){
			$sucesso = $.parseJSON(data)["sucesso"];

			if($sucesso){
				$(elemento).fadeOut();
			} else{
				console.log("erro na exclusao");
			}
		}).fail(function(){
			console.log("erro no sistema");
		});
	});
});