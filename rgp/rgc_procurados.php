<?php
session_start();
require_once("Connections/conexao.php");

$resultado = "";

$query=mysql_query("SELECT * 
FROM `procurado` 
JOIN rgc 
USING ( id ) 
WHERE 1 ")or die('ddd');




?><!DOCTYPE html>
<head>
<meta charset="utf-8"> 
<meta name="keywords" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote" /> 
<meta name="description" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote"/>
<meta name="Abstract" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote" />
<meta property="og:type" content="product"/>
<meta property="og:title" content="SOBRACI - Sociedade Brasileira de Cinofilia Independente - Registro Pedigree Cães - Cachorro - Filhotes"/>
<meta property="og:image" content="http://www.sobraci.org/images/logo_header.png"/>
<meta property="og:site_name" content="SOBRACI - Sociedade Brasileira de Cinofilia Independente - Registro Pedigree Cães - Cachorro - Filhotes" />
<meta property="og:description" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote" />
<meta http-equiv="Content-Language" content="pt-br">
<meta name="resource-type" content="document" />
<meta http-equiv="pragma" content="no-cache" />
<meta name="revisit-after" content="1" />
<meta name="robots" content="ALL" />
<meta name="distribution" content="Global" />
<meta name="rating" content="General" />
<meta name="classification" content="Internet">
<meta name="doc-class" content="Completed">
<meta name="doc-rights" content="Public">



<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="shortcut icon" href="favicon.png" />
<title>::. RGpet .::</title>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed">
<?php //include "includes/header.php";?>

	<script src="js/jquery-1.9.1.js"></script>
	<script src="js/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="cep.js"></script>
    	<script src="js/jquery.maskedinput.js"></script>
<script>
onkeydown="$('input').removeAttr('');"

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
</script>



<div class="internas_full">
 <div class="internas_margem_full" style="width:100%"> 
 
 	<div class="internas_box" style="width:80%;margin-left: 5%;margin-right: 5%;">
      <!--div class="internas_titulo">RG Digital<?php //echo $l['rgc_titulo']; ?></div-->
    <div class="arial_cinza1_11" style="margin-top:50px;">
        
	<style>#emailForm input{width: 100%;
height: 22px;
padding: 4px;
margin: 11px;}
.hid{ display:none}

.PERDIDO {margin: 10px;background-color:#058b05}

.FURTADO {margin: 10px;background-color:#f3760f}

.ROUBADO {margin: 10px;background-color:#ff0505}

.FUGIU {margin: 10px;background-color:#3890a8}

.PERDIDO_b {color:#058b05}

.FURTADO_b {color:#f3760f}

.ROUBADO_b {color:#ff0505}

.FUGIU_b {color:#3890a8}




</style><div style="border: 2px solid white;background-color:#BADA55;opacity:0.90;border-radius:20px">
<form method="post" name="emailForm" id="emailForm"  style="margin: 22px 11%;display: block;
overflow: hidden;">

<?php

$vs['M']='Macho';

$vs['F']='Femea';

while($l=mysql_fetch_assoc($query)){
	echo "<div class='".strtoupper($l['ocorrencia'])."' style=\"padding: 5px;
float: left;
border-radius: 30px;
overflow: hidden;
height: 320px;\">
<center style='background-color: white;
width: 190px;
height: 290px;
overflow: hidden;
font-size: 22px;
border-radius: 25px;
display: block;
padding-bottom: 25px;
margin-bottom: -37px;
padding-top: 5px;'><b class='".strtoupper($l['ocorrencia'])."_b'>".$l['ocorrencia']."</b>
<span style='color:green;font-size:14px'><br>RG ".$l['id']."<div style='height: 100px;
display: block;
overflow: hidden;
margin-bottom: -10px;
width: 145px;'><img style='width:190px;margin-left: -26px;' src=\"".$l['foto']."\"></div><br><center style='background-color:white;color:black;width: 180px;'>".$l['tipo'].'<br>'.$l['raca'].' '.$vs[$l['sexo']].'<br>Local: '.substr($l['endereco'],0,15)."<br>".$l['cidade']."-".$l['estado']."</span>
<a class='".strtoupper($l['ocorrencia'])."' style='display: block;
padding: 10px;
width: 113px;
border-radius: 5px;color:white;text-decoration:none;font-weight: bolder;box-shadow: 3px 3px 3px gray;' href='mailto:".$l['email']."'>INFORMAR</a>
<span style='background-color:white;width: 180px;font-size:14px'><b>".$l['Obs']."</b></span>
</center>
</div>
";
}

?>

                </form></div>
     
    </div> 
    </div>
    <script>

var x='in';
	$('#mae').append('<'+x+'put type="hidden" name="blockme" value="'+Math.random()+'">');	
	
<?php echo $resultado;?></script>

<script>
document.getElementById("enviar").disabled = true; 

function habilita(){

}

	document.getElementById("enviar").disabled=false;
</script>
    <?php //include "includes/informacoes.php"; ?>    

<script>

   $("input[name=cpf]").mask("999.999.999-99");
   $("input[name=cep]").mask("99999-999");
$('#cepe').blur(function(){
var cepe=$('#cepe').val();
//cepe=cepe.replace('.','');
//cepe=cepe.replace('-','');
if (vc(cepe)==false)$('#cepe').val('').focus();

});

function verifica(){
	var microchip = document.getElementById("microchip").value;
	var verifica = microchip.substring(0,3);
	if (verifica !=981&&verifica !=963){
		alert("Favor corrigir o número do microchip");
	}
	if (verifica ==981||verifica ==963){
		$('#qrcode').removeAttr('');
	}
}

function verifica_qrcode(){
var qrcode = document.getElementById("qrcode").value;
if(qrcode=='' || qrcode==' ' ){
alert ("QRCODE inválido");	
}
else{
		$('input').removeAttr('');
}
}
</script>    
 
 </div>
</div>
<?php //include "includes/footer.php";?>
</body>
</html>
