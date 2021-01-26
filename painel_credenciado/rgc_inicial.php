<?php
require_once("Connections/conexao.php");

$resultado = "";

if($_POST){

$fotonome = $_FILES['foto']['name'];
$fototipo = $_FILES['foto']['type'];
$fototamanho = $_FILES['foto']["size"];
$fototemp = $_FILES['foto']['tmp_name'];
	
$nome = addslashes($_POST['nome']);
$rg = addslashes($_POST['rg']);
$cpf = addslashes($_POST['cpf']);
$endereco = addslashes($_POST['endereco']);
$bairro = addslashes($_POST['bairro']);
$cidade = addslashes($_POST['cidade']);
$estado = addslashes($_POST['estado']);
$cep = addslashes($_POST['cep']);
$tel_res = addslashes($_POST['tel_res']);
$tel_com = addslashes($_POST['tel_com']);
$celular = addslashes($_POST['celular']);
$email = addslashes($_POST['email']);
$foto = "../rgc/".$fotonome;
$nome_cao = addslashes($_POST['nome_cao']);
$microchip = addslashes($_POST['microchip']);

$qrcode = addslashes($_POST['qrcode']);

$nascimento = $_POST['nascimento'];
$nascimento = implode("-",array_reverse(explode("/",$nascimento)));

$raca = addslashes($_POST['raca']);
$sexo = addslashes($_POST['sexo']);
$cor = addslashes($_POST['cor']);
$pai = addslashes($_POST['pai']);
$mae = addslashes($_POST['mae']);	

$sql = "insert into rgc (id,nome,rg,cpf,endereco,bairro,cidade,estado,cep,tel_res,tel_com,celular,email,foto,nome_cao,microchip,nascimento,raca,sexo,cor,pai,mae,pago, qrcode) values ('','$nome', '$rg', '$cpf', '$endereco', '$bairro', '$cidade', '$estado', '$cep', '$tel_res', '$tel_com', '$celular', '$email', '$foto', '$nome_cao', '$microchip', '$nascimento', '$raca', '$sexo', '$cor', '$pai' ,'$mae','0','$qrcode')";
$query = mysql_query($sql) or die (mysql_error());

if($fotonome!=''&&$fototamanho<3000000){
move_uploaded_file($fototemp,'../rgc/'.$fotonome);
$resultado = "alert('RGC Enviado');";
}

if($fototamanho>3000000){$resultado = "alert('Arquivo enviado passou do limite de 3MB!');";
echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=rgc.php'>";
}

$sql = "select id from rgc where nome='$nome' and qrcode='$qrcode' order by id desc";
$query = mysql_query($sql) or die (mysql_error());
$l = mysql_fetch_array($query);
$id_rgc = $l[0];

$sql = "insert into qrcode (id_code,id_ped,id_filhote,qrcode) values ('','$id_rgc',0,'$qrcode')";
$query = mysql_query ($sql) or die (mysql_error());
}
?><!DOCTYPE html>
<head>
<meta charset="utf-8"> 
<meta name="keywords" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote" /> 
<meta name="description" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote"/>
<meta name="Abstract" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote" />
<meta name="copyright" content="Neoware Criação e Desenvolvimento de Websites e Sistemas - www.neoware.com.br" />
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
<meta name="url" content="http://www.sobraci.org"> 
<meta name="author" content="Neoware Criação e Desenvolvimento de Websites e Sistemas - www.neoware.com.br" />

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="shortcut icon" href="favicon.png" />
<title>::. SOBRACI - Sociedade Brasileira de Cinofilia Independente - Registro Pedigree Cães - Cachorro - Filhotes .::</title>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed">
<?php include "header.php";?>
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
    
<script>
onkeydown="$('input').removeAttr('');"
</script>

<script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox();
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});
		});
</script>
<?php
	$sql = "select * from paginas_internas";
	$query = mysql_query($sql) or die (mysql_error());
	$l = mysql_fetch_array($query);
	?>
<?php include "menu_esquerdo.php";?> 
<div class="internas_full">
 <div class="internas_margem_full">
 
 	<div class="internas_box">
      <div class="internas_titulo">


