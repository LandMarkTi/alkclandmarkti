<?php

require_once('./Connections/conexao.php');
mysql_select_db($database_conexao, $conexao);

$busca=0;//(int)$_POST['busca_chip'];

if(trim($_GET['busca_chip'])=='')die("<script>alert('nenhum registro encontrado.');history.go(-1);</script>");

$parte=substr($_GET['busca_chip'],0,-1);
$fim=(int)substr($_GET['busca_chip'],-1,8);

if($parte=='LIM/3011051')$parte='LIM/301105';

if($parte=='SAO/553501')$parte='SAO/55350';

if($parte=='IBI/778951')$parte='IBI/77895';

if($parte=='BHT/951811')$parte='BHT/95181';

//IBI/7789512


if($_GET['busca_chip']=='NZN/8164112'){header('Location: http://www.megapedigree.com/site/pag_trans.php?id_ped=51041&id_f=12');die();}

if($_GET['busca_chip']=='IBI/7789512'){header('Location: http://www.megapedigree.com/site/pag_trans.php?id_ped=47295&id_f=12');die();}

if($_GET['busca_chip']=='BHT/9518110'){header('Location: http://www.megapedigree.com/site/pag_trans.php?id_ped=64581&id_f=10');die();}

//$fim+=4;
//echo $busca;3467 4786 footer errado
$sql="SELECT * FROM  `pedigree` WHERE  registro = '$parte'";
$r=mysql_query($sql);
$f=mysql_fetch_assoc($r);
$n=mysql_num_rows($r);




//teste cotas

//aviso de impressão

$qcota=mysql_query("select * from ped_vias2 where id_user=".$f['id_ped']) or die("<script>alert('nenhum registro encontrado.');history.go(-1);</script>");

$nr=mysql_num_rows($qcota);

if($nr<1&&substr($parte,0,3)!='RGE')die("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><script>alert('Pedigree sem impressão não tem validade.');location='index.php';</script>");


if($n>=1){
	
//
if(substr(strtoupper($_GET['busca_chip']),0,-2)=='LIM/301105'){$f['id_ped']=1296;$fim='1'.$fim;}

if(substr(strtoupper($_GET['busca_chip']),0,-2)=='SAO/55350'){$f['id_ped']=24750;$fim='1'.$fim;}

header('Location: http://www.megapedigree.com/site/pag_trans.php?id_ped='.$f['id_ped'].'&id_f='.$fim);
//die("<script>alert('Em breve!');history.go(-1);</script>");
    die();
	}

if($n==0)die("<script>alert('nenhum registro encontrado.');history.go(-1);</script>");

?>
