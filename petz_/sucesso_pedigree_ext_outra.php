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

$nome_criador=$_POST['criador_ex'];//=addslashes($fcr['nome']);

//foto!!!
$proprietario=addslashes($_POST['proprietario']);
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


//if($n>=1)die('registro duplicado');



$sql = "INSERT INTO pedigree VALUES('',$criador,'$nomecao','$micro',$raca,'$var',$datanasc,'$sex','$pais','$registro',$dataEmissao,'$ninhada_no','$amigo','$nome_criador','$proprietario','$end','$ns','$ss','$cs','$ps','$obs')";

//die($sql);
$query = mysql_query($sql) or die('ped_err'.$sql);

//Pegando o ID da cadela que acabo de ser cadastrada
$ultimo_id = (int)mysql_insert_id($conexao);

$registro_ex='RGEO 1'.$ultimo_id;

mysql_query("update pedigree set registro='$registro_ex' where id_ped=".$ultimo_id);

mysql_query("insert into registro_anterior values('','".addslashes($_POST['rga'])."',$ultimo_id,".$_SESSION['id'].")")or die('rga');

	$fotonome = $_FILES['foto']['name'];
	$fototipo = $_FILES['foto']['type'];
	$fototamanho = $_FILES['foto']['size'];
	$fototemp = $_FILES['foto']['tmp_name'];
	move_uploaded_file($fototemp,'./pedext/'.$fotonome);

mysql_query("insert into foto_ped values('','".addslashes($fotonome)."',$ultimo_id,22)");

mysql_query("update somatoria set ped_exo=ped_exo+1 where 1");

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
    	  <div class="arial_branco20" id="internas_titulo">Adicionado com Sucesso
          	
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            <img src="images/efetuado_com_sucesso.png">
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
