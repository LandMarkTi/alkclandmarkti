<?php
session_start();
if($_SESSION['login']=='sergio@sobraci.org'){
require_once("Connections/conexao.php");
$qid = (int)$_POST['id'];
if($qid == "0") {
	echo"Numero Invalido";
} else {

/*
$idv=explode('-',$id);
$strid='';
foreach($idv as $k => $v){$myint=(int)$v;$strid.=$myint.',';}


$qid = substr($strid,0,-1);

*/
mysql_select_db($database_conexao,$conexao);

$sql="delete from criadores WHERE id_criador = $qid";
$deleta=mysql_query($sql) or die ('eed');

}
}
?>
