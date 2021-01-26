<?php
require_once("Connections/conexao.php");
if($_POST){
	$id = (int)$_POST['idf'];
	$sqla = "delete from foto_ped where id_ped=".$id;
	$querya = mysql_query($sqla) or die(mysql_error());

}

?>ok!
