<?php
require_once("Connections/conexao.php");
$id = $_POST['id'];

$sql = "DELETE FROM video WHERE id = '$id'";
mysql_query($sql) or die(mysql_error());
?>