<?php
require_once("./rgp/Connections/conexao.php");
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

$nncode=mysql_num_rows($query);
if($nncode<1)die('Não Encontrado.');

if($l['pago']==1)die('Pagamento Pendente. ');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RGC</title>
<style>
#fundo {
	background-image:url(rgp/REPETFRENTETIPO.png?v=2);
	background-repeat: no-repeat;
	background-size: cover;
	width: 532px;
	height: 396px;
	font-family:Arial, Helvetica, sans-serif;
	font-size:18px;
	font-weight:bold;
}
#fundo span{
	position:absolute;
}
#RGC{
	margin-left: 240px;
	margin-top: 128px;
}
#microchip{
	margin-top: 153px;
	margin-left: 261px;

}
#nome{
	margin-top: 199px;
	margin-left: 114px;
}
#tipo{
	margin-top: 225px;
	margin-left: 104px;
}
#nascimento{
	margin-top: 200px;
	margin-left: 400px;
}
#raca{
	margin-top: 245px;
	margin-left: 114px;
}
#cor{
	margin-top: 270px;
	margin-left: 290px;
}
#sexo{
	margin-top: 271px;
	margin-left: 111px;
	}
#pai{
	margin-top: 297px;
	margin-left: 89px;
}
#mae{
	margin-top: 323px;
	margin-left: 99px;
}
#cr{
	margin-top: 179px;
	margin-left: 270px;
    	color: black;
}
#foto{
	width: 140px;
	height: 140px;
	margin-top: 45px;
	margin-left: 45px;
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
<img src="./rgc/<?php echo rawurlencode(substr($l['foto'],7)); ?>" id="foto"  />

<span id="RGC"><?php echo $id; ?></span>

<span id="microchip"><?php echo $l['microchip'];?></span>

<span id="nome"><?php echo substr($l['nome_cao'],0,21);?></span>

<span id="tipo"><?php echo $l['tipo'];?></span>

<span id="nascimento"><?php echo date("d-m-Y", strtotime($l['nascimento']));?></span>

<span id="raca"><?php echo $l['raca'];?></span>

<span id="cor"><?php echo $l['cor'];?></span>

<span id="sexo"><?php echo $l['sexo'];?></span>
<span id="pai"><?php echo $l['pai'];?></span>
<span id="mae"><?php echo $l['mae'];?></span>
<span id="cr"><?php echo $l['crmv'];?></span>

</div>
<p align="center" style="width:300px;">
<a href="#" onclick="alert('<?php echo $l['email'];?> \n Tel Residencial: <?php echo $l['tel_res']; ?>\n Tel Comercial : <?php echo $l['tel_com']; ?>\n Celular : <?php echo $l['celular']; ?>');" class="link">Encontrar meu dono</a>
</p>
</body>
</html>
