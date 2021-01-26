	// Função única que fará a transação
	function getEndereco() {
			// Se o campo CEP não estiver vazio
			if($.trim($("#cep").val()) != ""){
				/* 
					Para conectar no serviço e executar o json, precisamos usar a função
					getScript do jQuery, o getScript e o dataType:"jsonp" conseguem fazer o cross-domain, os outros
					dataTypes não possibilitam esta interação entre domínios diferentes
					Estou chamando a url do serviço passando o parâmetro "formato=javascript" e o CEP digitado no formulário
					http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val()
				*/
				$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val(), function(){
					// o getScript dá um eval no script, então é só ler!
					//Se o resultado for igual a 1
			  		if(resultadoCEP["resultado"]){
						// troca o valor dos elementos
						$('input[name=End_residencial]').val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
						$('input[name=bairro]').val(unescape(resultadoCEP["bairro"]));
						$('input[name=cidade]').val(unescape(resultadoCEP["cidade"]));
						$('input[name=estado]').val(unescape(resultadoCEP["uf"]));
					if($('b').text()=='☑'){
						$('input[name=end_corresp]').val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
						$('input[name=bairro_corresp]').val(unescape(resultadoCEP["bairro"]));
						$('input[name=cidade_corresp]').val(unescape(resultadoCEP["cidade"]));
						$('input[name=cep_corresp]').val($("#cep").val());
					}
					}else{
						alert("Endereço não encontrado");
					}
				});				
			}			
	}

