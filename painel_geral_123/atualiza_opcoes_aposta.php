<?php 
require ("Connections/conexao.php");

$id = $_POST['id'];
$valor = $_POST['valor'];

$sql = "UPDATE opcoesaposta SET opcao = '$valor' WHERE id = '$id'";
$query = mysql_query($sql) or die(mysql_error());
?>
