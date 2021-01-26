<?php

require_once('./Connections/conexao.php');
mysql_select_db($database_conexao, $conexao);

$busca=(int)$_POST['busca_chip'];

//die(substr($_POST['busca_chip'],0,5).":");

if(substr($_POST['busca_chip'],0,5)=='RG/TN'){header('Location: http://www.megapedigree.com/painel_geral_123/imprime_rgc/ver_carteirinha_nuc.php?view=web&id='.trim(substr($_POST['busca_chip'],6,9)));die();}

if(substr($_POST['busca_chip'],0,4)=='RG/T'){header('Location: http://www.megapedigree.com/painel_geral_123/imprime_rgc/ver_carteirinha_transf.php?view=web&id='.trim(substr($_POST['busca_chip'],5,6)));die();}


$sql2="SELECT * FROM  `rgc` WHERE  `microchip` ='$busca' or id=$busca or qrcode=$busca ";
$r2=mysql_query($sql2);
$f2=mysql_fetch_assoc($r2);
$n2=mysql_num_rows($r2);


if ($n2>=1){
	header('Location: http://www.megapedigree.com/site/imprime_rgc/ver_carteirinha.php?id='.$f2['id']);
    die();
	}




if($n2==0)die("<script>alert('nenhum registro encontrado.');history.go(-1);</script>");

?>
