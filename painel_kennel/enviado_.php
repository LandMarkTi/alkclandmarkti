<?php
session_start();
if($_SESSION['login']=='')die("login");
require_once("Connections/conexao.php");
$id = (int)$_POST['id'];
echo "id =".$id;
$sql = "insert into ped_env values('',$id,".time().",".$_SESSION['id'].")";
mysql_query($sql) or die('');

?>
