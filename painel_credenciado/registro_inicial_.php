<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

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

//echo($sql);
//die();

$query = mysql_query($sql) or die (mysql_error());

$sql = "select id from rgc where nome='$nome' and qrcode='$qrcode' order by id desc";
$query = mysql_query($sql) or die (mysql_error());
$l = mysql_fetch_array($query);
$id_rgc = $l[0];

if($fotonome!=''&&$fototamanho<3000000){
move_uploaded_file($fototemp,'../rgc/'.$fotonome);
$resultado = "alert('RGC Enviado');location='adicionar_pedigree_nucleo.php?rgc=$id_rgc';";
}

if($fototamanho>3000000){$resultado = "alert('Arquivo enviado passou do limite de 3MB!');";
echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=rgc.php'>";
}



$sql = "insert into qrcode (id_code,id_ped,id_filhote,qrcode) values ('','$id_rgc',0,'$qrcode')";
$query = mysql_query ($sql) or die (mysql_error());


if ($resultado=='')$resultado = "alert('RGC Enviado');location='adicionar_pedigree_nucleo.php?rgc=$id_rgc';";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Keywords" content="Painel de Controle - NEOWARE" /> 
<meta name="Description" content="Painel de Controle - NEOWARE"/> 
<meta name="copyright" content="Neoware Criação e Desenvolvimento de Websites e Sistemas - www.neoware.com.br" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="css/style_internas.css" />
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle - NEOWARE .::</title>
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
<link type="text/css" href="jquery/jqueryui/css/redmond/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<script type="text/javascript" src="jquery/jqueryui/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="jquery/jqueryui/js/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript" src="jquery/clone/reCopy.js"></script>

<script type="text/javascript">
$(function(){
	// Datepicker
	$('#dataInicial').datepicker({
		inline: true,
		dateFormat: "dd/mm/yy",
		altField: "#dataInicialEpoch",
		altFormat: "@"
	});
	// Datepicker
	$('#dataFinalx').datepicker({
		inline: true,
		dateFormat: "dd/mm/yy",
		altField: "#dataFinalEpoch",
		altFormat: "@"
	});
	$('#dataFinal').val( "<?php echo date('d/m/Y');?>" );
	$('#dataFinalEpoch').val("<?php echo time();?>000");
	$('#dataInicialEpoch').val("<?php echo time();?>000");
});
</script>
<!--Editor de Texto -->
<!-- TinyMCE -->
<script type="text/javascript" src="jquery/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
<!-- /TinyMCE -->
<script type="text/javascript">
      
      $(document).ready(function(){
         
         $("select[name=categoria]").change(function(){
            $("select[name=subcategoria]").html('<option value="0">Carregando...</option>');
            
            $.post("subcategoria_j.php", 
                  {categ:$(this).val()},
                  function(valor){
					  //alert(valor);
                     $("select[name=subcategoria]").html(valor);
                  }
                  );
            
         });
		 
		 $("select[name=subcategoria]").change(function(){

            
            $.post("subsubcategoria_j.php", 
                  {subcateg:$(this).val()},
                  function(valor){
					  //alert(valor);
                     $("select[name=cor]").html(valor);
			$('.ccc').each(function(ind,ele){$(ele).after('<select class="ccc" name="c[]">'+valor+'</select><input name="m[]" size="13" placeholder="microchip">').remove();});
                  }
                  );
            
         });
		 
      });
</script>
<script type="text/javascript">
$(function(){
  var removeLink = ' <a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false"><img src="images/icons/excluir.png" /></a>';
$('a.add').relCopy({ append: removeLink});
$('.parent').val('digite o nome..');

});
</script>
</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">

<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="internas_box" style="margin-top:-20px;">

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
<H1 style="font-size: 32px;margin-top: 40px;margin-bottom: 29px;">Formulário RGC </h1>
Microchip<br>
<input type="text" value="Preencha esse campo antes de continuar" name="microchip" id="microchip" onClick="this.value='';" onBlur="verifica()">
<br>
QRCODE<br>
<input type="text" name="qrcode" id="qrcode" maxlength="6" readonly onBlur="verifica_qrcode()" ><br>
Nome completo: <br>
                <input type="text" name="nome" id="nome" size="30" value="" readonly>
                <br>
                RG:<br>
                <input type="text" name="rg" id="rg" size="30" value="" readonly>                
                <br>
                CPF:<br>
                <input type="text" name="cpf" id="cpf" size="30" value="" readonly>                                
                <br>
				CEP:<br>
                <input type="text" name="cep" id="cep" size="30" value="" onblur="getEndereco();" readonly>                
				<br>
                Endereço:<br>
                <input type="text" name="endereco" id="endereco" size="30" value="" readonly>                                                
                <br>
                Bairro:<br>
                <input type="text" name="bairro" id="bairro" size="30" value="" readonly>   <br>                                                             
               Cidade:<br>
                <input type="text" name="cidade" id="cidade" size="30" value="" readonly><br>
				Estado:<br>
                <input type="text" name="estado" id="estado" size="30" value="" readonly>
				<br>

				Telefone residencial: 
                <br>
                <input type="text" name="tel_res" id="tel_res" size="30" value="" readonly>                                
				<br>
				Telefone Telefone comercial:
                <br>
                <input type="text" name="tel_com" id="tel_com" size="30" value="" readonly>                                                
				<br>
				Celular:<br>
                <input type="text" name="celular" id="celular" size="30" value="" readonly>                                                                
				<br> 
                E-mail:  <br>
                <input type="text" name="email" id="email" size="30" value="" readonly>
				<br>
				Foto do cão: 
                <br>
                <input type="file" name="foto" id="foto" size="30" value="" readonly><br>
				Nome do cão: 
                <br>
                <input type="text" name="nome_cao" id="email" size="30" value="" readonly>
<!--br>
  Microchip: 
                <br>
                <input type="text" name="microchip" id="email" size="30" value=""  -->
<br>

  Data de Nascimento: 
                <br>
                <input type="text" name="nascimento" id="nascimento" size="30" value="dd/mm/aaaa" readonly>                
<br>
  Raça: 
                <br>
                <input type="text" name="raca" id="raca" size="30" value="" readonly>                                
<br>
  Sexo: 
                <br>
                <input type="text" name="sexo" id="sexo" size="30" value="" readonly>                                
<br>
  Cor: 
                <br>
                <input type="text" name="cor" id="cor" size="30" value="" readonly><br>                                                
Caso não saiba o nome do pai e da mãe, <br>preencha com seu nome e seja o Papai e Mamãe do seu cão.
<br><br>
  Nome do Pai: 
                <br>
                <input type="text" name="pai" id="pai" size="30" value="" readonly>
<br>
  Nome da Mãe: 
                <br>
                <input type="text" name="mae" id="mae" size="30" value="" readonly><br>
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
	if (verifica !=981&&verifica !=963){
		alert("Favor corrigir o número do microchip");
	}
	if (verifica ==981||verifica ==963){
		$('#qrcode').removeAttr('readonly');
	}
}

function verifica_qrcode(){
var qrcode = document.getElementById("qrcode").value;
if(qrcode=='' || qrcode==' ' ){
alert ("QRCODE inválido");	
}
else{
		$('input').removeAttr('readonly');
}
}
</script>    
 
 </div>
</div>
         
        </div>
    </div>
    
  </div>
</div>
<?php include "footer.php";?>
 

</body>
</html>
