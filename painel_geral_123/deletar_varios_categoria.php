<?php
session_start();
if($_SESSION['login']=='')die("login");
 require_once("Connections/conexao.php"); ?>
<?php
$id = $_POST['id'];
if($id == "") {
	echo"Numero Invalido";
} else {
$id = str_replace("-",",",$id);
$id = substr($id,0,-1);
mysql_select_db($database_conexao,$conexao);
$sql="delete from categoria WHERE idCategoria IN ($id)";
$deleta=mysql_query($sql) or die (mysql_error ());
}
?>
