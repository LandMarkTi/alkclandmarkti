<?php
session_start();
if($_SESSION['login']=='')die("login");
 require_once("Connections/conexao.php"); ?>
<?php
$id = (int)$_POST['id'];
$cr=(int)$_POST['cr'];
if($id == 0) {
	echo"Numero Invalido";
} else {
mysql_select_db($database_conexao,$conexao);

$sql="update pedigree set id_criador=$cr where id_ped= $id";
$deleta=mysql_query($sql) or die (mysql_error ());

}
?>
