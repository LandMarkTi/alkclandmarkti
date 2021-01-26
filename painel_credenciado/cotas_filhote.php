<?php
require_once("Connections/conexao.php");

$idp=(int)$_POST['id'];

$idf=(int)$_POST['i'];

$sql="select * from ped_vias2 where id_user=$idp and i_filhote=$idf";

$qr = mysql_query($sql);

$f=mysql_fetch_assoc($qr);
$n=mysql_num_rows($qr);
$c=$f['conta_via']+1;

if($n>0)echo $c; else echo'1';

?>
