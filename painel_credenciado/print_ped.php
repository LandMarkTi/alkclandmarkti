<?php
session_start();

if($_SESSION['login']=='')die("<script>location='index.php';</script>");

//todo: inserir foto usando dados jpg na pasta sobraci para banco.

require('./fpdf17/fpdf.php');
//require_once("Connections/conexao.php");

$hostname_conexao = "opmy0031.servidorwebfacil.com";
$database_conexao = "megapedigree_com";
$username_conexao = "megap_com";
$password_conexao = "Companheiro3@10";
$conexao = mysql_pconnect($hostname_conexao, $username_conexao, $password_conexao) or die('');
mysql_select_db($database_conexao, $conexao);
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');


$pdf = new FPDF();
$pdf->SetMargins(5,5,5,5);


$border=0;
//consulta dados


$pgs=$_POST["pgs"];

$id =(int)$_POST['id'];

$busca_f=implode(',',$pgs);

if(isset($_GET['pgs'])){
$pgs=array("0" =>$_GET["pgs"]);


$id =(int)$_GET['id'];

}




//echo "id =".$id;


//ajuste cota
$subcota=(int)sizeof($pgs);

if($subcota<8)$cc=mysql_query("update dados_credenciado set cota=cota-$subcota where id_dados=".$_SESSION['id']);//

$t_cota=mysql_query("select * from dados_credenciado  where id_dados=".$_SESSION['id']);

$total_cota=mysql_fetch_array($t_cota);

if($total_cota['cota']<=0)die('<script>alert("Limite do Núcleo foi atingido, adicione mais no seu painel de Pedidos");history.go(-1);</script>');

//serie

$serie=(int)$_POST['serie'];

$str_serie=addslashes($_POST['serie']);


$sidd=(int)$_SESSION['id'];
if($sidd>0){

$idc=$_SESSION['id'];
//testa serie

$t_query=mysql_query("select * from ped_serie where numero_serie='$str_serie' and status='livre' and id_credenciado='$idc' ") or die('err_pedserie');
$nt=(int)mysql_num_rows($t_query);

if($nt>=1){/*ok para marcar */ mysql_query("update ped_serie set status='usado',id_ped='$id',id_filhote='$pgs[0]',data_add='".time()."' where numero_serie='$str_serie' and id_credenciado='$idc' "); }else {die('numero inválido ou usado');}
}else {

 die('sem serie');//if($serie>0)mysql_query("insert into ped_serie values('',$_SESSION[id],$id,$pgs[0],$serie,'0','usado',".time().")"); 

}


foreach($pgs as $key=>$value){//value
$verifica="select * from ped_vias2 where id_user=".$id ." and i_filhote =".$value;
$vr=mysql_query($verifica)or die('f1');
$fr=mysql_fetch_assoc($vr);
$nr=mysql_num_rows($vr);
if ($nr>0&&$fr['conta_via']>=4&&($_SESSION['id']!=44&&$_SESSION['id']!=43))die('<script>alert("Limite de impressão atingido!");history.go(-1);</script>');
if ($nr>0&&($fr['conta_via']<4||$_SESSION['id']==44||$_SESSION['id']==43))mysql_query('update ped_vias2 set conta_via=conta_via+1 where id_user='.$id." and i_filhote =".$value);else mysql_query("insert into ped_vias2 values('',$id,".time().",".$_SESSION['id'].",1,$value)");
}

//die('fim');

$sql1="select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$id;
$qr1=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr1);
$cattxt=$linha_ped['regrasublocal'];



//if($_SESSION['id']!=44&&($linha_ped['nomeSubcategoria']=='Old English Bulldog'))die('Raca Nao permitida!');


//puxar o id criador join credenciado e pegar o uso_canil ,colocando antes ou depois
$pref='';
$sulf='';

$sql_add="select * from criadores where id_criador=".$linha_ped['id_criador'];
$qr_criador=mysql_query($sql_add);
$fc=mysql_fetch_assoc($qr_criador);

if($fc['uso_canil']=='sulfixo')$sulf=' '.$fc['nome_completo'].' '; else $pref=' '.$fc['nome_completo'].' ';


//caso externo

if(substr($linha_ped['registro'],0,3)=='RGE'||substr($linha_ped['registro'],0,4)=='RGEO'){$sulf='';$pref='';}



$linha_ped['nasc']=date("d/m/Y",$linha_ped['nasc']);

$linha_ped['emissao']=date("d/m/Y",$linha_ped['emissao']);

//$linha_ped['endereco']=substr($linha_ped['endereco'],0,60);

//loop filhotes

$nloop=explode(';', $linha_ped['ninhada']);

$pf=$value;
$cf=0;
foreach($nloop as $k => $v){ if($k>3 &&$k!=$pf&& $v!='nome filhote')$cf++;else if($k>3)break; }

//ajustes

//$e1x=array_shift($nloop);
//$e2x=array_shift($nloop);
//$e3x=array_shift($nloop);
//$e4x=array_shift($nloop);

