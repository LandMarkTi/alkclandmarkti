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
$crmv = addslashes($_POST['crmv']);
$email = strtolower(addslashes($_POST['email']));
$foto = "../rgc/".$fotonome;


//testes

//mandou qr? se não cria um com maxid

if($qrcode=="")$qrcode=mt_rand(1000000,9000000);

//se mandou procura se é unico






$tm=time();
$ps=md5($tm);

$sql = "INSERT INTO `rgpet`.`med_vet` (`id_med`, `crmv_med`, `nome_med`, `data_cadastramento`) VALUES (NULL, '$crmv', '$nome', '".time()."');";
$query = mysql_query($sql) or die ('erro');

if($fototamanho<2000000){
$ext=substr($fotonome,-3,3);


$fotonome=str_replace("/","",$fotonome);
//$fotonome=str_replace(".","",$fotonome);
$fotonome=str_replace("%","",$fotonome);
move_uploaded_file($fototemp,'../rgc/'.$fotonome);
$resultado = "alert('dados Enviados');";

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


echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=rgc_vet.php?rg=".$id_rgc."'>";
die();

}

if($fototamanho>3000000){$resultado = "alert('Arquivo enviado passou do limite de 3MB!');";
echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=rgc_vet.php'>";
}



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
margin: 11px;}
.hid{ display:none}
</style><div style="border: 2px solid white;background-color:whiteSmoke;opacity:0.90;border-radius:20px">
<form method="post" name="emailForm" id="emailForm" enctype="multipart/form-data" style="margin-left: 5%;margin-right: 10%;margin-top: 29px;">
<H1 style="color:#428F25;opacity:1;font-size: 27px;">Cadastro do veterinário </h1>
<br>
Nome do Profissional: <br>
                <input type="text" name="nome" id="nome" size="30" value="" required>
                <br>

<br>
  Email: 
                
                <input name="email" type="text"   onClick="">                                
                       
<br>
  CRMV: 
                
                <input name="crmv" type="text"   onClick="">                                

           <input type="checkbox" id="confirmo" style="width:25px;" onClick="habilita()">
     Declaro que os dados inseridos no sistema são de minha inteira responsabilidade.<br>
                <input type="submit" value="Enviar" style="height: 40px;margin-top:20px" id="enviar">
		<br><br>
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
