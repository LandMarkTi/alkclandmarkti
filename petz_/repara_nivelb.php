<?php 
session_start();
require_once("Connections/conexao.php");
//var_dump($_POST);
$idu=(int)$_POST['idu'];
$value=$_POST['value'];
if($value){
$qr_pag=mysql_query("insert into bloqueios values('',$idu,".time().")")or die('err block');
}
?>
