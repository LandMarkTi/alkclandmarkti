<?php
require_once("fpdf.php");
session_start();
require_once("../Connections/conexao.php");
$id=(int)$_SESSION['cid'];

$sql = "SELECT * FROM pedigre_trocados_capa WHERE id_trans_capa=$id";
$query = mysql_query($sql) or die(mysql_error());
$linha = mysql_fetch_array($query);


if($linha['id_trans_capa']>0){

$q_dog=mysql_query("select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$linha['id_ped']);
$ld = mysql_fetch_array($q_dog);


$sql_add="select * from criadores where id_criador=".$ld['id_criador'];
$qr_criador=mysql_query($sql_add);
$fc=mysql_fetch_assoc($qr_criador);


if($fc['uso_canil']=='sulfixo')$sulf=' '.$fc['nome_completo'].' '; else $pref=' '.$fc['nome_completo'].' ';



$nome=explode(';',$ld['ninhada']);

$nomedog=$pref.$nome[$linha['id_f']].$sulf;






$c=explode(';',$ld['cor']);
$cor=$c[$linha['id_f']-4];

$s=explode(';',$ld['sexo']);

$ss=$s[$linha['id_f']-4];

$rac=$ld['nomeSubcategoria'];


$vp=explode(';',$ld['parentes']);

//
$pai=$vp[0];

$mae=$vp[1];

}
if(substr($l['crmv'],0,1)=='L'||substr($l['crmv'],0,1)=='O'||substr($l['crmv'],0,1)=='C')$l['crmv']='-';



//if($l['pago']==1)die('Pagamento Pendente. ');
$pdf= new FPDF("P","mm",array(210,295));
 
 
//$pdf->SetMargins(2,2,2,2);

$pdf->AddPage(L);
 

//não prpecisa do rawurl
//$file='https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=http://rgpetsystem.club/ver_carteirinha.php?id='.$id;

$file='frente.jpg';






$pdf->Image($file,8, 10 , 280 , 188,'jpg');



//if(is_file('../'.$l['foto']))$pdf->Image('../'.$l['foto'],0.6, 0.6 , 3 , 3);

$pdf->SetXY(180,30);
$pdf->SetFont('arial','',11);
$pdf->Cell(50, 10,iconv('UTF-8', 'windows-1252', $id) , 0 , 1 , 'L' );


$pdf->SetXY(239,30);
$pdf->SetFont('arial','',11);
$pdf->Cell(50, 10,iconv('UTF-8', 'windows-1252', trim($linha['amigo'])) , 0 , 1 , 'L' );



$pdf->SetXY(180,44);
$pdf->SetFont('arial','',11);
$pdf->Cell(80, 10,iconv('UTF-8', 'windows-1252', trim($nomedog)) , 0 , 1 , 'L' );


$pdf->SetXY(180,58);
$pdf->SetFont('arial','',11);
$pdf->Cell(80, 10,iconv('UTF-8', 'windows-1252', 'Canino') , 0 , 1 , 'L' );



$pdf->SetXY(180,72);
$pdf->SetFont('arial','',11);
$pdf->Cell(80, 10,iconv('UTF-8', 'windows-1252', date('d/m/Y',$ld['nasc'])) , 0 , 1 , 'L' );



$pdf->SetXY(239,72);
$pdf->SetFont('arial','',11);
$pdf->Cell(50, 10,iconv('UTF-8', 'windows-1252', trim($ss)) , 0 , 1 , 'L' );



$pdf->SetXY(180,86);
$pdf->SetFont('arial','',11);
$pdf->Cell(90, 10,iconv('UTF-8', 'windows-1252', trim($rac)) , 0 , 1 , 'L' );



$pdf->SetXY(180,100);
$pdf->SetFont('arial','',11);
$pdf->Cell(90, 10,iconv('UTF-8', 'windows-1252', trim($cor)) , 0 , 1 , 'L' );



$pdf->SetXY(180,114);
$pdf->SetFont('arial','',11);
$pdf->Cell(80, 10,iconv('UTF-8', 'windows-1252', $linha['mic']) , 0 , 1 , 'L' );




$pdf->SetXY(180,142);
$pdf->SetFont('arial','',11);
$pdf->Cell(80, 10,iconv('UTF-8', 'windows-1252', $ld['registro'].($linha['id_f']-4)) , 0 , 1 , 'L' );



//dentro

$pdf->AddPage(L);
 

//não prpecisa do rawurl
//$file='https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=http://rgpetsystem.club/ver_carteirinha.php?id='.$id;

$file='dentro.jpg';






$pdf->Image($file,8, 10 , 280 , 188,'jpg');




 
$pdf->Output("arquivo".$id.".pdf","D");
		//echo "<meta http-equiv='refresh' content='1;url=listagem_usuario.php'>";
?>