</div>
    <div class="arial_cinza1_11" style="margin-top:50px;">
        <?php
	echo $l['rgc']."<p></p>";	
	if($l['rgc_foto1']!="" or $l['rgc_foto2']!="" or $l['rgc_foto3']!=""){
echo "		<p style='min-height:200px;'>";
	if($l['rgc_foto1']!=""){
	echo "<img src='".$l['rgc_foto1']."' align='left' width='240' height='210' style='margin-right:15px;'>";}
	 
	if($l['rgc_foto2']!=""){
	echo "<img src='".$l['rgc_foto2']."' align='left' width='240' height='210' style='margin-right:15px;'> ";}	 
	
	if($l['rgc_foto3']!=""){
	echo "<img src='".$l['rgc_foto3']."' align='left' width='240' height='210'> ";}	
	echo "</p>";
	}
	?>
	<style>#emailForm input{width: 420px}</style><div style="border: 2px solid gray;margin: 21px;background-color:whiteSmoke">
<form method="post" name="emailForm" id="emailForm" enctype="multipart/form-data" style="margin-left: 143px;margin-top: 69px;">
<H1 >Formulário RGC </h1>
Microchip<br>
<input type="text" value="" name="microchip" id="microchip" onClick="this.value='';" >
<br>
QRCODE<br>
<input type="text" name="qrcode" id="qrcode" maxlength="6"  onBlur="verifica_qrcode()" ><br>
Nome completo: <br>
                <input type="text" name="nome" id="nome" size="30" value="" >
                <br>
                RG:<br>
                <input type="text" name="rg" id="rg" size="30" value="" >                
                <br>
                CPF:<br>
                <input type="text" name="cpf" id="cpf" size="30" value="" >                                
                <br>
				CEP:<br>
                <input type="text" name="cep" id="cep" size="30" value="" onblur="getEndereco();" >                
				<br>
                Endereço:<br>
                <input type="text" name="endereco" id="endereco" size="30" value="" >                                                
                <br>
                Bairro:<br>
                <input type="text" name="bairro" id="bairro" size="30" value="" >   <br>                                                             
               Cidade:<br>
                <input type="text" name="cidade" id="cidade" size="30" value="" ><br>
				Estado:<br>
                <input type="text" name="estado" id="estado" size="30" value="" >
				<br>

				Telefone residencial: 
                <br>
                <input type="text" name="tel_res" id="tel_res" size="30" value="" >                                
				<br>
				Telefone Telefone comercial:
                <br>
                <input type="text" name="tel_com" id="tel_com" size="30" value="" >                                                
				<br>
				Celular:<br>
                <input type="text" name="celular" id="celular" size="30" value="" >                                                                
				<br> 
                E-mail:  <br>
                <input type="text" name="email" id="email" size="30" value="" >
				<br>
				Foto do cão: 
                <br>
                <input type="file" name="foto" id="foto" size="30" value="" ><br>
				Nome do cão: 
                <br>
                <input type="text" name="nome_cao" id="email" size="30" value="" >
<!--br>
  Microchip: 
                <br>
                <input type="text" name="microchip" id="email" size="30" value=""  -->
<br>

  Data de Nascimento: 
                <br>
                <input type="text" name="nascimento" id="nascimento" size="30" value="dd/mm/aaaa" >                
<br>
  Raça: 
                <br>
                <input type="text" name="raca" id="raca" size="30" value="" >                                
<br>
  Sexo: 
                <br>
                <input type="text" name="sexo" id="sexo" size="30" value="" >                                
<br>
  Cor: 
                <br>
                <input type="text" name="cor" id="cor" size="30" value="" ><br>                                                
Caso não saiba o nome do pai e da mãe, <br>preencha com seu nome e seja o Papai e Mamãe do seu cão.
<br><br>
  Nome do Pai: 
                <br>
                <input type="text" name="pai" id="pai" size="30" value="" >
<br>
  Nome da Mãe: 
                <br>
                <input type="text" name="mae" id="mae" size="30" value="" ><br>
           <input type="checkbox" id="confirmo" style="width:25px;" onClick="habilita()">
     Declaro que os dados inseridos no sistema são de minha inteira responsabilidade, não cabendo a Sobraci qualquer tipo de checagem presencial perante os animais<br>
                <input type="submit" value="Enviar" style="height: 40px;margin-top:20px" id="enviar">
		<br><br><br><br>
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
if (document.getElementById("enviar").disabled==true){
	document.getElementById("enviar").disabled=false;
}else{
	document.getElementById("enviar").disabled = true;
}
}


</script>
    <?php include "includes/informacoes.php"; ?>    

<script>
function verifica(){
	var microchip = document.getElementById("microchip").value;
	var verifica = microchip.substring(0,3);
	if (verifica !=981){
		alert("Favor corrigir o número do microchip");
	}
	if (verifica ==981){
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
<?php include "includes/footer.php";?>
</body>
</html>
