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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RGC</title>
<style>
#fundo {
	background-image:url(rgc2.png);
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
	margin-top:264px;
	margin-left:144px;
}
#nascimento{
	margin-top:264px;
	margin-left:614px;
}
#raca{
	margin-top:304px;
	margin-left:134px;
}
#cor{
	margin-top:350px;
	margin-left:474px;
}
#sexo{
	margin-top:344px;
	margin-left:134px;
	}
#pai{
	margin-top:384px;
	margin-left:110px;
}
#mae{
	margin-top:430px;
	margin-left:120px;
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
<img src="../../rgc/<?php echo rawurlencode(substr($l['foto'],7)); ?>" id="foto"  />

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
<p align="center" style="width:300px;">
<a href="#" onclick="alert('<?php echo $l['email'];?> \n Tel Residencial: <?php echo $l['tel_res']; ?>\n Tel Comercial : <?php echo $l['tel_com']; ?>\n Celular : <?php echo $l['celular']; ?>');" class="link">Encontrar meu dono</a>
</p>
</body>
</html>
