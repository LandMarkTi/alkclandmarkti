<?php
session_start();
if($_SESSION['login']=='kcbrasil@alkc.com.br'){

require_once("Connections/conexao.php");


$serie=(int)$_GET['bus'];

//echo $serie;

$qb=mysql_query("select * from ped_serie_a where numero_serie = '$serie' ");

$nr=mysql_num_rows($qb);

if($nr>=1){
mysql_query("delete from ped_serie_a where numero_serie = '$serie' ");
echo "<script>alert('serie removida com sucesso.');location='index_principal.php';</script>"; 
}else echo "<script>alert('serie nao encontrada.');location='index_principal.php';</script>";

}
?>

