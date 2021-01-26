<?php
require_once("Connections/conexao.php");
$id = (int)$_POST['id'];

$sql = "DELETE FROM banner WHERE idBanner = '$id'";
mysql_query($sql) or die(mysql_error());
?>
