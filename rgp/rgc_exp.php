<?php
session_start();
require_once("Connections/conexao.php");

$resultado = "";

if($_SESSION['pid']=='')die("<script>location='rgc_login.php';</script>");
$id=$_SESSION['pid'];

$sql = "SELECT * FROM exp WHERE id=$id";
$query = mysql_query($sql) or die(mysql_error());
$linha = mysql_fetch_array($query);

if($_POST){





$abre = addslashes($_POST['abre_util']);

$fecha = addslashes($_POST['fecha_util']);

$afds = addslashes($_POST['abre_fds']);

$ffds = addslashes($_POST['fecha_fds']);


//print_r($_POST);

$sql = "UPDATE `rgpet`.`exp` SET `abre_util` = '$abre', `fecha_util` = '$fecha', `abre_fds` = '$afds', `fecha_fds` = '$ffds' WHERE `exp`.`id` =$id ";  

$query2 = mysql_query($sql) or die('o');

echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=rgc_menu_clinica.php'>";
die();



}
?><!DOCTYPE html>
<head>
<meta charset="utf-8"> 
<meta name="keywords" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote" /> 
<meta name="description" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote"/>
<meta name="Abstract" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote" />
<meta property="og:type" content="product"/>
<meta property="og:title" content=" - Sociedade Brasileira de Cinofilia Independente - Registro Pedigree Cães - Cachorro - Filhotes"/>
<meta property="og:image" content="http://www..org/images/logo_header.png"/>
<meta property="og:site_name" content=" - Sociedade Brasileira de Cinofilia Independente - Registro Pedigree Cães - Cachorro - Filhotes" />
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

    <div class="arial_cinza1_11" style="margin-top:22px;">
        
	<style>#emailForm input{width: 100%;
height: 22px;
padding: 4px;
margin: 11px;}
.hid{ display:none}

 #oval { width: 53px; height: 48px;color: white; background: #428F25; -moz-border-radius: 50px / 25px; -webkit-border-radius: 50px / 25px; border-radius: 50px / 25px;padding-left: 42px;display:block;margin-left: 42%; }
</style><div style="border: 2px solid white;background-color:whiteSmoke;opacity:0.90;border-radius:20px">
<form method="post" name="emailForm" id="emailForm" enctype="multipart/form-data" style="margin-left: 5%;margin-right: 10%;margin-top: 29px;">
<H1 style="color:#428F25;opacity:1;font-size: 20px;">Editar Expediente </h1>

		Hora de Abertura(seg-sex): <br>
                <input type="time" name="abre_util" id="nome" size="30" value="<?php echo $linha['abre_util'];?>" >
                <br>
               Fechamento(seg-sex):<br>
                <input type="time" name="fecha_util" id="rg" size="30" value="<?php echo $linha['fecha_util'];?>" >                
                <br>
                Hora de Abertura(final de semana): <br>
                <input type="time" name="abre_fds" id="nome" size="30" value="<?php echo $linha['abre_fds'];?>" >
                <br>
               Fechamento(final de semana):<br>
                <input type="time" name="fecha_fds" id="rg" size="30" value="<?php echo $linha['fecha_fds'];?>" >                
                <br>
                
                <input type="hidden" id="id_ped" name="id_ped" value="<?php echo $id; ?>">

                <input type="submit" value="Enviar" style="height: 40px;margin-top:20px" id="enviar">
		<br>
                </form>

<span id="oval">
<p style="font-weight: bold;margin-left: -11px;padding-top: 14px;">voltar</p>
</span>
</div>
     
    </div> 
    </div>
    <script>

var x='in';
	$('#mae').append('<'+x+'put type="hidden" name="blockme" value="'+Math.random()+'">');	
	
<?php echo $resultado;?></script>

<script>

$('#oval').click(function(){history.go(-1);});
$('#oval').css('cursor','pointer');
function habilita(){
if (document.getElementById("enviar").disabled==true){
	document.getElementById("enviar").disabled=false;
}else{
	document.getElementById("enviar").disabled = true;
}
}


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
