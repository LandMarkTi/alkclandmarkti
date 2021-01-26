<?php
error_reporting(1);
session_start();

//todo: inserir foto usando dados jpg na pasta sobraci para banco.

//require('./fpdf17/fpdf.php');
require_once("Connections/conexao.php");



$border=0;
//consulta dados

if(isset($_GET['code'])){

$code = $_GET['code'];
$code = (int)$code;
if ($code>10000){
$sql = "select * from rgc where qrcode='$code'";
$query = mysql_query($sql) or die (mysql_error());
$l = mysql_fetch_array($query);
$id_rgc = $l[0];

header ("location: http://www.megapedigree.com.br/painel_geral_123/imprime_rgc/ver_carteirinha.php?id=$id_rgc");	

}
	

$qc="select * from qrcode where qrcode=".$_GET['code'].' order by id_code desc';

$rcode=mysql_query($qc);
$ncode=mysql_num_rows($rcode);
$dcode=mysql_fetch_assoc($rcode);

if($ncode<1)die('Código não encontrado.');

$pgs=(int)$dcode["id_filhote"];

//$busca_f=Array("$pgs");

$id =(int)$dcode['id_ped'];
}else{

$pgs=(int)$_GET["id_filhote"];



$id =(int)$_GET['id_ped'];

}

//echo "id =".$id;

//echo "insert into ped_vias values('',$id,".time().",".$_SESSION['id'].",1)";



//inicio

echo "<html><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><body style='font-size: 9;'><div style=\"background-image:url('http://www.sobraci.org/c/fundo.jpg');background-size:100%;width:21cm;height:30cm\">";

$sql1="select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$id;
$qr1=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr1);
$cattxt=$linha_ped['regrasublocal'];

$linha_ped['nasc']=date("d/m/Y",$linha_ped['nasc']);

$linha_ped['emissao']=date("d/m/Y",$linha_ped['emissao']);

//loop filhotes

$nloop=explode(';', $linha_ped['ninhada']);

//puxar o id criador join credenciado e pegar o uso_canil ,colocando antes ou depois
$pref='';
$sulf='';

$sql_add="select * from criadores where id_criador=".$linha_ped['id_criador'];
$qr_criador=mysql_query($sql_add);
$fc=mysql_fetch_assoc($qr_criador);

if($fc['uso_canil']=='sulfixo')$sulf=' '.$fc['nome_completo'].' '; else $pref=' '.$fc['nome_completo'].' ';



//ajustes

//$e1x=array_shift($nloop);
//$e2x=array_shift($nloop);
//$e3x=array_shift($nloop);
//$e4x=array_shift($nloop);

$lista_nomes=$nloop;

$sx=explode(';',$linha_ped['sexo']);
$cor=explode(';', $linha_ped['cor']);

//while($ele=array_shift($pgs)){

$ele=$pgs;
$coratual= $cor[$ele-4];
$sexoatual=$sx[$ele-4];

//transf
$tr="select * from pedigre_trocados where id_ped=$id and id_f=$pgs order by id_ped desc";

$r_t=mysql_query($tr);
$ft=mysql_fetch_assoc($r_t);
$nt=mysql_num_rows($r_t);

if($nt>=1){
$linha_ped['endereco']=$ft['endereco'];
$linha_ped['proprietario']=$ft['proprietario'];
}

//$pdf->AddPage();
//$pdf->SetFont('Arial','B',8);

$linha_ped['nome']=$pref.$lista_nomes[$ele].$sulf;

if($sexoatual=='Macho')$linha_ped['genero']='MACHO'; else $linha_ped['genero']='FEMEA';
$linha_ped['variedade']= $coratual;
$linha_ped['registro']=$linha_ped['registro'].'-'.$ele;//só por um indice .$ele
$linha_ped['regrasublocal']=html_entity_decode(strip_tags($linha_ped['regrasublocal']),ENT_QUOTES,'UTF-8');
//consulta dos campos utf8_decode
$sql="SELECT * FROM `gabarito_crg` where id_gab<>17 and id_gab<>16";
$qr=mysql_query($sql);
while($l=mysql_fetch_assoc($qr)){

//$pdf->SetXY($l['px'],$l['py']);
//$pdf->Cell($l['largura'],$l['altura'],strtoupper(iconv('UTF-8', 'windows-1252', $linha_ped[$l['nome']])),$border,0,'c');
echo "<div style='position:absolute;left:".$l['px']."mm;top:".$l['py']."mm;width:".$l['largura']."mm;height:".$l['altura']."mm'>".$linha_ped[$l['nome']]."</div>";

}
//cor 