$lista_nomes=$nloop;

$sx=explode(';',$linha_ped['sexo']);
$cor=explode(';', $linha_ped['cor']);
$micro=explode(';', $linha_ped['nº microchip']);
while($ele=array_shift($pgs)){
$coratual=iconv('UTF-8', 'windows-1252', $cor[$ele-4]);
$sexoatual=iconv('UTF-8', 'windows-1252', $sx[$ele-4]);
$linha_ped['nº microchip']=$micro[$ele-4];


$pdf->AddPage();
$pdf->SetFont('Arial','B',8);

$linha_ped['nome']=$pref.$lista_nomes[$ele].$sulf;

//transf
$tr="select * from pedigre_trocados where id_ped=$id and id_f=$ele order by id_ped desc";

$r_t=mysql_query($tr);
$ft=mysql_fetch_assoc($r_t);
$nt=mysql_num_rows($r_t);

if($nt>=1){
$linha_ped['endereco']=mb_strtoupper(trim($ft['endereco']), 'UTF-8');
$linha_ped['proprietario']=mb_strtoupper(trim($ft['proprietario']), 'UTF-8');
}


if($sexoatual=='Masc')$linha_ped['genero']='MACHO'; else $linha_ped['genero']='FEMEA';
//$linha_ped['variedade']=iconv('UTF-8', 'windows-1252', $coratual);
$linha_ped['registro']=$linha_ped['registro'].$cf;//só por um indice .$ele
$linha_ped['regrasublocal']=html_entity_decode(strip_tags($linha_ped['regrasublocal']),ENT_QUOTES,'UTF-8');

//consulta dos campos utf8_decode
$sql="SELECT * FROM `gabarito_crg` where id_gab<>17 and id_gab<>16";
$qr=mysql_query($sql);
while($l=mysql_fetch_assoc($qr)){
$pdf->SetFont('Arial','B',$l['tam']);
$pdf->SetXY($l['px'],$l['py']);
$pdf->MultiCell($l['largura'],$l['altura'],iconv('UTF-8', 'windows-1252', mb_strtoupper($linha_ped[$l['nome']], 'UTF-8')),$border,'c',false);

}
//cor 

$pdf->SetFont('Arial','B',8);
$pdf->SetXY(83,39);
$pdf->Cell(55,10,mb_strtoupper($coratual, 'ISO-8859-1'),$border,0,'c');


//4	104	33	95 

$i=1;
$offx=5;//borda
$largs=array(0,32,37,38,82);
$p=explode(';',iconv('UTF-8', 'windows-1252', $linha_ped['parentes']));

$tamanhoInicial=8;
while($i<=4){
	$j=0;
	$offx+=$largs[$i-1]+2;
	$pdf->SetFont('Arial','B',$tamanhoInicial);
	while($j<pow(2,$i)){
		$pdf->SetXY($offx,105.5+((95/pow(2,$i))+0.2)*$j);
		//echo "<br>x:".$offx." Y:".(106.5+(95/16)*$j).'p:'.pow(2,$i);
		$pdf->MultiCell($largs[$i],3,mb_strtoupper(str_pad(str_replace('digite o nome..','XXXXXXXXXXXXXXX',array_shift($p)),50,' '),'ISO-8859-1'),$border,'L');//era 56
		//$pdf->MultiCell($largs[$i],95/16,'off',$border,'L');//era 56
		$j++;
	}
	if($tamanhoInicial>6)$tamanhoInicial--;
	$i++;
}

	$pdf->SetFont('Arial','B',6);
$n=explode(';',iconv('UTF-8', 'windows-1252', $linha_ped['ninhada']));
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
$pdf->SetFont('Arial','B',6);

$largs=array(0,0,7,8,29.5,29.5,29.5,28.5,29.5);
$h=5;

$i=1;
$px=42.5;
while($i<=7){
$j=0;
$px+=$largs[$i]+0;
while($j<4){
		
		$pdf->SetXY($px,79.0+5.0*$j);
		$pdf->Cell($largs[$i+1],5.0,substr(str_replace('NOME FILHOTE','XXXX',mb_strtoupper(array_shift($n),'ISO-8859-1')),0,19),$border,0,'c');
		$j++;}


$i++;

}



//texto ped

$pdf->SetFont('Arial','B',8);

$pdf->SetXY(7,205);
$pdf->MultiCell(195,3,iconv('UTF-8', 'windows-1252', substr(str_replace("\n","",$linha_ped['regrasublocal']),0,3200)),$border,'L');

//foto
$sql_fot="SELECT * FROM  `foto_ped` where id_ped=$id and id_f=".($value-4)." ORDER BY id_foto DESC";
$qrf=mysql_query($sql_fot);
$lin=mysql_fetch_assoc($qrf);
$nnn=mysql_num_rows($qrf);
if($nnn>=1)$pdf->Image('./images/pedigree/'.rawurldecode($lin['arquivo']),8,67,32,32);
}



$pdf->Output();

?>
