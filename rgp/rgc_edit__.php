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

$fotonome = $_FILES['foto']['name'];
$fototipo = $_FILES['foto']['type'];
$fototamanho = $_FILES['foto']["size"];
$fototemp = $_FILES['foto']['tmp_name'];

$ext=substr($fotonome,-3,3);
if($fotonome!=''&&$ext!='jpg'&&$ext!='JPG'&&$ext!='png'&&$ext!='PNG'&&$ext!='gif')die('arquivo de imagem deve ser jpg ,png ou gif.');
	
//testes

//mandou qr? se não cria um com maxid

if($qrcode=="")$qrcode=mt_rand(1000000,9000000);

//se mandou procura se é unico





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
$nome_cao = addslashes($_POST['nome_cao']);
$microchip = addslashes($_POST['microchip']);
$qrcode = addslashes($_POST['qrcode']);
$nascimento = implode("-",array_reverse(explode("/",$_POST['nascimento'])));
$raca = addslashes($_POST['raca']);
$sexo = addslashes($_POST['sexo']);
$cor = addslashes($_POST['cor']);
$pai = addslashes($_POST['pai']);
$mae = addslashes($_POST['mae']);
$id_ped = addslashes($_POST['id_ped']);

$crmv = addslashes($_POST['crmv']);

//print_r($_POST);

$sql = "update rgc set nome='$nome',rg='$rg', cpf='$cpf', endereco='$endereco', bairro='$bairro', cidade='$cidade', estado='$estado', cep='$cep', tel_res='$tel_res', tel_com='$tel_com', celular='$celular', email='$email', nome_cao='$nome_cao', microchip='$microchip', nascimento='$nascimento', raca='$raca', sexo='$sexo', cor='$cor', pai='$pai', mae='$mae', qrcode='$qrcode', crmv='$crmv'  where id = '$id_ped' ";  

if($fototamanho<2000000){
$ext=substr($fotonome,-3,3);


$fotonome=str_replace("/","",$fotonome);
//$fotonome=str_replace(".","",$fotonome);
$fotonome=str_replace("%","",$fotonome);
move_uploaded_file($fototemp,'../rgc/'.$fotonome);
$resultado = "alert('RGC Enviado');";

$query2 = mysql_query ($sql) or die ('');

$id_rgc = mysql_insert_id();

//$sql = "insert into qrcode (id_code,id_ped,id_filhote,qrcode) values ('','$id_rgc',0,'$qrcode')";
//$query2 = mysql_query ($sql) or die ('');


echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=rgc_edit.php'>";
die();

}

if($fototamanho>3000000){$resultado = "alert('Arquivo enviado passou do limite de 3MB!');";
echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=rgc_edit.php'>";
}



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


<?php
	$sql = "select * from paginas_internas";
	$query = mysql_query($sql) or die (mysql_error());
	$l = mysql_fetch_array($query);
	?>
<div class="internas_full">
 <div class="internas_margem_full" style="width:100%"> 
 
 	<div class="internas_box" style="width:80%;margin-left: 5%;margin-right: 5%;">
      <!--div class="internas_titulo">RG Digital<?php //echo $l['rgc_titulo']; ?></div-->
    <div class="arial_cinza1_11" style="margin-top:22px;">
        
	<style>#emailForm input{width: 100%;
height: 22px;
padding: 4px;
margin: 11px;}
.hid{ display:none}

 #oval { width: 53px; height: 48px;color: white; background: #428F25; -moz-border-radius: 50px / 25px; -webkit-border-radius: 50px / 25px; border-radius: 50px / 25px;padding-left: 42px;display:block;margin-left: 42%; }
</style><div style="border: 2px solid white;background-color:whiteSmoke;opacity:0.90;border-radius:20px">
<form method="post" name="emailForm" id="emailForm" enctype="multipart/form-data" style="margin-left: 5%;margin-right: 10%;margin-top: 29px;">
<H1 style="color:#428F25;opacity:1;font-size: 20px;">Editar RG PET </h1>