//$pdf->SetXY(83,39);
//$pdf->Cell(55,10,strtoupper(iconv('UTF-8', 'windows-1252', $coratual)),$border,0,'c');
echo "<div style='position:absolute;left:83mm;top:39mm;width:55mm;height:10mm'>".strtoupper( $coratual)."</div>";

//4	104	33	95 

$i=1;
$offx=5;//borda
$largs=array(0,32,37,38,82);
$p=explode(';', $linha_ped['parentes']);

$tamanhoInicial=8;
while($i<=4){
	$j=0;
	$offx+=$largs[$i-1]+2;
	//$pdf->SetFont('Arial','B',$tamanhoInicial);
	while($j<pow(2,$i)){
		//$pdf->SetXY($offx,105.5+((95/pow(2,$i))+0.2)*$j);
		//$pdf->MultiCell($largs[$i],95/16,strtoupper(str_pad(str_replace('digite o nome..','XXXXXXXXXXXXXXX',array_shift($p)),50,' ')),$border,'L');//era 56
		echo "<div style='position:absolute;left:".$offx."mm;top:".(105.5+((95/pow(2,$i))+0.2)*$j)."mm;width:".$largs[$i]."mm;height:".(95/16)."mm'>".strtoupper(str_pad(str_replace('digite o nome..','XXXXXXXXXXXXXXX',array_shift($p)),50,' '))."</div>";
		$j++;
	}
	if($tamanhoInicial>6)$tamanhoInicial--;
	$i++;
}

	//$pdf->SetFont('Arial','B',6);
$n=explode(';',$linha_ped['ninhada']);
//ajustes
$e1=array_shift($n);
$e2=array_shift($n);
$e3=array_shift($n);
$e4=array_shift($n);



array_unshift($n,$e4);

array_unshift($n,'');

array_unshift($n,$e2);

array_unshift($n,'');

array_unshift($n,$e3);

array_unshift($n,'');

array_unshift($n,$e1);

array_unshift($n,'');


//39 	76 	167 	22
//$pdf->SetFont('Arial','B',6);

$largs=array(0,0,8,8,29.5,29.5,29.5,28.5,29.5);
$h=5;

$i=1;
$px=42.5;
while($i<=7){
$j=0;
$px+=$largs[$i]+0;
while($j<4){
		
		//$pdf->SetXY($px,79.0+5.0*$j);
		//$pdf->Cell($largs[$i+1],5.0,substr(str_replace('NOME FILHOTE','',strtoupper(array_shift($n))),0,20),$border,0,'c');
		echo "<div style='position:absolute;left:".$px."mm;top:".(79.0+6.0*$j)."mm;width:".$largs[$i+1]."mm;height:6mm'>".substr(str_replace('NOME FILHOTE','XXX',strtoupper(array_shift($n))),0,20)."</div>";
		$j++;}


$i++;

}



//texto ped

//$pdf->SetFont('Arial','B',5);

//$pdf->SetXY(7,205);
//$pdf->MultiCell(195,5,iconv('UTF-8', 'windows-1252', str_replace("\n","",$linha_ped['regrasublocal'])),$border,'L');
		echo "<div style='position:absolute;left:7mm;top:205mm;width:195mm;height:6mm'>". str_replace("\n","",$linha_ped['regrasublocal'])."</div>";


//foto
$sql_fot="SELECT * FROM  `foto_ped` where id_ped=$id ORDER BY id_foto DESC";
$qrf=mysql_query($sql_fot);
$lin=mysql_fetch_assoc($qrf);
$nnn=mysql_num_rows($qrf);
if($nnn>=1)//$pdf->Image('./images/pedigree/'.rawurldecode($lin['arquivo']),8,67,32,32);




//$pdf->Output();
echo "</body></html>";

?>
