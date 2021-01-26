<?php
session_start();

require_once("Connections/conexao.php");

//if($_SESSION['login']=='')die("<script>location='index.php';</script>");
echo '<option>Importar..</option>';
$id=(int)$_GET['id'];
$pt=(int)$_GET['pt'];
$sql1="select * from pedigree  join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_criador=".$id;
$qr=mysql_query($sql1)or die(mysql_error());
while($linha_ped=mysql_fetch_assoc($qr)){
$catid=$linha_ped['id_raca'];

$v=explode(';',$linha_ped['parentes']);

//for($i=1;$i<30;$i=2*$i){ echo $i.':'.$v[$i];}

if($pt==1)echo '<option value="'.str_replace("\"","",$linha_ped['id_ped']).'">'.str_replace("\"","",substr($v[0],0,14)).'</option>';
if($pt==2)echo '<option value="'.str_replace("\"","",$linha_ped['id_ped']).'">'.str_replace("\"","",substr($v[1],0,14)).'</option>';
//for($i=1;$i<30;$i=2*$i){ echo $i.':'.$v[$i];}
}
?>
