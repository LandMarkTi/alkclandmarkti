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

$sql1="select * from pedigree  join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria left join  registro_anterior using(id_ped) left join foto_laudos using(id_ped) where id_criador in (".$inn.") and 1 and (pedigree.registro not like 'RI%' OR pedigree.registro like 'RIO%' ) and id_raca=$raca ";

if($raca==287||$raca==346||$raca==347||$raca==348)$sql1="select * from pedigree  join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria left join  registro_anterior using(id_ped) left join foto_laudos using(id_ped) where id_criador in (".$inn.") and (foto_laudos.resultado IS NULL or foto_laudos.resultado=8 ) and (pedigree.registro not like 'RI%' OR pedigree.registro like 'RIO%' ) and id_raca in (287,346,347,348) ";

if($raca==297||$raca==363||$raca==364)$sql1="select * from pedigree  join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria left join  registro_anterior using(id_ped) left join foto_laudos using(id_ped) where id_criador in (".$inn.") and (foto_laudos.resultado IS NULL or foto_laudos.resultado=8 ) and (pedigree.registro not like 'RI%' OR pedigree.registro like 'RIO%' ) and id_raca in (297,363,364) ";

if($raca==210||$raca==355||$raca==380)$sql1="select * from pedigree  join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria left join  registro_anterior using(id_ped) left join foto_laudos using(id_ped) where id_criador in (".$inn.") and (foto_laudos.resultado IS NULL or foto_laudos.resultado=8 ) and (pedigree.registro not like 'RI%' OR pedigree.registro like 'RIO%' ) and id_raca in (210,355,380) ";

if($raca==298||$raca==351||$raca==352)$sql1="select * from pedigree  join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria left join  registro_anterior using(id_ped) left join foto_laudos using(id_ped) where id_criador in (".$inn.") and (foto_laudos.resultado IS NULL or foto_laudos.resultado=8 ) and (pedigree.registro not like 'RI%' OR pedigree.registro like 'RIO%' ) and id_raca in (298,351,352) ";


//die($sql1);
$qr=mysql_query($sql1)or die('eloop');



if($fc['uso_canil']=='sulfixo')$sulf=' '.$fc['nome_completo'].''; else $pref=''.$fc['nome_completo'].' ';

$vl=array("","HD-","HD +/-","HD +","HD ++","HD +++","","","DNA Profile");

//falta agregar campos do resultado

while($linha_ped=mysql_fetch_assoc($qr)){
$catid=$linha_ped['id_raca'];


$nn=explode(';',$linha_ped['ninhada']);

$i=4;
while($i<20){
	if($nn[$i]!='Nome Filhote'){
	
	//for($i=1;$i<30;$i=2*$i){ echo $i.':'.$v[$i];}
	
	if(is_null($linha_ped['reg_filhotes']))echo '<option title="'.$pref.$nn[$i].$sulf.' '.$vl[$linha_ped['resultado']].' '.$linha_ped['registro'].($i-4).'" value="'.str_replace("\"","",$linha_ped['id_ped']).'">'.$nn[$i].' '.$linha_ped['registro'].($i-4).'</option>';
	else echo '<option title="'.$nn[$i].' '.$vl[$linha_ped['resultado']].' '.$linha_ped['registro'].($i-4).'" value="'.str_replace("\"","",$linha_ped['id_ped']).'">'.$nn[$i].' '.$linha_ped['registro'].($i-4).'</option>';
	//for($i=1;$i<30;$i=2*$i){ echo $i.':'.$v[$i];}
	}
	$i++;
	}
}
//precisa inverter a join
$sql1="select *,pedigree.id_criador ,criadores.nome_completo as nc,criadores.uso_canil,GROUP_CONCAT(foto_laudos.resultado) as ld   from adiciona_filhote   join  pedigree  using(id_ped) join criadores ON pedigree.id_criador=criadores.id_criador  left join foto_laudos using(id_ped)  where 1 and adiciona_filhote.id_criador=".$id.' group by adiciona_filhote.id_ped';
$qr2=mysql_query($sql1)or die('eadd');
while($linha_ped=mysql_fetch_assoc($qr2)){
$nn=explode(';',$linha_ped['ninhada']);
//aqui cada um é diff.
$sulf='';

$pref='';

if(substr($linha_ped['registro'],0,4)!='RG/E'){
if($linha_ped['uso_canil']=='sulfixo')$sulf=' '.$linha_ped['nc'].''; else $pref=''.$linha_ped['nc'].' ';
}
echo '<option title="'.$pref.str_replace("\"","",$nn[$linha_ped['id_filhote']]).$sulf.' '.$vl[$linha_ped['resultado']].' '.$linha_ped['registro'].($linha_ped['id_filhote']-4).'" value="'.str_replace("\"","",$linha_ped['id_ped']).'">'.$pref.$nn[$linha_ped['id_filhote']].$sulf.' '.$linha_ped['registro'].($linha_ped['id_filhote']-4).'</option>';







}
?>
