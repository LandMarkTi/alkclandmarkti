<?php

require_once('./Connections/conexao.php');
mysql_select_db($database_conexao, $conexao);

$busca=0;//(int)$_POST['busca_chip'];



$parte=substr(strtoupper($_POST['busca_chip']),0,-1);
$fim=(int)substr($_POST['busca_chip'],-1,8);
$fim+=4;
//echo $busca;3467 4786 footer errado

if($parte=='SOR/681501')$parte='SOR/68150';

if($parte=='LIM/3011051')$parte='LIM/301105';

if($parte=='SAO/553501')$parte='SAO/55350';

if($parte=='BHT/806461')$parte='BHT/80646';//nco/79253

if($parte=='NCO/792531')$parte='NCO/79253';///

if($parte=='NZN/816221')$parte='NZN/81622';///

if($parte=='NZN/816411')$parte='NZN/81641';///NCP/8197712

if($parte=='NCP/819771')$parte='NCP/81977';

if($parte=='IBI/778951')$parte='IBI/77895';

if($parte=='BHT/951811')$parte='BHT/95181';


$sql="SELECT * FROM  `pedigree` WHERE  registro = '$parte'";
$r=mysql_query($sql);
$f=mysql_fetch_assoc($r);
$n=mysql_num_rows($r);

if($f['id_criador']==21801 ||$f['id_criador']==22893 ||$f['id_criador']==22282)die('Sem registro.');

if(substr(strtoupper($_POST['busca_chip']),0,-1)=='SOR/681501'){$f['id_ped']=37550;$fim='1'.$fim;}//deveria pegar o tamanho

if(substr(strtoupper($_POST['busca_chip']),0,-2)=='LIM/301105'){$f['id_ped']=1296;$fim='1'.$fim;}

if(substr(strtoupper($_POST['busca_chip']),0,-2)=='SAO/55350'){$f['id_ped']=24750;$fim='1'.$fim;}

if(substr(strtoupper($_POST['busca_chip']),0,-2)=='BHT/80646' ){$f['id_ped']=50046;$fim='1'.$fim;}//fim nao muda

if(substr(strtoupper($_POST['busca_chip']),0,-2)=='NCO/79253' ){$f['id_ped']=48653;$fim='1'.$fim;}

if(substr(strtoupper($_POST['busca_chip']),0,-2)=='NZN/81622' ){$f['id_ped']=51022;$fim='1'.$fim;}

if(substr(strtoupper($_POST['busca_chip']),0,-2)=='NZN/81641' ){$f['id_ped']=51041;$fim='1'.$fim;}

if(substr(strtoupper($_POST['busca_chip']),0,-2)=='NCP/81977' ){$f['id_ped']=51377;$fim='1'.$fim;}

if(substr(strtoupper($_POST['busca_chip']),0,-2)=='IBI/77895' ){$f['id_ped']=47295;$fim='1'.$fim;}

if(substr(strtoupper($_POST['busca_chip']),0,-2)=='BHT/95181' ){$f['id_ped']=64581;$fim='1'.$fim;}

//teste cotas

//aviso de impressão

$qcota=mysql_query("select * from ped_vias2 where id_user=".$f['id_ped']) or die("<script>alert('nenhum registro encontrado.');history.go(-1);</script>");

$nr=mysql_num_rows($qcota);

//if($nr<1)die("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><script>alert('Pedigree sem impressão não tem validade.');location='b_kennel_t.php';</script>");

if($n>=1){
	
	header('Location: https://megapedigree.com/site/pag_trans_alkc.php?id_ped='.$f['id_ped'].'&id_f='.($fim-4));
    die();
	}

if($n==0)die("<script>alert('nenhum registro encontrado.');history.go(-1);</script>");

?>
