<?php
require_once("Connections/conexao.php");

$resultado = "";

if($_POST){

$fotonome = $_FILES['foto']['name'];
$fototipo = $_FILES['foto']['type'];
$fototamanho = $_FILES['foto']["size"];
$fototemp = $_FILES['foto']['tmp_name'];

$ext=substr($fotonome,-3,3);
if($fotonome!=''&&$ext!='jpg'&&$ext!='JPG'&&$ext!='png'&&$ext!='PNG'&&$ext!='gif')die('arquivo de imagem deve ser jpg ,png ou gif.');
	
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

$qrcode = addslashes(trim($_POST['qrcode']));

//testes

//mandou qr? se não cria um com maxid

if($qrcode=="")$qrcode=mt_rand(1000000,9000000);

//se mandou procura se é unico






$nascimento = $_POST['nascimento'];
$nascimento = implode("-",array_reverse(explode("/",$nascimento)));

$raca = addslashes($_POST['raca']);
$sexo = addslashes($_POST['sexo']);
$cor = addslashes($_POST['cor']);
$pai = addslashes($_POST['pai']);
$mae = addslashes($_POST['mae']);	

$sql = "insert into rgc (id,nome,rg,cpf,endereco,bairro,cidade,estado,cep,tel_res,tel_com,celular,email,foto,nome_cao,microchip,nascimento,raca,sexo,cor,pai,mae,pago, qrcode) values ('','$nome', '$rg', '$cpf', '$endereco', '$bairro', '$cidade', '$estado', '$cep', '$tel_res', '$tel_com', '$celular', '$email', '$foto', '$nome_cao', '$microchip', '$nascimento', '$raca', '$sexo', '$cor', '$pai' ,'$mae','1','$qrcode')";
$query = mysql_query($sql) or die (mysql_error());

if($fototamanho<2000000){
$ext=substr($fotonome,-3,3);


$fotonome=str_replace("/","",$fotonome);
//$fotonome=str_replace(".","",$fotonome);
$fotonome=str_replace("%","",$fotonome);
move_uploaded_file($fototemp,'../rgc/'.$fotonome);
$resultado = "alert('RGC Enviado');";

$mensagemHTML = '<html>
<body><br><br>
RGC sobraci 
<br>
Nome: ' . $nome . '<br>
Telefone: '. $tel_res . '<br>
Email: '. $email . '<br>
<br><br>

Obrigado pelo cadastro,para consultar a sua carteirinha, use o link abaixo:
<br>
<a href="#">http://sobraci.org/c/'.$qrcode.'</a>

</body></html>
';

$headers = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=utf-8\n";
$headers .= "From: naoresponda@megapedigree.com\n"; // remetente
$headers .= "Return-Path: contato@megapedigree.com\n"; // return-path
//$envio = mail($email, "Envio RGC", "$mensagemHTML", $headers,'-rcontato@megapedigree.com');


$id_rgc = mysql_insert_id();

//$sql = "insert into qrcode (id_code,id_ped,id_filhote,qrcode) values ('','$id_rgc',0,'$qrcode')";
//$query2 = mysql_query ($sql) or die ('');


echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=rgc_ps.php?rg=".$id_rgc."'>";
die();

}

if($fototamanho>3000000){$resultado = "alert('Arquivo enviado passou do limite de 3MB!');";
echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=rgc_demo.php'>";
}



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
<?php //include "includes/header.php";?>
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
<div class="internas_full">
 <div class="internas_margem_full" style="width:100%"> 
 
 	<div class="internas_box" style="width:80%;margin-left: 5%;margin-right: 5%;">
      <!--div class="internas_titulo">RG Digital<?php //echo $l['rgc_titulo']; ?></div-->
    <div class="arial_cinza1_11" style="margin-top:50px;">
        
	<style>#emailForm input{width: 100%;
height: 22px;
padding: 4px;
margin: 11px;}</style><div style="border: 2px solid white;background-color:whiteSmoke;opacity:0.90;border-radius:20px">
<form method="post" name="emailForm" id="emailForm" enctype="multipart/form-data" style="margin-left: 5%;margin-right: 10%;margin-top: 69px;">
<H1 style="color:#428F25;opacity:1;font-size: 27px;">Formulário RG PET </h1>
Microchip(opcional)<br>
<input type="text" value="" name="microchip" id="microchip" onClick="this.value='';" onBlur="">
<br>
QRCODE(caso tenha medalha)<br>
<input type="text" name="qrcode" id="qrcode" maxlength="6"  onBlur="" ><br>
Nome completo: <br>
                <input type="text" name="nome" id="nome" size="30" value="" required>
                <br>
                RG: CPF:<br>
                <input type="text" name="rg" id="rg" size="30" style="width: 40%;display:inline" value="" >                
                
                <input type="text" name="cpf" id="cepe" size="30" value="" style="width: 40%;display:inline" required>                                
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
                <input type="text" name="nome_cao" id="nc" size="30" value="" required>
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
     Declaro que os dados inseridos no sistema são de minha inteira responsabilidade, não cabendo qualquer tipo de checagem presencial perante os animais<br>
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
