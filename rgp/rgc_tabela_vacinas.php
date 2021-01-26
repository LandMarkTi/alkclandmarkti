<?php
require_once("Connections/conexao.php");
session_start();
$resultado = "";


?><!DOCTYPE html>
<head>
<meta charset="utf-8"> 
<meta name="keywords" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote" /> 
<meta name="description" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote"/>
<meta name="Abstract" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote" />
<meta property="og:type" content="product"/>
<meta property="og:image" content="http://www.alkc.org/images/logo_header.png"/>
<meta property="og:site_name" content="alkc  - Registro Pedigree Cães - Cachorro - Filhotes" />
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
<title>::. Alkc .::</title>

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

.mesma{ display:inline-block;width: 40%;color:gray;margin-left: 40px;}
.br{ display:block;color:gray;margin-left: 40px;}

hr {

height: 3px;
color: gray;
background-color: #6ba9aa;
}

#oval { width: 53px; height: 48px;color: white; background: #6ba9aa; -moz-border-radius: 50px / 25px; -webkit-border-radius: 50px / 25px; border-radius: 50px / 25px;padding-left: 42px;display:block;margin-left: 42%; }

.parte1{width: 70%;
padding-left: 15px;}
</style><div style="border: 2px solid white;background-color:white;opacity:0.90;border-radius:20px">
<form method="post" action="rgc_add_vacina.php" name="emailForm" id="emailForm" enctype="multipart/form-data" style="margin-left: 5%;margin-right: 10%;margin-top: 29px;">
<H1 style="color: white;
opacity: 1;
font-size: 22px;
background-color: #6ba9aa;
border: 3px solid #6ba9aa;
padding: 5px;
border-radius: 5px;">Carteira de Vacinação Digital </h1>
<br>
RG PET:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CRMV:<br>
                <input type="text" name="nome" id="nome" size="30" style="width: 37%" value="<?=$_SESSION['cid']?>" 	readonly required>
                

<?php

$id=(int)$_SESSION['cid'];

$sql = "SELECT * FROM pedigre_trocados_capa WHERE id_trans_capa=$id";
$query = mysql_query($sql) or die(mysql_error());
$linha = mysql_fetch_array($query);


if($linha['id_trans_capa']>0){

$q_dog=mysql_query("select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$linha['id_ped']);
$ld = mysql_fetch_array($q_dog);



$sql_add="select * from criadores where id_criador=".$ld['id_criador'];
$qr_criador=mysql_query($sql_add);
$fc=mysql_fetch_assoc($qr_criador);





$nome=explode(';',$ld['ninhada']);



if($fc['uso_canil']=='sulfixo')$sulf=' '.$fc['nome_completo'].' '; else $pref=' '.$fc['nome_completo'].' ';


$nomedog=$pref.$nome[$linha['id_f']].$sulf;

$c=explode(';',$ld['cor']);
$cor=$c[$linha['id_f']-4];

$s=explode(';',$ld['sexo']);

$ss=$s[$linha['id_f']-4];

$rac=$ld['nomeSubcategoria'];


$vp=explode(';',$ld['parentes']);

//
$pai=$vp[0];

$mae=$vp[1];

}

?>
				<input type="text" name="crmv" id="qrcode" size="6" style="width: 37%;margin-left: 68px;" value="<?php echo $ld['amigo'];?>" ><br>
	
         <br>
				Nome do animal:
                <br>
                <input type="text" name="nome_cao" id="nome_cao" style="width: 90%;padding-left: 15px;" size="30" value="<?php echo $nomedog;?>" ><br>
				Microchip: 
                <br>
                <input type="text" name="microchip" id="microchip" style="width: 90%;padding-left: 15px;" size="30" value="<?php echo $linha['mic'];?>" ><br>
				 Data de Nascimento: 
                <br>
                <input type="text" name="nascimento" id="nascimento" style="width: 90%;padding-left: 15px;" size="30" value="<?php echo date('d/m/Y',$ld['nasc']); ?>" >                
<br>
  Raça: 
                <br>
                <input type="text" name="raca" id="raca" style="width: 90%;padding-left: 15px;" size="30" value="<?php echo $rac;?>" >                                
<br>
  Sexo: 
                <br>
                <input type="text" name="sexo" id="sexo" style="width: 90%;padding-left: 15px;" size="30" value="<?php echo $ss;?>" >                                
<br>
  Cor: 
                <br>
                <input type="text" name="cor" id="cor" style="width: 90%;padding-left: 15px;" size="30" value="<?php echo $cor;?>" ><br>                                                
			Tipo<br>
				<input type="text" name="qrcode" id="qrcode" style="width: 90%;padding-left: 15px;" size="6" value="<?php echo 'canino';?>" ><br>
				
             

<H1 style="color: white;
opacity: 1;
font-size: 22px;
background-color: #6ba9aa;
border: 3px solid #6ba9aa;
padding: 5px;
border-radius: 5px;page-break-before: always;margin-top: 30px;">Listagem de Vacinas </h1>
<br>
<?php


$q_v=mysql_query("select * from vacinas where id=".$_SESSION['cid']);

while($l=mysql_fetch_assoc($q_v)){
?>


		<div class="br">
			<div class="mesma" style="position: relative;top: -22px;">
		        Data de Aplicação:<br>
		        <input type="date" name="aplicacao" size="30" value="<?=date("d/m/Y",$l['data_aplicacao'])?>" >                
		        </div><div class="mesma">
		        Tipo/Marca/Lote:<br>
		        <textarea name="lote" cols="25" rows="3" required><?=$l['tipo_marca_lote']?></textarea>                                
		        </div>
		</div>

		<div class="br">
			<div class="mesma" style="position: relative;top: -22px;">
		        Revacinar:<br>
		        <input type="date" name="aplicacao" size="30" value="<?=date("d/m/Y",$l['data_revac'])?>" >                
		        </div><div class="mesma">
		        Responsável:<br>
		        <textarea name="responsavel" cols="25" required><?=$l['Resp_tec']?></textarea>                                
		        </div>
		</div>

<hr style="page-break-before: always;"><br>
<? }?>
		

                <input type="submit" value="Imprimir" onclick="window.location='imprime_cartao/vacinas.php?id=<?=$_SESSION['cid']?>';return false;" style="height: 40px;margin-top:20px;display: inline;width: 45%;" id="enviar">
                <input type="submit" value="Nova Vacina" onclick="location='rgc_add_vacina.php';return false;" style="height: 40px;margin-top:20px;display: inline;width: 45%;" id="enviar">
		<br><br>
<span id="oval">
<p style="font-weight: bold;margin-left: -11px;padding-top: 14px;">voltar</p>
</span>
                </form></div>
     
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
