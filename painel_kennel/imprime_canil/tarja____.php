<?php
require_once("fpdf.php");
require_once("../Connections/conexao.php");
$id = (int)$_GET['id'];

$id_f=(int)$_GET['id_f'];


$sql = "select * from pedigree  where id_ped = $id ";
$query = mysql_query($sql) or die (mysql_error());
$l = mysql_fetch_array($query);

$nncode=mysql_num_rows($query);
if($nncode<1)die('Não Encontrado.');


$l['crmv']='-';

//canil

$sqlc = "select * from criadores  where id_criador = $l[id_criador] ";
$queryc = mysql_query($sqlc) or die (mysql_error());
$lc = mysql_fetch_array($queryc);

if($lc['uso_canil']=='sulfixo')$sulf=' '.$lc['nome_completo'].' '; else $pref=' '.$lc['nome_completo'].' ';

//$canil=$lc['nome_completo'];


$qrr=mysql_query('select * from subcategoria where idSubcategoria='.$l['id_raca']);

$lraca=mysql_fetch_assoc($qrr);

$raca=$lraca['nomeSubcategoria'];

$cor=explode(';',$l['cor']);

$cor=$cor[$id_f-4];

$ninhada=explode(';',$l['ninhada']);

$nome_cao=$ninhada[$id_f];

$sexo=explode(';',$l['sexo']);

$sexo=$sexo[$id_f-4];

$micro=explode(';',$l['nº microchip']);

$micro=$micro[$id_f-4];

$vp=explode(';',$l['parentes']);


$pai=$vp[0];

$mae=$vp[1];


//tirando o final

$vpai = explode(' ', $pai);
if (count($vpai) >= 2) {
    array_pop($vpai);
    if(end($vpai)=='RGE' || end($vpai)=='RGEO')array_pop($vpai);
}
$pai = substr(implode(' ', $vpai),0,30);

$vmae = explode(' ', $mae);
if (count($vmae) >= 2) {
    array_pop($vmae);
    if(end($vmae)=='RGE' || end($vmae)=='RGEO')array_pop($vmae);
}
$mae = substr(implode(' ', $vmae),0,30);


$nasc=date("d/m/Y",$l['nasc']);

//if($l['pago']==1)die('Pagamento Pendente. ');
$pdf= new FPDF("P","cm",array(21,30));
 
 
$pdf->SetMargins(2,2,2,2);

$pdf->AddPage();
 
$file='https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=http://rgpetsystem.club/ver_carteirinha.php?id='.$id;



//copy($file, './qr/code.jpg');




$pdf->Image('qr.png',14.0, 0.8 , 4 , 4,'PNG');

$sql_fot="SELECT * FROM  `tarja` where id_ped=".$id." and id_f=".($id_f-4)." ORDER BY id_foto DESC";
$qrf=mysql_query($sql_fot);
$lin=mysql_fetch_assoc($qrf);
$nnn=mysql_num_rows($qrf);
if($nnn>=1)$pt='../images/pedigree/'.$lin['arquivo'];


if(is_file($pt)==true)$pdf->Image($pt,0.6, 0.6 , 3 , 3);

$pdf->SetXY(4.9,2.0);
$pdf->SetFont('arial','',9);
$pdf->Cell(5.6, 0.7,iconv('UTF-8', 'windows-1252', $l['registro'].($id_f-4)) , 0 , 1 , 'L' );


$pdf->SetXY(5.4,2.5);
$pdf->SetFont('arial','',9);
$pdf->Cell(5.5, 0.8,iconv('UTF-8', 'windows-1252', $micro) , 0 , 1 , 'L' );



$pdf->SetXY(5.7,3.0);
$pdf->SetFont('arial','',9);
$pdf->Cell(5.5, 0.8,iconv('UTF-8', 'windows-1252', trim($l['amigo'])) , 0 , 1 , 'L' );

$pdf->SetXY(8.1,3.5);
$pdf->SetFont('arial','',9);
$pdf->Cell(3.5, 0.8,iconv('UTF-8', 'windows-1252', trim($nasc)) , 0 , 1 , 'L' );


$pdf->SetXY(1.8,3.5);
$pdf->SetFont('arial','',9);
$pdf->Cell(9.5, 0.8,iconv('UTF-8', 'windows-1252', trim(substr($pref.$nome_cao.$sulf,0,28))) , 0 , 1 , 'L' );

$pdf->SetXY(2.0,4.0);
$pdf->SetFont('arial','',9);
$pdf->Cell(9.5, 0.8,iconv('UTF-8', 'windows-1252', trim($raca)) , 0 , 1 , 'L' );

$pdf->SetXY(2.0,4.5);
$pdf->SetFont('arial','',9);
$pdf->Cell(9.5, 0.8,iconv('UTF-8', 'windows-1252', trim($sexo)) , 0 , 1 , 'L' );


$pdf->SetXY(1.5,4.9);
$pdf->SetFont('arial','',9);
$pdf->Cell(9.5, 0.8,iconv('UTF-8', 'windows-1252', trim($pai)) , 0 , 1 , 'L' );


$pdf->SetXY(1.7,5.4);
$pdf->SetFont('arial','',9);
$pdf->Cell(9.5, 0.8,iconv('UTF-8', 'windows-1252', trim($mae)) , 0 , 1 , 'L' );


$pdf->SetXY(1,6);
$pdf->SetFont('arial','',9);
$pdf->Cell(9.5, 0.8,iconv('UTF-8', 'windows-1252', "Cachorro") , 0 , 1 , 'L' );



$pdf->SetXY(5.4,4.5);
$pdf->SetFont('arial','',9);
$pdf->Cell(9.5, 0.8,iconv('UTF-8', 'windows-1252', $cor) , 0 , 1 , 'L' );

 
$pdf->Output("arquivo".$id.".pdf","D");
		//echo "<meta http-equiv='refresh' content='1;url=listagem_usuario.php'>";
?>
