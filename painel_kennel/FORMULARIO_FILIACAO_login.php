<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="css/style_internas.css" />
<link href="css/sobraci/jquery-ui-1.10.3.custom.css" rel="stylesheet">
	<script src="js/jquery-1.9.1.js"></script>
	<script src="js/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="cep.js"></script>

<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle  .::</title>
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
	.T1 { font-family:Arial; font-size:10pt;color:#2b829e; }
	.Tabela1 input{width:20px;}
	.T2 { font-family:Arial; font-size:10pt; text-decoration:underline; font-weight:bold; color:#2b829e;}
	.T3 { font-family:Arial; font-size:10pt; color:#2b829e;}
	.T4 { font-family:Arial; font-size:10pt; font-weight:bold; color:#2b829e;}
	<!-- ODF styles with no properties representable as CSS -->
	.Tabela1.1 { }
	input{color: gray}
	</style>
<script type="text/javascript" src="jquery/maskedinput.js"></script>
</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" ><!--background="images/fundos/bg.jpg"-->
<?php //include "header2.php";


require_once("Connections/conexao.php");

$sql = "SELECT  *  FROM  `credenciado` join dados_credenciado on credenciado.id_credenciado=dados_credenciado.id_dados   WHERE id_credenciado not in (16,44,68,43,17,15,43,41) ";

$query = mysql_query($sql) or die(mysql_error());
while($opt=mysql_fetch_assoc($query))$sel.='<option value="'.$opt['id_credenciado'].'">'.$opt['nome'].'</option>';

?>
<div id="internas_full" style="">
 <div id="internas_margem_full" style="width: 750px;">
    <div id="internas_box2" style="width: 750px;">
   	  <div  style="border: 1px solid white;background-color:white;    min-height: 525px;">
   
  
<br>
 
<br>
 
<br>


<br>
 
<br>
 
<br>

<center style="cursor:pointer;color:#2b829e;font-family: 'Open Sans', sans-serif;" onclick="top.location='../painel_criador_alkc/index.php';"><span style="border: 3px solid #2b829e; border-radius:4px;padding:10px;padding-left: 46px;padding-right: 46px;">PAINEL CRIADOR</span></center>

<br>
<br>
<br>
<center style="cursor:pointer;color:#2b829e;font-family: 'Open Sans', sans-serif;" onclick="location='../registrar/form_canil2.php';"><span style="border: 3px solid #2b829e; border-radius:4px;padding:10px">Não possuo Canil no ALKC</span>
</center>


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


function vc(str){
    str = str.replace('.','');
    str = str.replace('.','');
    str = str.replace('-','');
 
    cpf = str;
    var numeros, digitos, soma, i, resultado, digitos_iguais;
    digitos_iguais = 1;
    if (cpf.length < 11)
        return false;
    for (i = 0; i < cpf.length - 1; i++)
        if (cpf.charAt(i) != cpf.charAt(i + 1)){
            digitos_iguais = 0;
            break;
        }
    if (!digitos_iguais){
        numeros = cpf.substring(0,9);
        digitos = cpf.substring(9);
        soma = 0;
        for (i = 10; i > 1; i--)
            soma += numeros.charAt(10 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0)){alert('CPF é Obrigatório!');return false;}
        numeros = cpf.substring(0,10);
        soma = 0;
        for (i = 11; i > 1; i--)
            soma += numeros.charAt(11 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1)){alert('CPF é Obrigatório!');return false;}
        return true;
    }
    else{alert('CPF é Obrigatório!');return false;}
}

$('#cpff,input[name="cpf2"]').mask("999.999.999-99");
$('#cep').mask("99999-999");
$('#cep_corresp').mask("99999-999");
$('input[name="fone_res"]').mask("9999-9999");
$('input[name="fone_com"]').mask("9999-9999");
$('input[name="fone_fax"]').mask("99999-9999");


$('input[name="cpf1"]').blur(function(){
var cepe=this.value;
if (vc(cepe)==false){$('input[name="cpf1"]').val('');} else $('#cepf').val(cepe);

});//input[name="cpf2"]

$('input[name="cpf2"]').blur(function(){
var cepe=this.value;
if (vc(cepe)==false){$('input[name="cpf2"]').val('');} 

});


$('button').click(function(){});


function valida(){
	var retorno=true;

	if($('select').val()==''){alert('Selecione um Núcleo.');return false;}
	var em=$('#em').val();
	var re = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
        if(!re.test(em)){$('#em').val('');}
	$('input[size!="1"][name!="fone_fax"][name!="complemento"][name!="sobrenome"][name!="cpf2"]').each(function(index,elem){if($(elem).val()==''){retorno=false;}});
	if(retorno==false){alert('Favor preencher todos os campos em vermelho!');
	if($('#apr').val()=='Esse Nome Já existe'){retorno=false;$('#opnome').css('background-color','pink');$(this).focus(function(){$(this).css('background-color','white');$(this).val('');});alert('troque o nome do canil.');}
	$('input[size!="1"][name!="fone_fax"][name!="complemento"][name!="sobrenome"]').each(function(index,elem){if($(this).val()==''){$(this).val("Campo Obrigatório");$(this).css('background-color','pink');$(this).focus(function(){$(this).css('background-color','white');$(this).val('');});}});
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
com+=' '+$('#com1').val()+' nº '+$('#com2').val();
$('input[name=End_residencial]').val(com);
$('#com1,#com2').remove();
//$(".cpr").remove();
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
<?php //include "footer.php";?>
</body>
</html>
