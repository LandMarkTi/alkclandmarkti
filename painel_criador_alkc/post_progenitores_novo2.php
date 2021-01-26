<?php
session_start();

require_once("Connections/conexao.php");

//if($_SESSION['login']=='')die("<script>location='index.php';</script>");
echo '<option>Importar..</option>';
$id=(int)$_GET['id'];
$pt=(int)$_GET['pt'];
$raca=(int)$_GET['rac'];

$sql_add="select * from criadores where id_criador=".$id;
$qr_criador=mysql_query($sql_add);
$fc=mysql_fetch_assoc($qr_criador);

if($fc['uso_canil']=='sulfixo')$sulf=' '.$fc['nome_completo'].''; else $pref=''.$fc['nome_completo'].' ';


$nome_canil=addslashes(trim($fc['nome_completo']));

$sql_lista="select * from criadores where nome_completo = '".$nome_canil."' ";
$qr_lista=mysql_query($sql_lista);


while($flista=mysql_fetch_assoc($qr_lista))$inn.=$flista['id_criador'].',';
$inn.='-1';




$sql1="select * from pedigree  join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria left join  registro_anterior using(id_ped) where id_criador in (".$inn.") and id_raca=$raca ";
$qr=mysql_query($sql1)or die(mysql_error());


while($linha_ped=mysql_fetch_assoc($qr)){
$catid=$linha_ped['id_raca'];


$nn=explode(';',$linha_ped['ninhada']);

$i=4;
while($i<20){
	if($nn[$i]!='Nome Filhote'){
	
	//for($i=1;$i<30;$i=2*$i){ echo $i.':'.$v[$i];}
	
	if(is_null($linha_ped['reg_filhotes']))echo '<option title="'.$pref.$nn[$i].$sulf.' '.$linha_ped['registro'].($i-4).'" value="'.str_replace("\"","",$linha_ped['id_ped']).'">'.$linha_ped['registro'].($i-4).'</option>';
	else echo '<option title="'.$nn[$i].' '.$linha_ped['registro'].($i-4).'" value="'.str_replace("\"","",$linha_ped['id_ped']).'">'.$linha_ped['registro'].($i-4).'</option>';
	//for($i=1;$i<30;$i=2*$i){ echo $i.':'.$v[$i];}
	}
	$i++;
	}
}
?>
