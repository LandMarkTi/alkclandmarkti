<?php
require_once("Connections/conexao.php");
session_start();
$resultado = "";



$q_cli=mysql_query("SELECT * from med_vet2 where id=".$_SESSION['pid'])or die('eec');
$d_cli=mysql_num_rows($q_c);
$f_cli=mysql_fetch_assoc($q_cli);

//die($f_cli['crmv_med']);

if($_POST){

}

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


<?php
	$sql = "select * from rgc where crmv='".$f_cli['crmv_med']."' order by id asc";
	$qr_p = mysql_query($sql) or die ('-');



	
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

#oval { width: 53px; height: 48px;color: white; background: #428F25; -moz-border-radius: 50px / 25px; -webkit-border-radius: 50px / 25px; border-radius: 50px / 25px;padding-left: 42px;display:block;margin-left: 42%; }


.mesma{ display:inline-block;width: 20%;height:20px}
.mesma img{float:right}

.branco{background:white}
.br{ display:block;}
</style><div style="border: 2px solid white;background-color:whiteSmoke;opacity:0.90;border-radius:20px">
<form method="post"  name="emailForm" id="emailForm" style="margin-left: 5%;margin-right: 10%;margin-top: 29px;">
<H1 style="color:#428F25;opacity:1;font-size: 27px;">Cadastro de Clientes </h1>
<br>
                <input type="hidden" name="id_ped" id="nome" size="30" value="<?=$_SESSION['cid']?>" required readonly>
                <br>

		<div class="br branco">
			<div class="mesma" style="">
		        nome 
		                       
		        </div><div class="mesma" style="min-width: 110px;">
		        tel
		                       
		        </div>
			<div class="mesma">
		        tipo
		                       
		        </div>
		</div>
<br>
<?php 
$par=0;
while($l=mysql_fetch_assoc($qr_p)){

if($par%2==0)$branco='branco';else $branco='';
?>
		<div class="br">
			<div class="mesma <?=$branco?>" style="">
		        
		        <?=$l['nome']?>               
		        </div><div class="mesma <?=$branco?>" style="min-width: 110px;">&nbsp;<?=$l['tel_res']?>
		        </div><div class="mesma <?=$branco?>" style="width: 48%;">
		        <?=$l['tipo']?><a target="_new" href="../ver_carteirinha.php?id=<?=$l['id']?>"><img width="15px" src="http://megapedigree.com/painel_geral_123/images/icons/Note-icon.png"></a> <a target="new" href="imprime_cartao/imprime.php?id=<?=$l['id']?>"><img src="http://megapedigree.com/painel_geral_123/images/icons/print.png"></a>
			<a href="rgc_edit_l.php?c_id=<?=$l['id']?>" style="float:right"> + </a>             
		        </div>
		</div>
<?php $par++;}?>


		<input type="hidden" name ="cr" value="<?=$_GET['crmv']?>">
                <input type="submit" value="Novo Cliente" style="height: 40px;margin-top:20px" onclick="location='rgc_demo.php';return false;" id="enviar">
		<br><br>
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
