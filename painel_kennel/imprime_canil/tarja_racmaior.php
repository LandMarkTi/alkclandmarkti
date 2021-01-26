<?php
session_start();

if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("fpdf.php");
require_once("../Connections/conexao.php");
$id = (int)$_GET['id'];

$id_f=(int)$_GET['id_f'];


$sql = "select * from pedigree  where id_ped = $id ";
$query = mysql_query($sql) or die ('ep');
$l = mysql_fetch_array($query);

$nncode=mysql_num_rows($query);
if($nncode<1)die('Não Encontrado.');



//serie


$serie=(int)$_GET['se'];

$str_serie=addslashes($_GET['se']);

$idc=$_SESSION['id'];

//testa serie


$int_serie=(int)$_GET['se'];
if($int_serie > 5000)die("<script>location='./tarja_livre.php?id=".$id."&id_f=".$id_f."&se=$int_serie';</script>");

$t_query=mysql_query("select * from ped_serie_a where numero_serie='$str_serie' and status='usado' and tipo_serie='3' and id_credenciado='$idc' ") or die('err_pedserie');
$nt=(int)mysql_num_rows($t_query);

$t_query2=mysql_query("select * from ped_serie_a where numero_serie='$str_serie' and status='livre' and tipo_serie='3' and id_credenciado='$idc' ") or die('err_pedserie2');
$livre=(int)mysql_num_rows($t_query2);



if($livre>=1&&$nt<1){

 $upp=mysql_query("update ped_serie_a set status='usado',id_ped='$id',id_filhote='$id_f',data_add='".time()."' where numero_serie='$str_serie' and id_credenciado='$idc' and tipo_serie='3' ");
$nup=(int)mysql_num_rows($upp);


 }else {die('numero invalido ou usado');}//usado




$l['crmv']='-';

//canil

$sqlc = "select * from criadores  where id_criador = $l[id_criador] ";
$queryc = mysql_query($sqlc) or die ('ic');
$lc = mysql_fetch_array($queryc);

if($lc['nome_completo']=='Yucatán BR')$lc['nome_completo']='YUCATÁN BR';


if($lc['uso_canil']=='sulfixo')$sulf=' '.$lc['nome_completo'].' '; else $pref=' '.$lc['nome_completo'].' ';

//$canil=$lc['nome_completo'];


$qrr=mysql_query('select * from subcategoria where idSubcategoria='.$l['id_raca']);

$lraca=mysql_fetch_assoc($qrr);

$raca=$lraca['nomeSubcategoria'];

if($lc['id_criador']=='21717')$raca=strtoupper($raca);

$cor=explode(';',$l['cor']);

$c1=explode('*',$cor[$id_f-4]);
$var=$c1[1];

if($lc['id_criador']=='21717')$var=strtoupper($var);

$cor=$c1[0];

if($lc['id_criador']=='21717')$cor=strtoupper($cor);

$ninhada=explode(';',$l['ninhada']);

$nome=$ninhada[$id_f];


$nome_cao=trim(substr($pref.$nome.$sulf,0,31));

if(substr($l['registro'],0,4)=='RG/E')$nome_cao=$nome;

if($lc['id_criador']=='22054')$nome_cao=$nome;

if($lc['id_criador']=='21717')$nome_cao=strtoupper($nome_cao);


$sexo=explode(';',$l['sexo']);

$sexo=$sexo[$id_f-4];

if($sexo=='Masc')$sexo='MACHO'; else $sexo='FEMEA';

$micro=explode(';',$l['nº microchip']);

$micro=$micro[$id_f-4];

$vp=explode(';',$l['parentes']);


$pai=$vp[0];

$mae=$vp[1];

$pai=str_replace(',',' ',$pai);

$mae=str_replace(',',' ',$mae);

//tirando o final

$vpai = explode(' ', $pai);
if (count($vpai) >= 2) {
    array_pop($vpai);
    if(end($vpai)=='RGE' || end($vpai)=='RGEO')array_pop($vpai);
}
$pai = substr(implode(' ', $vpai),0,45);

$vmae = explode(' ', $mae);
if (count($vmae) >= 2) {
    array_pop($vmae);
    if(end($vmae)=='RGE' || end($vmae)=='RGEO')array_pop($vmae);
}
$mae = substr(implode(' ', $vmae),0,45);


$nasc=date("d/m/Y",$l['nasc']);

