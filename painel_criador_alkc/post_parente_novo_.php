<?php
session_start();

require_once("Connections/conexao.php");

//if($_SESSION['login']=='')die("<script>location='index.php';</script>");

$id=(int)$_GET['id'];
$pt=(int)$_GET['pt'];
$sql1="select * from pedigree  join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$id;
$qr=mysql_query($sql1)or die(mysql_error());
$linha_ped=mysql_fetch_assoc($qr);
$catid=$linha_ped['id_raca'];

$linha_ped['emissao']=date("d/m/Y",$linha_ped['emissao']);

$v=explode(';',$linha_ped['parentes']);

//for($i=1;$i<30;$i=2*$i){ echo $i.':'.$v[$i];}

if($pt==1)echo $v[2].','.$v[6].','.$v[7].','.$v[14].','.$v[15].','.$v[16].','.$v[17]; 	
//2,6,7,14,15,16,17



if($pt==2)echo $v[3].','.$v[8].','.$v[9].','.$v[18].','.$v[19].','.$v[20].','.$v[21];
//3,8,9,18,19,20,21

if($pt==3)echo $v[4].','.$v[10].','.$v[11].','.$v[22].','.$v[23].','.$v[24].','.$v[25]; 	
//4,10,11,22,23,24,25



if($pt==4)echo $v[5].','.$v[12].','.$v[13].','.$v[26].','.$v[27].','.$v[28].','.$v[29];
//5,12,13,26,27,28,29



//for($i=1;$i<30;$i=2*$i){ echo $i.':'.$v[$i];}
?>
