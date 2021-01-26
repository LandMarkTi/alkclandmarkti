<?php
session_start();
require_once("Connections/conexao.php");
$nomecao = addslashes($_POST['tituloAposta']);
$micro=addslashes(implode(';',$_POST["m"]));
$raca=(int)$_POST['subcategoria'];
$datanasc = $_POST['dataInicialEpoch'] / 1000;
$sex=$_POST['sexo'];
$dataEmissao = $_POST['dataFinalEpoch'] / 1000;
$var=addslashes($_POST['variedade']);
$pais=addslashes($_POST['pais']);
$registro=addslashes($_POST['registro']);
$ninhada_no=$_POST['ninhada_no'];
$amigo=addslashes($_POST['amigo']);
$criador=(int)($_POST['criador']);


$qcr=mysql_query('SELECT * FROM  criadores  where id_criador='.$criador);


$fcr=mysql_fetch_assoc($qcr);


$nome_criador=addslashes($fcr['nome_completo']);

//foto!!!
$proprietario=addslashes($fcr['opcoes_nomes']);
$end=addslashes($_POST['endereço']);
//$bloco=$_POST['bloco_ninhada'];

//parentes
$p=$_POST["p[]"];
$ps=addslashes(implode(';',$_POST["p"]));

//ninhada
$ns=addslashes(implode(';',$_POST["n"]));

$obs=$_POST['obs'];

//sexo


$ss=implode(';',$_POST["s"]);

//cores
$cs=addslashes(implode(';',$_POST["c"]));


//teste registro
$t=mysql_query("SELECT * from pedigree where registro='".trim($registro)."' ");
$n=mysql_num_rows($t);


if($n>=1)die('registro duplicado');

$sql = "INSERT INTO pedigree VALUES('',2,'$nomecao','$micro',$raca,'$var',$datanasc,'$sex','$pais','$registro',$dataEmissao,'$ninhada_no','$amigo','$proprietario','$nome_criador','$end','$ns','$ss','$cs','$ps','$obs')";

//die($sql);
$query = mysql_query($sql) or die('ped_err'.$sql);

//Pegando o ID da cadela que acabo de ser cadastrada
$ultimo_id = mysql_insert_id($conexao);

mysql_query("insert into ri values('',$ultimo_id)");

	$fotonome = $_FILES['foto']['name'];
	$fototipo = $_FILES['foto']['type'];
	$fototamanho = $_FILES['foto']['size'];
	$fototemp = $_FILES['foto']['tmp_name'];
	move_uploaded_file($fototemp,'./pedext/'.$fotonome);

//mysql_query("insert into foto_ped values('','".addslashes($fotonome)."',$ultimo_id,22)");

mysql_query("INSERT INTO `ped_temp` (`id_ped_temp`, `id_ped`, `id_cria`, `id_nucleo`, `data_cadastro`, `data_aprovado`) VALUES (NULL, '$ultimo_id', '$criador', '".$_SESSION['id']."', '".time()."', '0');");


$ht="

Novo pedigree pendente de aprovação

Aviso gerado pelo sistema Sobraci

data: ".date("d/m/Y")."

";

$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/plain; charset=utf-8\n";
$headers .= "From: contato@megapedigree.com\n"; // remetente
$headers .= "Return-Path:contato@megapedigree.com\n"; // return-path
//$envio = mail("debora@neoware.com.br", "$assunto", "$mensagemHTML", $headers);
$envio = mail('thayna@sobraci.org', "Novo registro para aprovar", "$ht", $headers,"-rcontato@megapedigree.com");


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

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Adicione as fotos do filhote
          	
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;"><form action="fotos_ri.php" enctype="multipart/form-data" >
			<table width="100%" border="0" cellspacing="6" cellpadding="0">
       <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Foto 1:</label></td>
    				<td><input type="file" name="fot1"></td>
		</tr>    
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Foto 2:</label></td>
    				<td><input type="file" name="fot2"></td>
		</tr>    
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Foto 3:</label></td>
    				<td><input type="file" name="fot3"></td>
		</tr>    
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Foto 4:</label></td>
    				<td><input type="file" name="fot4"></td>
		</tr>    
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Foto 5:</label></td>
    				<td><input type="file" name="fot5"><br><br><br><input type="submit" ></td>
		</tr>   
</table></form>
         </div>
            </div>
         </div>
         
        </div>
    </div>
    
  </div>
</div>
<?php include "footer.php";?>
</body>
</html>
