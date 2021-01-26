<?php
session_start();

require_once("Connections/conexao.php");

$id=(int)$_GET['id'];
$pt=(int)$_GET['pt'];
$raca=(int)$_GET['rac'];

$sql_add="select * from criadores where id_criador=".$id;
$qr_criador=mysql_query($sql_add);
$fc=mysql_fetch_assoc($qr_criador);


$nome_canil=addslashes(trim($fc['nome_completo']));

$sql_lista="select * from criadores where nome_completo = '".$nome_canil."' ";
$qr_lista=mysql_query($sql_lista);


while($flista=mysql_fetch_assoc($qr_lista))$inn.=$flista['id_criador'].',';
$inn.='-1';

//if($_SESSION['login']=='')die("<script>location='index.php';</script>");
echo '<option>Importar..</option>';

$sql1="select * from pedigree  join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria left join  registro_anterior using(id_ped) where id_criador in (".$inn.") and (pedigree.registro not like 'RI%' OR pedigree.registro like 'RIO%' ) and id_raca=$raca ";

//die($sql1);
$qr=mysql_query($sql1)or die('eloop');



if($fc['uso_canil']=='sulfixo')$sulf=' '.$fc['nome_completo'].''; else $pref=''.$fc['nome_completo'].' ';



while($linha_ped=mysql_fetch_assoc($qr)){
$catid=$linha_ped['id_raca'];


$nn=explode(';',$linha_ped['ninhada']);

$ss=explode(';',$linha_ped['sexo']);

$i=4;
while($i<20){
	if($nn[$i]!='Nome Filhote'){
	
	//for($i=1;$i<30;$i=2*$i){ echo $i.':'.$v[$i];}
	
	if(is_null($linha_ped['reg_filhotes']))echo '<option longdesc="'.$ss[$i-4].'" title="'.$pref.$nn[$i].' '.$linha_ped['registro'].($i-4).$sulf.'" value="'.str_replace("\"","",$linha_ped['id_ped']).'">'.$nn[$i].' '.$linha_ped['registro'].($i-4).'</option>';
	else echo '<option longdesc="'.$ss[$i-4].'" title="'.$nn[$i].' '.$linha_ped['registro'].($i-4).'" value="'.str_replace("\"","",$linha_ped['id_ped']).'">'.$nn[$i].' '.$linha_ped['registro'].($i-4).'</option>';
	//for($i=1;$i<30;$i=2*$i){ echo $i.':'.$v[$i];}
	}
	$i++;
	}
}
//precisa inverter a join
$sql1="select * from adiciona_filhote   join  pedigree  using(id_ped) where adiciona_filhote.id_criador=".$id;
$qr2=mysql_query($sql1)or die('eadd');
while($linha_ped=mysql_fetch_assoc($qr2)){
$nn=explode(';',$linha_ped['ninhada']);
$ss=explode(';',$linha_ped['sexo']);
echo '<option longdesc="'.$ss[$linha_ped['id_filhote']-4].'" title="'.str_replace("\"","",$nn[$linha_ped['id_filhote']]).' '.$linha_ped['registro'].($linha_ped['id_filhote']-4).'" value="'.str_replace("\"","",$linha_ped['id_ped']).'">'.$nn[$linha_ped['id_filhote']].' '.$linha_ped['registro'].($linha_ped['id_filhote']-4).'</option>';
}
?>
