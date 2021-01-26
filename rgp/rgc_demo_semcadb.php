<?php
session_start();
require_once("Connections/conexao.php");
$resultado = "";

if($_SESSION['pid']>0){


$q_cli=mysql_query("SELECT * from med_vet2 where id=".$_SESSION['pid'])or die('eec');
$d_cli=mysql_num_rows($q_c);
$f_cli=mysql_fetch_assoc($q_cli);

$crm=$f_cli['crmv_med'];

}




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
$endereco = $endereco.' '.addslashes($_POST['numero']);
$bairro = addslashes($_POST['bairro']);
$cidade = addslashes($_POST['cidade']);
$estado = addslashes($_POST['estado']);
$cep = addslashes($_POST['cep']);
$tel_res = addslashes($_POST['tel_res']);
$tel_com = addslashes($_POST['tel_com']);
$celular = addslashes($_POST['celular']);
$email = strtolower(addslashes($_POST['email']));
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

$tipo=addslashes($_POST['tipo']);

$crmv=addslashes($_POST['crmv']);

$tm=time();
$ps=md5($tm);


$qcr=mysql_query("select * from med_vet2 where crmv_med='".$crmv."'");
$fcr=mysql_fetch_assoc($qcr);
$ncr=(int)mysql_num_rows($qcr);
$apro=0;
if($ncr<1){$crmv='L789787';$apro=1;}

$sql = "insert into rgc (id,nome,rg,cpf,endereco,bairro,cidade,estado,cep,tel_res,tel_com,celular,email,foto,nome_cao,microchip,nascimento,raca,sexo,cor,pai,mae,pago, qrcode,tipo,crmv,ps) values ('','$nome', '$rg', '$cpf', '$endereco', '$bairro', '$cidade', '$estado', '$cep', '$tel_res', '$tel_com', '$celular', '$email', '$foto', '$nome_cao', '$microchip', '$nascimento', '$raca', '$sexo', '$cor', '$pai' ,'$mae','$apro','$qrcode','$tipo','$crmv','$tm')";
$query = mysql_query($sql) or die ('erro');

$id_rgc = mysql_insert_id();




if(isset($_POST['castrado']))
{
//    echo "checkbox marcado! <br/>";
$li=mysql_insert_id();
$queryc = mysql_query("insert into castrado values('',$li,'Castrado')");
    //echo "valor: " . $_POST['meucheckbox'];
}

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




//$sql = "insert into qrcode (id_code,id_ped,id_filhote,qrcode) values ('','$id_rgc',0,'$qrcode')";
//$query2 = mysql_query ($sql) or die ('');


if($ncr<1){echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=rgc_ps.php?rg=".$id_rgc."'>";
die();
}else {

echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=rgc_menu_clinica.php'>";
die();
}


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

/*
Ultimate Age calculator script- By JavaScript Kit (http://www.javascriptkit.com)
Over 200+ free scripts here!
Credit must stay intact for use
*/

var one_day=1000*60*60*24
var one_month=1000*60*60*24*30
var one_year=1000*60*60*24*30*12

function displayage(yr, mon, day, unit, decimal, round){
today=new Date()
var pastdate=new Date(yr, mon-1, day)

var countunit=unit
var decimals=decimal
var rounding=round

finalunit=(countunit=="days")? one_day : (countunit=="months")? one_month : one_year
decimals=(decimals<=0)? 1 : decimals*10

if (unit!="years"){
if (rounding=="rounddown")
return(Math.floor((today.getTime()-pastdate.getTime())/(finalunit)*decimals)/decimals)
else
return(Math.ceil((today.getTime()-pastdate.getTime())/(finalunit)*decimals)/decimals)
}
else{
yearspast=today.getFullYear()-yr-1
tail=(today.getMonth()>mon-1 || today.getMonth()==mon-1 && today.getDate()>=day)? 1 : 0
pastdate.setFullYear(today.getFullYear())
pastdate2=new Date(today.getFullYear()-1, mon-1, day)
tail=(tail==1)? tail+Math.floor((today.getTime()-pastdate.getTime())/(finalunit)*decimals)/decimals : Math.floor((today.getTime()-pastdate2.getTime())/(finalunit)*decimals)/decimals
return(yearspast+tail)
}
}

