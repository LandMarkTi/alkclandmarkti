<?php

require_once("Connections/conexao.php");

$id=$_GET['id'];
$sql1="select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$id;
$qr=mysql_query($sql1)or die(mysql_error());
$linha_ped=mysql_fetch_assoc($qr);
$catid=$linha_ped['id_raca'];



$sql = "SELECT * FROM subcategoria WHERE idSubcategoria='$catid'";
$query = mysql_query($sql) or die(mysql_error());
$linha = mysql_fetch_array($query);

$linha_ped['id_raca']=$linha['nomeSubcategoria'];

$l=0;
//caso imprimir


	 foreach($linha_ped as $k=>$v){ if($l>0 && $l<18)echo $k.':'.$v.'<br>';
					$l++;}
	
	


?>
