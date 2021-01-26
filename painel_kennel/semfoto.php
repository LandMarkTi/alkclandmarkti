<?php
require_once("Connections/conexao.php");
if($_POST){
	$id = (int)$_POST['idf'];
	$sqla = "delete from foto_ped where id_ped=".$id;
	$querya = mysql_query($sqla) or die('');

	$sqla = "delete from tarja where id_ped=".$id;
	$queryb = mysql_query($sqla) or die('');

}

?>ok!
