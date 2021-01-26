<?php

require_once('./Connections/conexao.php');
mysql_select_db($database_conexao, $conexao);



$parte=substr(trim($_GET['chip']),0,19);

$fim=4;

if($parte=='')die('Sem Registro.');

$sql="SELECT * FROM  `pedigree` WHERE  `nº microchip` like '%$parte;%'";
$r=mysql_query($sql);
$f=mysql_fetch_assoc($r);
$n=mysql_num_rows($r);



//echo $sql;
if($n>=1){
	
//busca vetor
$a=explode(';',$f['nº microchip']);

if (in_array($parte, $a, true)){

	$fim=array_search($parte, $a, true);
	die("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><script>window.top.location='ver_carteirinha_alkc.php?id=".$f['id_ped'].str_pad(($fim+4),2,"0",STR_PAD_LEFT)."';</script>");

			} else die('Sem Registro');
	}


?>
