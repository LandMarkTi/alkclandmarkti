<?php
session_start();
require_once("Connections/conexao.php");

$resultado = "";

if($_SESSION['cid']=='')die("<script>location='rgc_login.php';</script>");
$id=$_SESSION['cid'];

$sql = "SELECT * FROM rgc WHERE id=$id";
$query = mysql_query($sql) or die(mysql_error());
$linha = mysql_fetch_array($query);

if($_POST){

mysql_query("delete from procurado where id=".$id);
$s=addslashes(strip_tags($_POST['status']));

$o=addslashes(strip_tags($_POST['obs']));

if($_POST['status']!='0')mysql_query("insert into procurado values ('','$s',".time().",".$_SESSION['cid'].",'$o')")or die('m');
echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=rgc_menu.php'><script>alert('Alerta enviado.');</script>>";
die();

}




?><!DOCTYPE html>
<head>
<meta charset="utf-8"> 
<meta name="keywords" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote" /> 
<meta name="description" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote"/>
<meta name="Abstract" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote" />
<meta property="og:type" content="product"/>
<meta property="og:title" content=" - Registro Pedigree Cães - Cachorro - Filhotes"/>
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
 <div class="internas_margem_full" style="width:70%"> 
 
 	<div class="internas_box" style="width:80%;margin-left: 5%;margin-right: 5%;">
      <!--div class="internas_titulo">RG Digital<?php //echo $l['rgc_titulo']; ?></div-->
    <div class="arial_cinza1_11" style="margin-top:50px;">
        
	<style>#emailForm input{width: 58%;
height: 22px;
padding: 4px;
margin: 11px;
font-size: 11px;
border: 2px solid #6ba9aa;
border-radius: 5px;
}
textarea {border: 2px solid #6ba9aa;
border-radius: 5px;
overflow:hidden;}
.hid{ display:none}

.mesma{ display:inline-block;width: 40%;color:#6ba9aa;}
.br{ display:block;color:#6ba9aa;}

hr {

height: 3px;
color: #6ba9aa;
background-color: #6ba9aa;
}



 #oval { width: 53px; height: 48px;color: white; background: #6ba9aa; -moz-border-radius: 50px / 25px; -webkit-border-radius: 50px / 25px; border-radius: 50px / 25px;padding-left: 42px;display:block;margin-left: 42%; }
</style><div style="border: 2px solid white;background-color:white;opacity:0.90;border-radius:20px">
<form method="post" name="emailForm" id="emailForm" enctype="multipart/form-data" style="margin-left: 5%;margin-right: 10%;margin-top: 29px;">
<H1 style="color: white;
opacity: 1;
font-size: 22px;
background-color: #6ba9aa;
border: 3px solid #6ba9aa;
padding: 5px;
border-radius: 5px;">Alerta ALKC </h1>

Estado do Pet: 
<select name="status" style="margin-left: 35px;width: 179px;height: 33px; border-radius: 5px;"><option value="0">Encontrado</option><option value="PERDIDO">Perdido</option><option value="ROUBADO">Roubado</option><option value="FURTADO">Furtado</option><option value="Fugiu">Fugiu</option></select>
             
<br>            
<br>
Observação: 
                <input type="text" name="obs" placeholder="ex: criança doente, recompensa em especie" maxlength="18"><br>
	<center><input type="submit" value="Enviar" style="height: 40px;margin-top:20px;margin-left: 10px;" id="enviar"></center>
		<br>
<span id="oval">
<p style="font-weight: bold;margin-left: -11px;padding-top: 14px;">voltar</p>
</span>
<br>
                </form></div>
     
    </div> 
    </div>
    <script>

var x='in';
	$('#mae').append('<'+x+'put type="hidden" name="blockme" value="'+Math.random()+'">');	
	
<?php echo $resultado;?></script>

<script>


function habilita(){
if (document.getElementById("enviar").disabled==true){
	document.getElementById("enviar").disabled=false;
}else{
	document.getElementById("enviar").disabled = true;
}
}

$('#oval').click(function(){history.go(-1);});
$('#oval').css('cursor','pointer');
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