//if($l['pago']==1)die('Pagamento Pendente. ');
$pdf= new FPDF("P","cm",array(21,30));
 
 
$pdf->SetMargins(2,2,2,2);

$pdf->AddPage();
 
$file='https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=http://rgpetsystem.club/ver_carteirinha.php?id='.$id;



//copy($file, './qr/code.jpg');


//mais 3 mm no y

$yy=0.3;

$pdf->Image('qr.png',14.5, 1.3 , 3 , 3,'PNG');

$sql_fot="SELECT * FROM  `tarja` where id_ped=".$id." and id_f=".($id_f-4)." ORDER BY id_foto DESC";
$qrf=mysql_query($sql_fot);
$lin=mysql_fetch_assoc($qrf);
$nnn=mysql_num_rows($qrf);
if($nnn>=1)$pt='../images/pedigree/'.rawurldecode($lin['arquivo']); else{

$sql_fot="select * from foto_ped where id_ped='.$id.' and id_f=22 order by id_foto desc limit 1";
$qrf=mysql_query($sql_fot);
$lin=mysql_fetch_assoc($qrf);
$nnn=mysql_num_rows($qrf);

if($nnn>=1)$pt="../".$lin['arquivo'];

}


if(is_file($pt)==true)$pdf->Image($pt,0.6, 0.6 , 3 , 3);

$pdf->SetXY(4.9,(2.0+$yy));
$pdf->SetFont('arial','',8);
$pdf->Cell(5.6, 0.7,iconv('UTF-8', 'windows-1252', $l['registro'].($id_f-4)) , 0 , 1 , 'L' );


$pdf->SetXY(5.4,(2.5+$yy));
$pdf->SetFont('arial','',8);
$pdf->Cell(5.5, 0.8,iconv('UTF-8', 'windows-1252', $micro) , 0 , 1 , 'L' );



$pdf->SetXY(5.7,(3.0+$yy));
$pdf->SetFont('arial','',8);
$pdf->Cell(5.5, 0.8,iconv('UTF-8', 'windows-1252', trim($l['amigo'])) , 0 , 1 , 'L' );

$pdf->SetXY(8.1,(3.5+$yy));
$pdf->SetFont('arial','',8);
$pdf->Cell(3.5, 0.8,iconv('UTF-8', 'windows-1252', trim($nasc)) , 0 , 1 , 'L' );


$pdf->SetXY(1.8,(3.5+$yy));
$pdf->SetFont('arial','',8);
$pdf->Cell(9.5, 0.8,iconv('UTF-8', 'windows-1252', trim(substr($nome_cao,0,31))) , 0 , 1 , 'L' );

$pdf->SetXY(2.0,(4.0+$yy));
$pdf->SetFont('arial','',8);
$pdf->Cell(9.5, 0.8,iconv('UTF-8', 'windows-1252', trim($raca.' '.$var)) , 0 , 1 , 'L' );

$pdf->SetXY(2.0,(4.5+$yy));
$pdf->SetFont('arial','',8);
$pdf->Cell(9.5, 0.8,iconv('UTF-8', 'windows-1252', trim($sexo)) , 0 , 1 , 'L' );


$pdf->SetXY(1.5,(4.9+$yy));
$pdf->SetFont('arial','',8);
$pdf->Cell(9.5, 0.8,iconv('UTF-8', 'windows-1252', trim($pai)) , 0 , 1 , 'L' );


$pdf->SetXY(1.7,(5.4+$yy));
$pdf->SetFont('arial','',8);
$pdf->Cell(9.5, 0.8,iconv('UTF-8', 'windows-1252', trim($mae)) , 0 , 1 , 'L' );


$pdf->SetXY(1,(6+$yy));
$pdf->SetFont('arial','',9);
//$pdf->Cell(9.5, 0.8,iconv('UTF-8', 'windows-1252', "Cachorro") , 0 , 1 , 'L' );



$pdf->SetXY(5.4,(4.5+$yy));
$pdf->SetFont('arial','',8);
$pdf->Cell(9.5, 0.8,iconv('UTF-8', 'windows-1252', str_replace('Escolha a cor..','',$cor)) , 0 , 1 , 'L' );

 
$pdf->Output("arquivo".$id.".pdf","D");
		//echo "<meta http-equiv='refresh' content='1;url=listagem_usuario.php'>";
?>
