<?php
session_start();
if($_SESSION['login']=='')die("<script>location='http://megapedigree.com/painel_criador_alkc/';</script>");

require_once("Connections/conexao.php");

$idped=(int)$_GET['id_ped'];
$idf=(int)$_GET['id_f'];


$sql1="select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$idped;
$qr1=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr1);



//bloqueio sem permissão id_ped sem o -

$jhb=mysql_query("select * from ped_print where id_ped='".$idped."' and id_f= '".($idf+4)."' order by id_perm desc limit 1") or die('ee2');
$lp=mysql_fetch_assoc($jhb);
$nrx=mysql_num_rows($jhb);

if ($nrx>=1 and $lp['tipo_perm']==1)die("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><script>alert('Pedigree Bloqueado.');window.top.location='http://megapedigree.com/painel_criador_alkc/index_principal.php';</script>");



$nloop=explode(';', $linha_ped['ninhada']);
$micro=explode(';', $linha_ped['nº microchip']);

$dif_nasc=time()-$linha_ped['nasc'];

$yy=date("Y",$dif_nasc);

$YY=$yy-1970;

$mm=date("m",$dif_nasc);

if($YY<1)$val='89.56';

if($YY>=1&&$YY<=8)$val='75.23';

if($YY>8)$val='idade';

$mic=$micro[$idf];

$nome=$nloop[$idf+4];

$reg=$linha_ped['registro'].$idf;
?><!DOCTYPE html>
<head>
<meta charset="utf-8"> 
<meta name="resource-type" content="document" />
<meta http-equiv="pragma" content="no-cache" />
<meta name="revisit-after" content="1" />
<meta name="robots" content="ALL" />
<meta name="distribution" content="Global" />
<meta name="rating" content="General" />
<meta name="classification" content="Internet">
<meta name="doc-class" content="Completed">
<meta name="doc-rights" content="Public">
<meta name="url" content="http://www.alkc.club"> 


<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="shortcut icon" href="favicon.png" />
<title>::. alkc .::</title>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed">
<?php //include "includes/header.php";?>
<script type="text/javascript" src="jquery/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="jquery/fancy/lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="jquery/fancy/source/jquery.fancybox.js?v=2.1.3"></script>
	<link rel="stylesheet" type="text/css" href="jquery/fancy/source/jquery.fancybox.css?v=2.1.2" media="screen" />
	<link rel="stylesheet" type="text/css" href="jquery/fancy/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="jquery/fancy/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<link rel="stylesheet" type="text/css" href="jquery/fancy/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="jquery/fancy/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	<script type="text/javascript" src="jquery/fancy/source/helpers/jquery.fancybox-media.js?v=1.0.5"></script>

	<script src="js/jquery-1.9.1.js"></script>
	<script src="js/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="cep.js"></script>
	<script src="js/jquery.maskedinput.js"></script>
	<script src="cep.js?hu=yy"></script>
<script>
onkeydown="$('input').removeAttr('readonly');"
</script>
<!--<?php echo $nrx.'-'.$lp['tipo_perm']?> -->
<script type="text/javascript">
		
</script>

<div class="internas_full" style="width: 100%;">
 <div class="internas_margem_full" style="width: 80%;">
 
 	<div class="internas_box" style="width: 100%;">
    <div class="arial_cinza1_11" style="margin-top:50px;">
	<style>#emailForm input{height:30px;}
