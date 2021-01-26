<?php
require_once("Connections/conexao.php");
session_start();
$resultado = "";


if(isset($_GET['crmv'])) {
$cr=trim($_GET['crmv']);
$q_vet=mysql_query("select * from med_vet2 where crmv_med='C".$cr."' or crmv_med='L".$cr."' ");
$nv=mysql_num_rows($q_vet);
$lm=mysql_fetch_assoc($q_vet);

if($nv<1)die("<script>alert('CRMV SEM REGISTRO');location='rgc_vet.php';</script>");
}


if($_POST){

$id_ped=$_POST['id_ped'];
$apl=mktime ( '00', '00', '00', substr($_POST['aplicacao'],3,2), substr($_POST['aplicacao'],0,2), substr($_POST['aplicacao'],6,4) );
$revac=mktime ( '00', '00', '00', substr($_POST['revacinar'],3,2), substr($_POST['revacinar'],0,2), substr($_POST['revacinar'],6,4) );
$med=addslashes($_POST['responsavel']);
$vac=addslashes($_POST['lote']);
$crmv=$_POST['cr'];
mysql_query("INSERT INTO `vacinas` (`id_vac`, `id`, `data_aplicacao`, `data_revac`, `Resp_tec`, `tipo_marca_lote`, `id_med`) VALUES (NULL, '$id_ped', '$apl', '$revac', '$med', '$vac', '$crmv');");

die("<script>location='rgc_menu.php'</script>");

}

?><!DOCTYPE html>
<head>
<meta charset="utf-8"> 
<meta name="keywords" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote" /> 
<meta name="description" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote"/>
<meta name="Abstract" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote" />
<meta property="og:type" content="product"/>
<meta property="og:title" content="alkc  -  - Registro Pedigree Cães - Cachorro - Filhotes"/>
<meta property="og:image" content="http://www.alkc .org/images/logo_header.png"/>
<meta property="og:site_name" content="alkc  - - Registro Pedigree Cães - Cachorro - Filhotes" />
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


<?php
	$sql = "select * from paginas_internas";
	$query = mysql_query($sql) or die (mysql_error());
	$l = mysql_fetch_array($query);
	?>
<div class="internas_full">
 <div class="internas_margem_full" style="width:100%"> 
 
 	<div class="internas_box" style="width:80%;margin-left: 5%;margin-right: 5%;">
      <!--div class="internas_titulo">RG Digital<?php //echo $l['rgc_titulo']; ?></div-->
    <div class="arial_cinza1_11" style="margin-top:50px;">
        
	<style>#emailForm input{width: 40%;
height: 22px;
padding: 4px;
margin: 11px;}
.hid{ display:none}

.mesma{ display:inline-block;width: 40%;}
.br{ display:block;}


 #oval { width: 53px; height: 48px;color: white; background: #6ba9aa; -moz-border-radius: 50px / 25px; -webkit-border-radius: 50px / 25px; border-radius: 50px / 25px;padding-left: 42px;display:block;margin-left: 42%; }


</style><div style="border: 2px solid white;background-color:white;opacity:0.90;border-radius:20px">
<form method="post"  name="emailForm" id="emailForm" enctype="multipart/form-data" style="margin-left: 5%;margin-right: 10%;margin-top: 29px;">
<H1 style="color:#6ba9aa;opacity:1;font-size: 27px;">Nova Vacina </h1>
<br>
RG PET: &nbsp;&nbsp;
                <input type="text" name="id_ped" id="nome" size="30" value="<?=$_SESSION['cid']?>" required readonly>
                <br><br>

		<div class="br">
			<div class="mesma" style="position: relative;top: -22px;">
		        Data de Aplicação:<br>
		        <input type="date" name="aplicacao" size="30" value="" required>                
		        </div><div class="mesma">
		        Tipo/Marca/Lote:<br>
		        <textarea name="lote" cols="25" required></textarea>                                
		        </div>
		</div>

		<div class="br">
			<div class="mesma" style="position: relative;top: -22px;">
		        Revacinar:<br>
		        <input type="date" name="revacinar" size="30" value="" >                
		        </div><div class="mesma">
		        Responsável:<br>
		        <textarea name="responsavel" cols="25" required><?=$lm['nome_med']."\nCRMV:".$lm['crmv_med'];?></textarea>                                
		        </div>
		</div>
		<input type="hidden" name ="cr" value="<?=$_GET['crmv']?>">
                <input type="submit" value="enviar" style="height: 40px;margin-top:20px" id="enviar">
		<br>

<br>
                </form></div>
     <span id="oval">
<p style="font-weight: bold;margin-left: -11px;padding-top: 14px;">voltar</p>
</span>
    </div> 
    </div>
    <script>

var x='in';
	$('#mae').append('<'+x+'put type="hidden" name="blockme" value="'+Math.random()+'">');	
	
<?php echo $resultado;?></script>

<script>
//document.getElementById("enviar").disabled = true; 

function habilita(){
if (document.getElementById("enviar").disabled==true){
	document.getElementById("enviar").disabled=false;
}else{
	document.getElementById("enviar").disabled = true;
}
}

<?php

if(!isset($_GET['crmv'])) {

?>

var p= prompt('Digite o código CRMV:');

location='rgc_add_vacina.php?crmv='+p;
<?php

}
?>
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


$('#oval').click(function(){history.go(-1);});
$('#oval').css('cursor','pointer');
</script>    
 
 </div>
</div>
<?php //include "includes/footer.php";?>
</body>
</html>
