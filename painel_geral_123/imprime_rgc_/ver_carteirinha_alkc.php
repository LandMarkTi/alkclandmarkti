<?php
require_once("../Connections/conexao.php");
$id = trim($_GET['id']);//separar

$kid=base64_decode($_GET['key']);



$id_ped=substr($id,0,-2);

$id_f=(int)substr($id,-2,2);

//die('idped '.$id_ped.'idf '.$id_f);


$sql = "select * from pedigree where id_ped = $id_ped ";
$query = mysql_query($sql) or die ('pe');
$l = mysql_fetch_array($query);

$tr="select * from pedigre_trocados where id_ped=$id_ped and id_f=$id_f order by id_ped desc";

$r_t=mysql_query($tr);
$ft=mysql_fetch_assoc($r_t);
$nt=mysql_num_rows($r_t);

if($nt>=1){
$l['endereco']=$ft['endereco'];
$l['proprietario']=$ft['proprietario'];
$l['tel_t']=$ft['tel_t'];
}


//canil

$sqlc = "select * from criadores  where id_criador = $l[id_criador] ";
$queryc = mysql_query($sqlc) or die (mysql_error());
$lc = mysql_fetch_array($queryc);

if($lc['uso_canil']=='sulfixo')$sulf=' '.$lc['nome_completo'].' '; else $pref=' '.$lc['nome_completo'].' ';



$qrr=mysql_query('select * from subcategoria where idSubcategoria='.$l['id_raca']);

$lraca=mysql_fetch_assoc($qrr);

$raca=$lraca['nomeSubcategoria'];

$cr=$l['amigo'];

$cor=explode(';',$l['cor']);

$cor=$cor[$id_f-4];

$sexo=explode(';',$l['sexo']);

$sexo=$sexo[$id_f-4];

$mic=explode(';',$l['microchip']);

$mic=$mic[$id_f-4];


$ninhada=explode(';',$l['ninhada']);

$nome=$ninhada[$id_f];



$vp=explode(';',$l['parentes']);

//
$pai=$vp[0];

$mae=$vp[1];




$vpai = explode(' ', $pai);
if (count($vpai) >= 2) {
    array_pop($vpai);
    if(end($vpai)=='RGE' || end($vpai)=='RGEO')array_pop($vpai);
}
$pai = implode(' ', $vpai);

$vmae = explode(' ', $mae);
if (count($vmae) >= 2) {
    array_pop($vmae);
    if(end($vmae)=='RGE' || end($vmae)=='RGEO')array_pop($vmae);
}
$mae = implode(' ', $vmae);





//foto

$qf=mysql_query('select * from tarja where id_ped='.$id_ped.' and id_f='.($id_f-4).' order by id_foto desc limit 1') or die('dd');

$lf=mysql_fetch_assoc($qf);
$nf=mysql_num_rows($qf);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RGC</title>
<style>
#fundo {
	background-image:url(rg_frente_crop.JPG);
	background-repeat:no-repeat;
	width:800px;
	height:512px;
	font-family:Arial, Helvetica, sans-serif;
	font-size:18px;
	font-weight:bold;
	margin-top:21px;
	-webkit-print-color-adjust: exact;
}
#fundo span{
	position:absolute;
}
#RGC{
	margin-left: 415px;
	margin-top: 155px;
}
#microchip{
	margin-top: 196px;
	margin-left: 413px;
}
#CRMV{
	margin-top: 237px;
	margin-left: 413px;
}
#nome{
	margin-top: 273px;
	margin-left: 144px;
}
#nascimento{
	margin-top:274px;
	margin-left:592px;
}
#raca{
	margin-top: 310px;
	margin-left: 140px;
}
#cor{
	margin-top: 345px;
	margin-left: 391px;
}
#sexo{
	margin-top: 344px;
	margin-left: 136px;
	}
#pai{
	margin-top: 381px;
	margin-left: 120px;
}
#mae{
	margin-top:415px;
	margin-left:120px;
}
#foto{
width: 238px;
height: 220px;
margin-top: 33px;
margin-left: 60px;
	position: absolute;
	overflow: hidden;
	
}
.link{
	text-decoration: none;
	color: #222;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
	border-radius: 5px;
	border: 1px solid #999;
	padding: 8px;
	background-color: palegoldenrod;
}
@media print {
.noPrint {
    display:none;
  }
}
</style>
</head>

<body>
<div id="fundo">
<?php if($nf>=1){?><span id="foto"><img height="220px" src="../../painel_kennel/images/pedigree/<?php echo $lf['arquivo']; ?>"   /></span><?php }?>

<span id="RGC"><?php echo $l['registro'].$id_f; ?></span>

<span id="microchip"><?php echo $mic;?></span>

<span id="CRMV"><?php echo $cr;?></span>

<span id="nome"><?php echo trim(substr($pref.$nome.$sulf,0,26));?></span>

<span id="nascimento"><?php echo date("d-m-Y", $l['nasc']);?></span>

<span id="raca"><?php echo $raca;?></span>

<span id="cor"><?php echo $cor;?></span>

<span id="sexo"><?php echo $sexo;?></span>
<span id="pai"><?php echo $pai;?></span>
<span id="mae"><?php echo $mae;?></span>


</div>

</body>
</html>
