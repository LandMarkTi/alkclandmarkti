<?php
require_once("../Connections/conexao.php");
$id = (int)$_GET['id'];

if(isset($_GET['code'])){
$qc="select * from rgc where qrcode='".$_GET['code']."' order by id desc";

$rcode=mysql_query($qc) or die('11');
$ncode=mysql_num_rows($rcode);
$dcode=mysql_fetch_assoc($rcode);
if($ncode<1)die('Não Encontrado.'); else $id=$dcode['id'];

}

$sql = "select * from rgc where id = $id";
$query = mysql_query($sql) or die (mysql_error());
$l = mysql_fetch_array($query);

if($_POST['id_trans']!=''){

$fotonome = $_FILES['foto']['name'];
$fototipo = $_FILES['foto']['type'];
$fototamanho = $_FILES['foto']["size"];
$fototemp = $_FILES['foto']['tmp_name'];

if($fotonome!=''){

$ext=substr($fotonome,-3,3);
if($ext!='jpg'&&$ext!='JPG'&&$ext!='png'&&$ext!='PNG'&&$ext!='gif')die('arquivo de imagem deve ser jpg ,png ou gif.');

if($fototamanho>2000000){die('Maximo de 2 Mb por foto');}

move_uploaded_file($fototemp,'../../rgc/'.$fotonome);


//resizeImage($_FILES['fot1']);

//chmod('../rgc/'.$fotonome, 0644);

mysql_query("update rgc set foto='../rgc/$fotonome' where id=".$_POST['id_trans'])or die('ee');
}

}


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
	position: absolute
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
<img src="../../rgc/<?php echo rawurlencode(substr($l['foto'],7,99)); ?>" id="foto"  />

<span id="RGC"><?php echo $id; ?></span>

<span id="microchip"><?php echo $l['microchip'];?></span>

<span id="nome"><?php echo $l['nome_cao'];?></span>

<span id="nascimento"><?php echo date("d-m-Y", strtotime($l['nascimento']));?></span>

<span id="raca"><?php echo $l['raca'];?></span>

<span id="cor"><?php echo $l['cor'];?></span>

<span id="sexo"><?php echo $l['sexo'];?></span>
<span id="pai"><?php echo $l['pai'];?></span>
<span id="mae"><?php echo $l['mae'];?></span>


</div>
<p align="center" style="width:300px;<?php if($_GET['view']=='web') echo 'display:none';?>">
<a href="#" onclick="alert('<?php echo $l['email'];?> \n Tel Residencial: <?php echo $l['tel_res']; ?>\n  Proprietário : <?php echo str_replace("'",'´',$l['nome']); ?>');" class="link noPrint">Encontrar meu dono</a>

<a class="link noPrint" href="#" onclick="window.print();">Imprimir</a>

<div class="noPrint" style="display: inline; position: relative;   left: 334px;top: -40px;<?php if($_GET['view']=='web') echo 'display:none';?>"><b class="noPrint">Foto : </b><form style="display:inline" method="post"  enctype="multipart/form-data"><input type="hidden" name="id_trans" value="<?=$id?>"><input type="file"  name="foto" class="noPrint"><input type="submit" class="link noPrint" value="enviar"></form></div>
</p><?php if($_GET['view']=='web') {?>
<a href="#" onclick="alert('<?php echo $l['email'];?> \n Tel Residencial: <?php echo $l['tel_res']; ?>\n  Proprietário : <?php echo str_replace("'",'´',$l['nome']); ?>');" class="link noPrint">Encontrar meu dono</a>
<?php }?>
</body>
</html>
