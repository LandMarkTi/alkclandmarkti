<?php
session_start();
require_once("Connections/conexao.php");

$resultado = "";

if($_POST){

	
$email = addslashes($_POST['email']);
$sn = md5($_POST['senha']);

$q_l=mysql_query("SELECT * FROM `pedigre_trocados_capa` WHERE `email_t`='".$email."' and rastreio='".$sn."' ")or die('eer');
$d_l=mysql_num_rows($q_l);


if($d_l>=1){
echo "<script>location='rgc_menu.php';</script>";

$dados=mysql_fetch_assoc($q_l);
$_SESSION['login'] = $email;
$_SESSION['cid']= $dados['id_trans_capa'];
//echo "<meta HTTP-EQUIV='Refresh' CONTENT='1;URL=rgc_menu.php'>";die();
}else {
echo "<meta HTTP-EQUIV='Refresh' CONTENT='1;URL=rgc_login2.php'>Senha Incorreta";die();

}
die();






}
?><!DOCTYPE html>
<head>
<meta charset="utf-8"> 
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
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" style="max-width: 25cm;">
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


<?php

	?>
<center></center>
<div class="internas_full">
 <div class="internas_margem_full" style="width:70%"> 
 
 	<div class="internas_box" style="width:80%;margin-left: 5%;margin-right: 5%;">
      <!--div class="internas_titulo">RG Digital<?php //echo $l['rgc_titulo']; ?></div-->
    <div class="arial_cinza1_11" style="margin-top:0px;">
        
	<style>#emailForm input{width: 100%;
height: 22px;
padding: 4px;
margin: 11px;
border-radius: 5px;
color: #6ba9aa}
.hid{ display:none}
</style><div style="border: 2px solid white;background-color:white;opacity:0.90;border-radius:20px">
<form method="post" name="emailForm" id="emailForm"  style="margin-left: 5%;margin-right: 10%;margin-top: 29px;">
<H1 style="color:#6ba9aa;opacity:1;font-size: 27px;">Login do Proprietário </h1>
<br>
 <br>
                <input type="text" name="email" id="nome" size="30" value="" placeholder="Email" required>
                <br>
                <br>
                <input type="password" name="senha" id="rg" size="30" placeholder="Senha" value="" >                
                <br> <br>
                
                <input type="submit" value="Enviar" style="height: 40px;width:50%;float:right;background-color: #6ba9aa;border-radius: 0px;
color: white;
border: 1px solid silver;margin:0px
" id="enviar">
		<br><br><img src="atalho.png" style="cursor:pointer;" onclick="location='/site/b_kennel_t.php'">
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
