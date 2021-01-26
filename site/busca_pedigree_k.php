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

if($parte=='RG/KCBR/16/120971')$parte='RG/KCBR/16/12097';

if($parte=='RG/KCBR/16/120961')$parte='RG/KCBR/16/12096';


$sql="SELECT * FROM  `pedigree` WHERE  registro = '$parte'";
$r=mysql_query($sql);
$f=mysql_fetch_assoc($r);
$n=mysql_num_rows($r);

/*
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

*/

if(substr(strtoupper(trim($_POST['busca_chip'])),0,3)=='RG/'){

if(substr(strtoupper($_POST['busca_chip']),0,-2)=='RG/KCBR/16/12097' ){$f['id_ped']=72100;$fim='1'.$fim;}

if(substr(strtoupper($_POST['busca_chip']),0,-2)=='RG/KCBR/16/12096' ){$f['id_ped']=72099;$fim='1'.$fim;}



//teste cotas

//aviso de impressão

$qcota=mysql_query("select * from ped_vias2 where id_user=".$f['id_ped']." and i_filhote=".$fim) or die("<script>alert('nenhum registro encontrado.');history.go(-1);</script>");

$nr=mysql_num_rows($qcota);

if($nr<1 || substr($r['registro'],0,4)=='RG/E')die("<script>window.top.location='ver_carteirinha_alkc.php?id=".$f['id_ped'].str_pad(($fim),2,"0",STR_PAD_LEFT)."';</script>");

//&&substr($parte,0,3)!='RGE'

if($n>=1){
	
	die("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><script>window.top.location='ver_carteirinha_alkc.php?id=".$f['id_ped'].str_pad(($fim),2,"0",STR_PAD_LEFT)."';</script>");
	}
}
if($n==0)die("<script>location='busca_mc.php?chip=".trim($_POST['busca_chip'])."'</script>");

?>
