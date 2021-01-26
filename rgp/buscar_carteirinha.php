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
<meta name="keywords" content="Pedigree,Cinofilia,  raça" /> 
<meta name="description" content="Rg pet"/>
<meta name="Abstract" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote" />
<meta name="copyright" content="Petweball" />
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

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="shortcut icon" href="favicon.png" />
<title>Rgpet</title>

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
 
 	<div class="internas_box" style="width:80%;margin-left: 5%;margin-right: 5%;margin-top:100px">
      <!--div class="internas_titulo">RG Digital<?php //echo $l['rgc_titulo']; ?></div-->
    <div class="arial_cinza1_11" style="margin-top:5px;">
        
	<style>#emailForm input{width: 40%;
height: 22px;
padding: 4px;
margin: 11px;}</style><div style="border: 2px solid white;background-color:#428F25;opacity:0.60;border-radius:20px">
<form method="get" action="../ver_carteirinha.php" target="_new" name="emailForm" id="emailForm" style="margin-left: 5%;margin-right: 10%;margin-top: 49px;">
<H1 style="color:white;opacity:1;font-size: 25px;">Buscar RG PET </h1>

<input type="text" value="" name="id" id="microchip" onClick="this.value='';" onBlur="">


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
