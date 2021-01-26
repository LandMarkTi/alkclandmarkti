<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Keywords" content="Painel de Controle - NEOWARE" /> 
<meta name="Description" content="Painel de Controle - NEOWARE"/> 
<meta name="copyright" content="Neoware Criação e Desenvolvimento de Websites e Sistemas - www.neoware.com.br" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="css/style_internas.css" />
<link href="css/sobraci/jquery-ui-1.10.3.custom.css" rel="stylesheet">
	<script src="js/jquery-1.9.1.js"></script>
	<script src="js/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="cep.js"></script>


<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle - NEOWARE .::</title>
<style type="text/css">
	@page {  }
	table { border-collapse:collapse; border-spacing:0; empty-cells:show }
	td, th { vertical-align:top; font-size:12pt;}
	h1, h2, h3, h4, h5, h6 { clear:both }
	ol, ul { margin:0; padding:0;}
	li { list-style: none; margin:0; padding:0;}
	<!-- "li span.odfLiEnd" - IE 7 issue-->
	li span. { clear: both; line-height:0; width:0; height:0; margin:0; padding:0; }
	span.footnodeNumber { padding-right:1em; }
	span.annotation_style_by_filter { font-size:95%; font-family:Arial; background-color:#fff000;  margin:0; border:0; padding:0;  }
	* { margin:0;}
	.Footer { font-size:12pt; font-family:Times New Roman; writing-mode:lr-tb; }
	.Header { font-size:12pt; font-family:Times New Roman; writing-mode:lr-tb; }
	.P1 { font-size:12pt; font-family:Times New Roman; writing-mode:lr-tb; text-align:center ! important; }
	.P10 { font-size:9pt; font-family:Arial; writing-mode:lr-tb; margin-left:0cm; margin-right:0cm; text-align:justify ! important; text-indent:0.635cm; }
	.P2 { font-size:10pt; font-family:Arial; writing-mode:lr-tb; text-align:justify ! important; }
	.P3 { font-size:10pt; font-family:Arial; writing-mode:lr-tb; text-align:justify ! important; font-weight:bold; }
	.P4 { font-size:12pt; font-family:Times New Roman; writing-mode:lr-tb; text-align:justify ! important; }
	.P5 { font-size:10pt; font-family:Arial; writing-mode:lr-tb; margin-left:0cm; margin-right:0cm; text-align:justify ! important; text-indent:1.249cm; }
	.P6 { font-size:12pt; font-family:Times New Roman; writing-mode:lr-tb; margin-left:0cm; margin-right:0cm; text-align:justify ! important; text-indent:1.249cm; }
	.P7 { font-size:10pt; font-family:Arial; writing-mode:lr-tb; text-align:justify ! important; }
	.P8 { font-size:10pt; font-family:Arial; writing-mode:lr-tb; text-align:justify ! important; font-weight:bold; }
	.P9 { font-size:12pt; font-family:Times New Roman; writing-mode:lr-tb; text-align:justify ! important; }
	.Tabela1 { width:15.028cm; margin-left:1.217cm; writing-mode:lr-tb; }
	.Tabela1_A1 { vertical-align:bottom; padding:0cm; border-style:none; }
	.Tabela1_B1 { vertical-align:bottom; padding:0cm; border-width:0,0353cm; border-style:solid; border-color:#00000a; }
	.Tabela1_C1 { vertical-align:bottom; padding:0cm; border-left-style:none; border-right-width:0,0353cm; border-right-style:solid; border-right-color:#00000a; border-top-width:0,0353cm; border-top-style:solid; border-top-color:#00000a; border-bottom-width:0,0353cm; border-bottom-style:solid; border-bottom-color:#00000a; }
	.Tabela1_A { width:0.915cm; }
	.Tabela1_B { width:0.706cm; }
	.Tabela1_C { width:0.704cm; }
	.Tabela1_U { width:0.716cm; }
	.T1 { font-family:Arial; font-size:10pt; }
	.Tabela1 input{width:20px;}
	.T2 { font-family:Arial; font-size:10pt; text-decoration:underline; font-weight:bold; }
	.T3 { font-family:Arial; font-size:10pt; }
	.T4 { font-family:Arial; font-size:10pt; font-weight:bold; }
	<!-- ODF styles with no properties representable as CSS -->
	.Tabela1.1 { }
	</style>
<script type="text/javascript" src="jquery/maskedinput.js"></script>
</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header2.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <div id="internas_box2">
   	  <div id="internas_principal2">
    	  <div class="arial_branco20" id="internas_titulo">FORMULÁRIO PARA FILIAÇÃO E ABERTURA DE CANIL - SOBRACI         
            <div style="float:right; margin-left:10px;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" border="0" title="Voltar página anterior" ></a></div>                   
          </div>
         <div style="display:table;margin: 87px;margin-left: 115px;"> 
        <form action="env_filiacao.php" onsubmit="return valida();" method="post">

<p class="P2">&nbsp;</p>
<p class="P4"><span class="T1">1º Nome (TITULAR): <input name="nome" onkeyup="$('#nome_completo').val(this.value);" style="width:604px"></span></p>
<p class="P2">&nbsp;</p>
<p class="P4"><span class="T1">2º Nome: <input name="sobrenome" style="width:674px"></span></p>
<p class="P2">&nbsp;</p>
<p class="P4"><span class="T1">Nacionalidade: <input name="nacionalidade" >Estado Civil: <input name="estado_civil" >Profissão: <input name="profissão" style="width: 159px;"></span></p>
<p class="P2">&nbsp;</p>
<p class="P4"><span class="T1">Data de Nasc: <input name="Nascimento" id="nasc">CPF:<input name="cpf" >RG:<input name="RG" style="width: 244px;"></span></p>
<p class="P2">&nbsp;</p>
<p class="P2"><p class="P4"><span class="T1">CEP:<input name="cep" id="cep" maxlength="9" onkeyup="$('#cep_corresp').val(this.value);" onblur="getEndereco();">E-mail: <input name="email" id="em" size="25"> Copiar Endereço para Correspondência: <b style="cursor:pointer;" onclick="conf(this);">☑</b> </span></p>&nbsp;</p>
<p class="P4"><span class="T1">Bairro: <input name="bairro" onkeyup="$('#bairro_corresp').val(this.value);">Cidade:<input name="cidade" onkeyup="$('#cidade_corresp').val(this.value);" style="width: 282px;" onblur="$('#local_assinatura').val(this.value);" >Est:<input name="estado" ></span></p>
<p class="P2">&nbsp;</p>
<p class="P4"><span class="T1">End. Residencial: <input name="End_residencial" style="width:630px" onkeyup="$('#end_corresp').val(this.value);"></span></p>
<p class="P2">&nbsp;</p>

<p class="P4"><span class="T1">Complemento: <input name="complemento" style="width:520px" id="com1"></span><span class="T1">Nº: <input id="com2" name="complemento" style="width:100px" ></span></p>
<p class="P2">&nbsp;</p>

<p class="P4"><span class="T3">End. p/ corresp. :</span><span class="T1"><input name="end_corresp" id="end_corresp" size="79"></span></p>
<p class="P2">&nbsp;</p>
<p class="P4"><span class="T1">Bairro: <input name="bairro_corresp" id="bairro_corresp">Cidade: <input name="cidade_corresp" style="width: 270px;" id="cidade_corresp" >CEP:<input name="cep_corresp" id="cep_corresp" ></span></p>
<p class="P2">&nbsp;</p>
<p class="P4"><span class="T1">DDD: <input name="ddd" size="2">Fones Resid:<input name="fone_res" > Com:<input name="fone_com" style="width: 185px;">Fax:<input name="fone_fax" ></span></p>
<p class="P2">&nbsp;</p>
<p class="P2">&nbsp;</p>
<p class="P4"><span class="T4">Solicito o Registro do Canil de minha propriedade conforme as opções de nomes abaixo relacionadas:</span></p>
<p class="P2">&nbsp;</p>
<p class="P4"><input name="opcoes_nomes" id="opnome" size="50" style="margin-left: 131px;" onblur="$.post('vernome.php',{non:$('#opnome').val()},function(data){alert(data);$('#apr').val(data);});"><button type="button" >Verificar</button></p>
<p class="P2">&nbsp;</p>
<p class="P5"> </p>
<p class="P6"><span class="T1">O canil acima será utilizado como: (<input type="radio" value="prefixo" name="uso_canil" checked="checked"> ) Prefixo                ( <input type="radio" value="sulfixo" name="uso_canil">   ) Sufixo</span></p>
<p class="P2">&nbsp;</p>
<p class="P2">&nbsp;</p>
<p class="P4"><span class="T1">Criador das Raças: <input  name="Raças" style="width:600px"></span></p>
<p class="P2">&nbsp;</p>
<p class="P4" style="width: 724px;"><span class="T4">Eu,<input name="nome_completo" id="nome_completo">, conforme dados acima, por não ser associado e sim filiado da SOCIEDADE BRASILEIRA DE CINOFILIA, isento de taxas e contribuições a título de Sociedade, comprometo-me a acatar, respeitar, seguir e fazer com que sigam os seus  Regimentos e Regulamentos, sob a pena de exclusão da filiação,
 por ato de seu Conselho Administrativo ou de seu Presidente, no entanto reservando-me o direito de dela desvincular-me quando assim o desejar, bastando para isso comunicação por escrito.
 Declaro sob minha responsabilidade que não existe nome análogo ou semelhante e eximo a entidade filiadora de qualquer responsabilidade.</span></p>
 <p class="P3"> </p>
 <p class="P3"> </p>
 
<p class="P2">&nbsp;</p>
 <p class="P4"><span class="T4"><b style="cursor:pointer;" onclick="conf(this);">☑</b> Declaro que os dados inseridos no sistema são de minha inteira responsabilidade, não cabendo a Sobraci qualquer tipo de checagem presencial perante os animais</span> </p>

<p class="P2">&nbsp;</p>
      
 <p class="P4"><span class="T4">Local e Data:<input maxlength="15" size="20" name="local_assinatura" id="local_assinatura">,<input maxlength="10" size="2" name="dia_assinatura" value='<?php echo date("d",time());?>'> de <input maxlength="10" size="10" name="mes_assinatura" value='<?php echo date("m",time());?>'> de <input maxlength="10" size="4" id="final" name="ano_assinatura" value='<?php echo date("Y",time());?>'></span></p><p class="P8"> </p><p class="P8"> </p><p class="P9"><span class="T4"> </span></p>
<p class="P9"><br><input type="hidden" id="nome0" nome="nome0" value="vazio"><input type="submit" id="enviar"  value="enviar"></p>

</form>
</div>
<input id="apr" value="Esse Nome Já existe" type="hidden">
    </div>   
   </div> 
  </div>
</div>
<script>
//wildfields!!
$('.Tabela11 input').keyup(function(){$( 'input:focus' ).parent().parent().parent().next().children().children().children().focus();});
$('#final').focus(function(){//submit
//$('#nome0').val('');
//$('.Tabela11:even').each(function(index,element){var x=$(element).children().children().children();$(x).each(function(index,y){if(index>0)$('#nome0').val($('#nome0').val()+$(y).children().val());});$('#nome0').val($('#nome0').val()+'¬');});

});



//

$('input[name="cpf"]').mask("999.999.999-99");
$('#cep').mask("99999-999");
$('#cep_corresp').mask("99999-999");
$('input[name="fone_res"]').mask("9999-9999");
$('input[name="fone_com"]').mask("9999-9999");
$('input[name="fone_fax"]').mask("9999-9999");

$('button').click(function(){});


function valida(){
	var retorno=true;
	var em=$('#em').val();
	var re = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
        if(!re.test(em)){$('#em').val('');}
	$('input[size!="1"][name!="fone_fax"]').each(function(index,elem){if($(elem).val()==''){retorno=false;}});
	if(retorno==false){alert('Favor preencher todos os campos em vermelho!');
	if($('#apr').val()=='Esse Nome Já existe'){retorno=false;$('#opnome').css('background-color','pink');$(this).focus(function(){$(this).css('background-color','white');$(this).val('');});alert('troque o nome do canil.');}
	$('input[size!="1"][name!="fone_fax"]').each(function(index,elem){if($(this).val()==''){$(this).val("Campo Obrigatório");$(this).css('background-color','pink');$(this).focus(function(){$(this).css('background-color','white');$(this).val('');});}});
	}
	if(retorno){
//conteudo
var End_residencial=$('input[name=End_residencial]').val();
var cep=$('input[name=cep]').val();
var email=$('input[name=email]').val();

	var sete=$('.P4:eq(6)').html();
	var cinco=$('.P4:eq(4)').html();

$('.P4:eq(6)').html(cinco);
$('.P4:eq(4)').html(sete);
$('input[name=End_residencial]').val(End_residencial);
$('input[name=cep]').val(cep);
$('input[name=email]').val(email);
var com=$('input[name=End_residencial]').val();
com+=' '+$('#com1').val()+' nº '+$('#com1').val();
$('input[name=End_residencial]').val(com);
$('#com1,#com2').remove();
return retorno;
}else return retorno;
	
}
function conf(ev){
	$('input:gt(0)').removeAttr('onkeyup');
	ev.innerHTML='☐';
}

</script>
<script type="text/javascript">
	
jQuery(function($){


	// Datepicker
	$('#nasc').datepicker({
		inline: true,
		dateFormat: "dd/mm/yy",
		changeYear: true
	});
	$('#nasc').datepicker('option', 'monthNames',['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro']);
	// Datepicker

	//console.log($.datepicker.regional['']);
});

</script>
<?php include "footer.php";?>
</body>
</html>
