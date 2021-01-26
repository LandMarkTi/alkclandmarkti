<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");

$id_ped=(int)$_GET['id_ped'];

$id_f=(int)$_GET['id_f'];

$idc=(int)$_SESSION['cid'];

$jhb=mysql_query("select * from ped_print where id_ped=".$id_ped." and id_f= ".($id_f)." order by id_perm desc limit 1");
			$lp=mysql_fetch_assoc($jhb);
			$nr=mysql_num_rows($jhb);
			if($nr>=1){echo $v=$lp['tipo_perm'];} else {$v=2;}
			
//removendo

$qd=mysql_query("delete from ped_print where id_ped=$id_ped and id_f= $id_f and id_criador= $idc") or die('ok');

if($v==2)$qi=mysql_query("insert into ped_print values('',$id_ped,$id_f,$idc,'1')");

echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'><script>alert('permissão alterada');location='listagem_pedigree.php';</script>";


?>
