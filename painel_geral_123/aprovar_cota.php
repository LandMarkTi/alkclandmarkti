<?php
session_start();
require_once("Connections/conexao.php");

if($_SESSION['login']!='sergio@sobraci.org')die("login");
$id = (int)$_POST['id'];
$cota =(int)$_POST['cota'];
$cred=(int)$_POST['cred'];

$sql = "update cotas set data_apr=NOW() WHERE id_cota = $id AND data_apr='0000-00-00' ";

mysql_query($sql) or die('ee');

if(mysql_affected_rows()>=1){
$q_add=mysql_query("update dados_credenciado set cota=cota+$cota where id_dados=$cred") or die(mysql_error());

echo 'Cota Aprovada.';
}else echo 'Cota não disponível.';
?>