.arial_cinza2_12 {height: 31px;
font-size: 16px;color:#62a9b3;}

input[type="submit"]{

width: 100px;
margin-left: 64px;
background-color: rgb(48, 133, 154);
color: white;
border: 1px solid silver;
height: 37px;
border-radius: 5px;

}

	input[type="text"],input[type="email"] {height:30px;margin-bottom: 10px;color:#2b829e;border-width:2px;border-radius:6px;border-style: inset;}

select{

color:#2b829e;background-color:white;height: 34px;border-style: inset;border-radius:6px;border-width:2px;
}
	.forms input {width: 80%;height:30px;}
		</style>
<div style="border: 0px solid gray;margin: 0px;background-color:white;overflow:hidden;border-radius: 30px;">

<h1 id="confira" style="margin-left: 17%;color:#62a9b3;width: 60%;">Pré Transferência:</h1>
		
	<center><span id="btnn" style="border: 2px solid gray;border-radius: 7px;background-color: #62a9b3;padding: 8px 10px;margin: 8px;cursor:pointer;font-size: 19px;color:white" onclick="$('.f1 table').show();$('iframe').slideUp();$('#btnn').remove();"></span>
	
	</center><br>
	<!--center><span id="bt_saf" style="border: 2px solid gray;border-radius: 7px;background-color: #62a9b3;padding: 8px 10px;margin: 8px;cursor:pointer;font-size: 19px;color:white;display:none" onclick="$('.f1 table').show();$('#bt_saf').remove();window.open('<?php echo 'http://www.megapedigree.com/painel_kennel/pedcode.php?mobi=2&id_ped='.$idped.'&id_filhote='.($idf+4);?>');">Ver Documento</span>
	
	</center-->

<br><br>
<?php

$hc=14.4;

$wc=22.0;

$qcota=mysql_query("select * from ped_vias2 where id_user=".$idped." and i_filhote=".($idf+4));

$nrq=mysql_num_rows($qcota);

if($nrq>=1 ){

$hc=21.0;

$wc=28.0;

}

?>
<script>
function detectmob() { 
 if( navigator.userAgent.match(/Android/i)
 || navigator.userAgent.match(/webOS/i)
 || navigator.userAgent.match(/iPhone/i)
 || navigator.userAgent.match(/iPad/i)
 || navigator.userAgent.match(/iPod/i)
 || navigator.userAgent.match(/BlackBerry/i)
 || navigator.userAgent.match(/Windows Phone/i)
 ){
    return true;
  }
 else {
    return false;
  }
}

$(document).ready(function(){
$('#bt_saf').show();$('#btnn').remove();$('#confira').css('font-size','');

$('.f1 table').show();$('iframe').remove();$('#btnn').remove();
});
</script>
<iframe id="certi" src="http://www.megapedigree.com/painel_kennel/pedcode.php?id_ped=<?=$idped?>&id_filhote=<?=$idf+4;?>" scrolling="no" style="width: <?=$wc?>cm;
border: 0px none;
height: <?=$hc?>cm;
margin-left: -22px;overflow:hidden;display:none;"></iframe>
<form action="env_trans_pagto_p.php" method="post" class="f1" style="padding-left: 65px;">
			<table width="100%" border="0" cellspacing="6" cellpadding="0" style="display:none">
            
  			  <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Novo Proprietário</label><input type="hidden"></td>
    				<td><input style="width: 80%;" name ="nome" type="text" class="forms" id="login"  required="required"/></td>
			  </tr>
                          <tr>
    				<td align="right"><label for="cpf" class="arial_cinza2_12" >CPF</label></td>
    				<td><input style="width: 80%;" data-mask="999.999.999-99" name ="cpf" id="cepe" type="text" class="forms"  required="required" /></td>
			  </tr>

			  <tr>
    				<td align="right"><label for="data_nascimento" class="arial_cinza2_12" >Data de Nascimento</label></td>
    				<td><input style="width: 80%;" name ="data_nascimento" type="text" class="forms"  required="required" /></td>
			  </tr>


			  <tr>
    				<td align="right"><label for="sexo" class="arial_cinza2_12" >Sexo</label></td>
    				<td><select name="sexo" class=""><option>selecione..</option><option>Masculino</option><option>Feminino</option></select></td>
			  </tr>


			  <tr style="display:none" class="adr">
    				<td align="right"><label for="endereco" class="arial_cinza2_12" >Endereço</label></td>
    				<td><input style="width: 80%;" name ="endereco" type="text" class="forms"  required="required" /></td>
			  </tr>

	  		<tr style="display:none" class="adr">
    				<td align="right"><label for="número" class="arial_cinza2_12" >Número</label></td>
    				<td><input style="width: 80%;" name ="número" type="text" class="forms"  required="required" /></td>
			  </tr>

  			<tr style="display:none" class="adr">
    				<td align="right"><label for="complemento" class="arial_cinza2_12" >Complemento</label></td>
    				<td><input style="width: 80%;" name ="complemento" type="text" class="forms"   /></td>
			  </tr>

  			<tr style="display:none" class="adr">
    				<td align="right"><label for="bairro" class="arial_cinza2_12" >Bairro</label></td>
    				<td><input style="width: 80%;" name ="bairro" type="text" class="forms"  required="required" /></td>
			  </tr>

			<tr style="display:none" class="adr">
    				<td align="right"><label for="cidade" class="arial_cinza2_12" >Cidade</label></td>
    				<td><input style="width: 80%;" name ="cidade" type="text" class="forms"  required="required" /></td>
			  </tr>
			<tr style="display:none" class="adr">
    				<td align="right"><label for="estado" class="arial_cinza2_12" >Estado</label></td>
    				<td><input style="width: 80%;" name ="estado" type="text" class="forms"  required="required" /></td>
			  </tr>

			<tr>
    				<td align="right"><label for="cep" class="arial_cinza2_12" >CEP</label></td>
    				<td><input style="width: 80%;" id="cep" name ="cep" type="text" class="forms"  required="required" onblur="getEndereco();"/></td>
			  </tr>
			<tr>
    				<td align="right"><label for="telefone" class="arial_cinza2_12" >Telefone</label></td>
    				<td><input style="width: 80%;" name ="telefone" type="text" class="forms"   /></td>
			  </tr>
			<tr>
    				<td align="right"><label for="celular" class="arial_cinza2_12" >Celular</label></td>
    				<td><input style="width: 80%;" name ="celular" type="text" class="forms"  required="required" /></td>
			  </tr>
	         	 <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Email</label></td>
    				<td><input style="width: 80%;" name ="email" type="email" class="forms"  required="required" /><input type="hidden"  name="id_ped" value="<?php echo $idped;?>"><input type="hidden"  name="idf" value="<?php echo ($idf);?>"></td>
			  </tr>
  			  <tr style="display:none">
    				<td align="right"><label for="name" class="arial_cinza2_12" ></label></td>
    				<td><b>Dados do Cão:</b></td>
			  </tr>
  			  <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Nome do cão</label></td>
    				<td><input style="width: 80%;" name ="nome_cao" type="text" value="<?=$nome?>" class="forms" id="cc"  required="required" readonly/></td>
			  </tr>
	  		<tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Microchip</label></td>
    				<td><input style="width: 80%;" name ="mic" type="text" value="<?=$mic?>" class="forms" id="ccm"  /></td>
			  </tr>
              
             


          <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" > </label></td>
    				<td> É necessário um email válido para concluir o processo.<br></td>
			  </tr>
          <tr>
                <td align="right">&nbsp;</td>
                <td>
 <br><input name="pc" type="hidden" value="<?=$val?>" ><input type="submit"><br>
                </td>            
              </tr>
              
			</table></form>
  			


</div>
     
    </div> 
    </div>
    <script>

var x='in';
	$('#mae').append('<'+x+'put type="hidden" name="blockme" value="'+Math.random()+'">');	
$("#pagseguro2").submit(function(){

	//$.post('env_trans.php',{prop: $(".f1 input:eq(1)").val(),nome_cao: $(".f1 input:eq(2)").val(),mic: $(".f1 input:eq(3)").val(),end: $(".f1 input:eq(4)").val(),cep: $(".f1 input:eq(5)").val(),tel: $(".f1 input:eq(6)").val(),cpf: $(".f1 input:eq(7)").val(),email: $(".f1 input:eq(9)").val(),id_ped: $(".f1 input:eq(10)").val(),id_f: $(".f1 input:eq(11)").val()},function(data){alert('Verifique o email após o pagamento.');return true;});
	//return false;
	$('#apg').remove();

});
	
</script>




</script>
    <?php include "includes/informacoes.php"; ?>    

<script>
function verifica(){
	var microchip = document.getElementById("microchip").value;
	var verifica = microchip.substring(0,3);
	if (verifica !=981&&verifica !=963){
		alert("Favor corrigir o número do microchip");
	}
	if (verifica ==981||verifica ==963){
		$('#qrcode').removeAttr('readonly');
	}
}

function verifica_qrcode(){
var qrcode = document.getElementById("qrcode").value;
if(qrcode=='' || qrcode==' ' ){
alert ("QRCODE inválido");	
}
else{
		$('input').removeAttr('readonly');
}
}


   $("input[name=cpf]").mask("999.999.999-99");
   $("input[name=data_nascimento]").mask("99/99/9999");
   $("input[name=cep]").mask("99999-999");
$('input[name=telefone]').mask("(99) 9999-9999?");
$('input[name=celular]').mask("(99) 9999-99999")

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
$('#cepe').blur(function(){
var cepe=$('#cepe').val();
//cepe=cepe.replace('.','');
//cepe=cepe.replace('-','');
if (vc(cepe)==false)$('#cepe').val('').focus();

});
</script>    
 
 </div>
</div>
<?php //include "includes/footer.php";?>
</body>
</html>
