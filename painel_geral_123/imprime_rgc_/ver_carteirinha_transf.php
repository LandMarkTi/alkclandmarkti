<?php
require_once("../Connections/conexao.php");
$id = (int)$_GET['id'];

if($_POST){

$id_trans=$_POST['id_trans'];

$fotonome = $_FILES['foto']['name'];
$fototipo = $_FILES['foto']['type'];
$fototamanho = $_FILES['foto']["size"];
$fototemp = $_FILES['foto']['tmp_name'];

if($fotonome!=''){

$ext=substr($fotonome,-3,3);
if($ext!='jpg'&&$ext!='JPG'&&$ext!='png'&&$ext!='PNG'&&$ext!='gif')die('arquivo de imagem deve ser jpg ,png ou gif.');

if($fototamanho>4000000){die('Maximo de 4 Mb por foto');}

move_uploaded_file($fototemp,'../../rgc/'.$fotonome);


//resizeImage($_FILES['fot1']);

//chmod('../rgc/'.$fotonome, 0644);

mysql_query("insert into cart values('','$id_trans','$f','../../rgc/$fotonome')")or die('ee');
}

}

$sql = "select * from pedigre_trocados_capa join pedigree using(id_ped) where id_trans_capa = $id";
$query = mysql_query($sql) or die (mysql_error());
$l = mysql_fetch_array($query);


$tr="select * from pedigre_trocados_capa where id_ped=".$l['id_ped']." and id_f=".$l['id_f']." order by id_ped desc";

$r_t=mysql_query($tr);
$ft=mysql_fetch_assoc($r_t);
$nt=mysql_num_rows($r_t);

//die($tr);
if($nt>=1){
$l['endereco']=$ft['endereco'];
$l['proprietario']=$ft['proprietario'];
$l['tel_t']=$ft['tel_t'];
}

$qrr=mysql_query('select * from subcategoria where idSubcategoria='.$l['id_raca']);

$lraca=mysql_fetch_assoc($qrr);

$raca=$lraca['nomeSubcategoria'];

$cor=explode(';',$l['cor']);

$cor=$cor[$l['id_f']-4];

$sexo=explode(';',$l['sexo']);

$sexo=$sexo[$l['id_f']-4];

$vp=explode(';',$l['parentes']);


$pai=$vp[0];

$mae=$vp[1];

//foto

$qf=mysql_query('select * from cart where id_ped='.$id.' order by id_land desc') or die('dd');

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
	background-image:url(rgc.png);
	background-repeat:no-repeat;
	width:800px;
	height:512px;
	font-family:Arial, Helvetica, sans-serif;
	font-size:18px;
	font-weight:bold;
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
	margin-left: 408px;
}
#nome{
	margin-top:250px;
	margin-left:120px;
}
#nascimento{
	margin-top:250px;
	margin-left:590px;
}
#raca{
	margin-top:290px;
	margin-left:110px;
}
#cor{
	margin-top:290px;
	margin-left:450px;
}
#sexo{
	margin-top:330px;
	margin-left:110px;
	}
#pai{
	margin-top:370px;
	margin-left:85px;
}
#mae{
	margin-top:415px;
	margin-left:95px;
}
#foto{
	width: 300px;
	height: 220px;
	margin-top: 10px;
	margin-left: 10px;
	position: absolute;
	
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

</style>
</head>

<body>
<div id="fundo">
<?php if($nf>=1){?><img src="<?php echo $lf['foto']; ?>" id="foto"  /><?php }?>

<span id="RGC"><?php echo 'RG/T '.$id; ?></span>

<span id="microchip"><?php echo $l['mic'];?></span>

<span id="nome"><?php echo $l['nome_cao'];?></span>

<span id="nascimento"><?php echo date("d-m-Y", $l['nasc']);?></span>

<span id="raca"><?php echo $raca;?></span>

<span id="cor"><?php echo $cor;?></span>

<span id="sexo"><?php echo $sexo;?></span>
<span id="pai"><?php echo $pai;?></span>
<span id="mae"><?php echo $mae;?></span>


</div>
<p align="center" style="width:300px;<?php if($_GET['view']=='web') echo 'display:none';?>">
<a href="#" onclick="alert('<?php echo $l['email_t'];?> \n Tel Residencial: <?php echo $l['tel_t']; ?>\n  Proprietário : <?php echo str_replace("'",'´',$l['proprietario']); ?>');" class="link noPrint">Encontrar meu dono</a>

<a class="link noPrint" href="#" onclick="window.print();">Imprimir</a>

<div class="noPrint" style="display: inline; position: relative;   left: 334px;top: -40px;<?php if($_GET['view']=='web') echo 'display:none';?>"><b class="noPrint">Foto : </b><form style="display:inline" method="post"  enctype="multipart/form-data"><input type="hidden" name="id_trans" value="<?=$id?>"><input type="file"  name="foto" class="noPrint"><input type="submit" class="link noPrint" value="enviar"></form></div>
</p>
<?php if($_GET['view']=='web') {?>
<a href="#" onclick="alert('<?php echo $l['email_t'];?> \n Tel Residencial: <?php echo $l['tel_t']; ?>\n  Proprietário : <?php echo str_replace("'",'´',$l['proprietario']); ?>');" class="link noPrint">Encontrar meu dono</a>
<?php }?>
</body>
</html>