Nome: <br>
                <input type="text" name="nome" id="nome" size="30" value="<?php echo $linha['nome'];?>" >
                <br>
                RG:<br>
                <input type="text" name="rg" id="rg" size="30" value="<?php echo $linha['rg'];?>" >                
                <br>
                CPF:<br>
                <input type="text" name="cpf" id="cpf" size="30" value="<?php echo $linha['cpf'];?>" >                                
                <br>
                Endereço:<br>
                <input type="text" name="endereco" id="endereco" size="30" value="<?php echo $linha['endereco'];?>" >                                                
                <br>
                Bairro:<br>
                <input type="text" name="bairro" id="bairro" size="30" value="<?php echo $linha['bairro'];?>" >   <br>                    
                                                                   
               Cidade:<br>
                <input type="text" name="cidade" id="cidade" size="30" value="<?php echo $linha['cidade'];?>" ><br>
				Estado:<br>
                <input type="text" name="estado" id="estado" size="30" value="<?php echo $linha['estado'];?>" ><br>
				CEP:<br>
				<input type="text" name="cep" id="cep" size="30" value="<?php echo $linha['cep'];?>" ><br>
				Telefone residencial: 
                <br>
                <input type="text" name="tel_res" id="tel_res" size="30" value="<?php echo $linha['tel_res'];?>" ><br>
				Telefone Telefone comercial:
                <br>
                <input type="text" name="tel_com" id="tel_com" size="30" value="<?php echo $linha['tel_com'];?>" ><br>
				Celular:<br>
                <input type="text" name="celular" id="celular" size="30" value="<?php echo $linha['celular'];?>" ><br> 
                E-mail:  <br>
                <input type="text" name="email" id="email" size="30" value="<?php echo $linha['email'];?>" >
<br>
<?php 
if ($linha['foto']!='rgc/'){
echo "Foto do cão: 
                <br>
<!-- a href='".$linha['foto']."' target='_blank'><img src='".$linha['foto']."' width='280' height='216'></a-->";

	
}

?>
                <br>
                <input type="file" name="foto" id="foto" size="30" value="" ><br>
				Nome do animal:
                <br>
                <input type="text" name="nome_cao" id="nome_cao" size="30" value="<?php echo $linha['nome_cao'];?>" ><br>
				Microchip: 
                <br>
                <input type="text" name="microchip" id="microchip" size="30" value="<?php echo $linha['microchip'];?>" ><br>
				QRCODE<br>
				<input type="text" name="qrcode" id="qrcode" size="6" value="<?php echo $linha['qrcode'];?>" ><br>
				 Data de Nascimento: 
                <br>
                <input type="text" name="nascimento" id="nascimento" size="30" value="<?php echo implode("/",array_reverse(explode("-",$linha['nascimento'])));
?>" >                
<br>
  Raça: 
                <br>
                <input type="text" name="raca" id="raca" size="30" value="<?php echo $linha['raca'];?>" >                                
<br>
  Sexo: 
                <br>
                <input type="text" name="sexo" id="sexo" size="30" value="<?php echo $linha['sexo'];?>" >                                
<br>
  Cor: 
                <br>
                <input type="text" name="cor" id="cor" size="30" value="<?php echo $linha['cor'];?>" ><br>                                                
<br>
  Nome do Pai: 
                <br>
                <input type="text" name="pai" id="pai" size="30" value="<?php echo $linha['pai'];?>" >
<br>
  Nome da Mãe: 
                <br>
                <input type="text" name="mae" id="mae" size="30" value="<?php echo $linha['mae'];?>" ><br>
			Tipo<br>
				<input type="text" name="qrcode" id="qrcode" size="6" value="<?php echo $linha['tipo'];?>" ><br>
				CRMV<br>
				<input type="text" name="crmv" id="qrcode" size="6" value="<?php echo $linha['crmv'];?>" ><br>
	
                
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