//Sample usage
//displayage (year, month, day, unit, decimals, rounding)
//Unit can be "years", "months", or "days"
//Decimals specifies demical places to round to (ie: 2)
//Rounding can be "roundup" or "rounddown"

//displayage(1997, 11, 24, "years", 0, "rounddown")


function limite(){

var str_d=$('#idade').val();

var vn=str_d.split("/");

var soma =displayage(vn[2],vn[1],vn[0], "years", 1, "rounddown");


if (soma<18){alert('Idade mínima é de 18 anos');$('#idade').val('');$('#idade').focus();}

}
</script>
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
margin: 11px;
border-radius: 5px;}
.hid{ display:none}
</style><div style="border: 2px solid white;background-color:whiteSmoke;opacity:0.90;border-radius:20px">
<form method="post" name="emailForm" id="emailForm" enctype="multipart/form-data" style="margin-left: 5%;margin-right: 10%;margin-top: 69px;">
<H1 style="color:#428F25;opacity:1;font-size: 27px;">Formulário RG PET </h1>
<br>
Nome do Proprietário: <br>
                <input type="text" name="nome" id="nome" size="30" value="" required>
                <br>
                Nascimento:<br>
                <input type="text" name="idade" id="idade" size="30" value="" onblur="limite();" required>                
                <br>
                RG:<br>
                <input type="text" name="rg" id="rg" size="30" value="" >                
                <br>
                CPF:<br>
                <input type="text" name="cpf" id="cepe" size="30" value="" required>                                
                <br>
				CEP:<br>
                <input type="text" name="cep" id="cep" size="30" value="" onblur="getEndereco();" >                
				<br><span class="hid">
                Endereço:<br>
                <input type="text" name="endereco" id="endereco" size="30" value="" class="hid">                                                
                <br>
                nº:<br>
                <input type="text" name="numero" id="num" size="30" value="" class="hid">                                                
                <br>
                Bairro:<br>
                <input type="text" name="bairro" id="bairro" size="30" value="" class="hid" >   <br>                                                             
               Cidade:<br>
                <input type="text" name="cidade" id="cidade" size="30" value="" class="hid"><br>
				Estado:<br>
                <input type="text" name="estado" id="estado" size="30" value="" class="hid"></span>
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
<H1 style="color:#428F25;opacity:1;font-size: 27px;">Dados do Animal </h1>
		Tipo:<br>
		<select name="tipo" >
		<option>Cachorro</option>
		<option>Gato</option>
		<option>Aquático</option>
		<option>Aves</option>
		<option>Roedor</option>
		<option>Réptil</option>
		<option>Eqüino</option>
		<option>Outros</option>
		</select><br><br>
				Foto do Pet: 
                <br>
                <input type="file" name="foto" id="foto" size="30" value="" ><br>
				Nome do Pet: 
                <br>
                <input type="text" name="nome_cao" id="nc" size="30" value="" required>

<br>
Microchip(Se Tiver)<br>
<input type="text" value="" name="microchip" id="microchip"  onBlur="">
<br>
Tag(Se Tiver)<br>
<input type="text" value="" name="qrcode" id="microchip"  onBlur="">
<br>

  Data de Nascimento: 
                <br>
                <input type="date" name="nascimento" id="nascimento" size="30"  >                
<br>
  Raça: 
                <br>
                <input type="text" name="raca" id="raca" size="30" value="" >                                
<br>
  Sexo: 
                <br>
                <select  name="sexo" id="sexo"  ><option>Masc.</option><option>Fem.</option></select>                                
<br><br>
  Castrado: 
                
                <input name="castrado" type="checkbox"  style="width:25px;" >                                
<br>
  CRMV: 
                
                <input name="crmv" type="text"   value="<?php if($_SESSION['pid']>0)echo $crm;?>" <?php if($_SESSION['pid']>0)echo "readonly";?>>                                
<br>
  Cor: 
                <br>
                <input type="text" name="cor" id="cor" size="30" value="" ><br>                                                
Caso não saiba o nome do pai e da mãe, preencha com seu nome e seja o Papai e Mamãe do seu Pet.
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
   $("input[name=idade]").mask("99/99/9999");
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
