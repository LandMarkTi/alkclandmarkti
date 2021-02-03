<?php
session_start();

require_once("Connections/conexao.php");
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

$ttl=time();
//if($ttl>1528079290)die('<option></option>');

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
$inn.=$id;



//se for dos novos - 

if($fc['id_credenciado']>=125 && $id!=21956)$inn=$id;

echo '<option>Importar..</option>';

$sql1="select * from pedigree  join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria left join  registro_anterior using(id_ped) left join foto_laudos using(id_ped) where id_criador in (".$inn.") and 1 and (pedigree.registro not like 'RI%' OR pedigree.registro like 'RIO%' ) and id_raca=$raca and parentes not like 'digite o nome..%'";

if($raca==287||$raca==346||$raca==347||$raca==348)$sql1="select * from pedigree  join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria left join  registro_anterior using(id_ped) where id_criador in (".$inn.") and (pedigree.registro not like 'RI%' OR pedigree.registro like 'RIO%' ) and id_raca in (287,346,347,348) and parentes not like 'digite o nome..%'";

if($raca==297||$raca==363||$raca==364)$sql1="select * from pedigree  join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria left join  registro_anterior using(id_ped) where id_criador in (".$inn.") and (pedigree.registro not like 'RI%' OR pedigree.registro like 'RIO%' ) and id_raca in (297,363,364) and parentes not like 'digite o nome..%'";

if($raca==210||$raca==355||$raca==380)$sql1="select * from pedigree  join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria left join  registro_anterior using(id_ped) where id_criador in (".$inn.") and (pedigree.registro not like 'RI%' OR pedigree.registro like 'RIO%' ) and id_raca in (210,355,380) and parentes not like 'digite o nome..%'";


if($raca==298||$raca==351||$raca==352)$sql1="select * from pedigree  join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria left join  registro_anterior using(id_ped) where id_criador in (".$inn.") and (pedigree.registro not like 'RI%' OR pedigree.registro like 'RIO%' ) and id_raca in (298,351,352) and parentes not like 'digite o nome..%'";

if($raca==323||$raca==353||$raca==354||$raca==382)$sql1="select * from pedigree  join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria left join  registro_anterior using(id_ped) where id_criador in (".$inn.") and (pedigree.registro not like 'RI%' OR pedigree.registro like 'RIO%' ) and id_raca in (323,353,354,382) and parentes not like 'digite o nome..%'";

//die($sql1);
//$raca==287||$raca==346||$raca==347||$raca==348||$raca==297||$raca==363||$raca==364||$raca==210||$raca==355||$raca==380||$raca==298||$raca==351||$raca==352||$raca==323||$raca==353||$raca==354||$raca==382
$qr=mysql_query($sql1)or die('eloop');



if($fc['uso_canil']=='sulfixo')$sulf=' '.$fc['nome_completo'].''; else $pref=''.$fc['nome_completo'].' ';



while($linha_ped=mysql_fetch_assoc($qr)){
$catid=$linha_ped['id_raca'];


$nn=explode(';',$linha_ped['ninhada'],30);

$ss=explode(';',$linha_ped['sexo'],30);

$i=4;
	while($i<20){
		if($nn[$i]!='Nome Filhote'&& $ss[$i-4]=='Fêmea'){

			$sqlm = 'select ativo from padreadoresmatrizes where id_ped = ' . $linha_ped['id_ped'] . ' and id_filhote = ' . ($i - 4) . ' and ativo = 1';
			$qrm = mysql_query($sqlm);
			$matriz = mysql_fetch_assoc($qrm);

			if ($matriz['ativo'] == 1) {
				if (is_null($linha_ped['reg_filhotes'])) echo '<option lang="1" longdesc="' . $ss[$i - 4] . '"  alt="' . $i . '" title="' . $pref . $nn[$i] . $sulf . ' ' . $linha_ped['registro'] . ($i - 4) . '" value="' . str_replace("\"", "", $linha_ped['id_ped']) . '">' . $nn[$i] . ' ' . $linha_ped['registro'] . ($i - 4) . '</option>';
				else echo '<option lang="1" longdesc="' . $ss[$i - 4] . '"  alt="' . $i . '" title="' . $nn[$i] . ' ' . $linha_ped['registro'] . ($i - 4) . '" value="' . str_replace("\"", "", $linha_ped['id_ped']) . '">' . $nn[$i] . ' ' . $linha_ped['registro'] . ($i - 4) . '</option>';
			}
		}
	$i++;
	}
}
//precisa inverter a join
//$sql1="select * from adiciona_filhote   join  pedigree  using(id_ped) where adiciona_filhote.id_criador=".$id;

$sql1="select *,GROUP_CONCAT(foto_laudos.resultado) as ld from adiciona_filhote   join  pedigree  using(id_ped) left join foto_laudos using(id_ped)  where 1 and adiciona_filhote.id_criador=".$id.' group by adiciona_filhote.id_ped,adiciona_filhote.id_filhote';
$qr2=mysql_query($sql1)or die('eadd');
while($linha_ped=mysql_fetch_assoc($qr2)){
$nn=explode(';',$linha_ped['ninhada']);
$ss=explode(';',$linha_ped['sexo']);
if(($ss[$linha_ped['id_filhote']-4]=='Fêmea'&&($raca==287||$raca==346||$raca==347||$raca==348||$raca==297||$raca==363||$raca==364||$raca==210||$raca==355||$raca==380||$raca==298||$raca==351||$raca==352||$raca==323||$raca==353||$raca==354||$raca==382))||($ss[$linha_ped['id_filhote']-4]=='Fêmea'&&($linha_ped['id_raca']==$raca)) )echo '<option lang="2" longdesc="'.$ss[$linha_ped['id_filhote']-4].'" alt="'.$linha_ped['id_filhote'].'" title="'.str_replace("\"","",$nn[$linha_ped['id_filhote']]).' '.$linha_ped['registro'].($linha_ped['id_filhote']-4).'" value="'.str_replace("\"","",$linha_ped['id_ped']).'">'.$nn[$linha_ped['id_filhote']].' '.$linha_ped['registro'].($linha_ped['id_filhote']-4).'</option>';
}
?>
