<?php
session_start();

if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");


$id_ped=(int)$_POST['id'];

$f=(int)$_POST['idf'];

$p=(int)$_POST['preco'];

mysql_query("delete from ped_land where id_ped=$id_ped and id_f=$f ");

$fotonome = $_FILES['fot1']['name'];
$fototipo = $_FILES['fot1']['type'];
$fototamanho = $_FILES['fot1']["size"];
$fototemp = $_FILES['fot1']['tmp_name'];

if($fotonome!=''){

$ext=substr($fotonome,-3,3);
if($ext!='jpg'&&$ext!='JPG'&&$ext!='png'&&$ext!='PNG'&&$ext!='gif')die('arquivo de imagem deve ser jpg ,png ou gif.');

if($fototamanho>3000000){die('Maximo de 1 Mb por foto');}

move_uploaded_file($fototemp,'../rgc/'.$fotonome);



chmod('../rgc/'.$fotonome, 0644);

mysql_query("insert into ped_land values('','$id_ped','$f','$fotonome')")or die('ee');
}

$fotonome = $_FILES['fot2']['name'];
$fototipo = $_FILES['fot2']['type'];
$fototamanho = $_FILES['fot2']["size"];
$fototemp = $_FILES['fot2']['tmp_name'];


if($fotonome!=''){

$ext=substr($fotonome,-3,3);
if($ext!='jpg'&&$ext!='JPG'&&$ext!='png'&&$ext!='PNG'&&$ext!='gif')die('arquivo de imagem deve ser jpg ,png ou gif.');

if($fototamanho>3000000){die('Maximo de 1 Mb por foto');}


move_uploaded_file($fototemp,'../rgc/'.$fotonome);

chmod('../rgc/'.$fotonome, 0644);

mysql_query("insert into ped_land values('','$id_ped','$f','$fotonome')")or die('ee');
}

$fotonome = $_FILES['fot3']['name'];
$fototipo = $_FILES['fot3']['type'];
$fototamanho = $_FILES['fot3']["size"];
$fototemp = $_FILES['fot3']['tmp_name'];

if($fotonome!=''){

$ext=substr($fotonome,-3,3);
if($ext!='jpg'&&$ext!='JPG'&&$ext!='png'&&$ext!='PNG'&&$ext!='gif')die('arquivo de imagem deve ser jpg ,png ou gif.');

if($fototamanho>3000000){die('Maximo de 1 Mb por foto');}


move_uploaded_file($fototemp,'../rgc/'.$fotonome);

chmod('../rgc/'.$fotonome, 0644);

mysql_query("insert into ped_land values('','$id_ped','$f','$fotonome')")or die('ee');
}


$fotonome = $_FILES['fot4']['name'];
$fototipo = $_FILES['fot4']['type'];
$fototamanho = $_FILES['fot4']["size"];
$fototemp = $_FILES['fot4']['tmp_name'];

if($fotonome!=''){

$ext=substr($fotonome,-3,3);
if($ext!='jpg'&&$ext!='JPG'&&$ext!='png'&&$ext!='PNG'&&$ext!='gif')die('arquivo de imagem deve ser jpg ,png ou gif.');

if($fototamanho>3000000){die('Maximo de 1 Mb por foto');}


move_uploaded_file($fototemp,'../rgc/mm_'.$fotonome);

chmod('../rgc/'.$fotonome, 0644);

mysql_query("insert into ped_land values('','$id_ped','$f','mm_$fotonome')")or die('ee');
}

$fotonome = $_FILES['fot5']['name'];
$fototipo = $_FILES['fot5']['type'];
$fototamanho = $_FILES['fot5']["size"];
$fototemp = $_FILES['fot5']['tmp_name'];

if($fotonome!=''){

$ext=substr($fotonome,-3,3);
if($ext!='jpg'&&$ext!='JPG'&&$ext!='png'&&$ext!='PNG'&&$ext!='gif')die('arquivo de imagem deve ser jpg ,png ou gif.');

if($fototamanho>3000000){die('Maximo de 1 Mb por foto');}


move_uploaded_file($fototemp,'../rgc/pp_'.$fotonome);

chmod('../rgc/'.$fotonome, 0644);

mysql_query("insert into ped_land values('','$id_ped','$f','pp_$fotonome')")or die('ee');



}

mysql_query("delete from ped_res where id_ped=$id_ped and id_f=$f ");

mysql_query("insert into ped_res values('','$id_ped','$f','".time()."',$p)")or die('ee');



?>
<html>
<body>
<script>
alert('Dados enviados');document.location='listagem_pedigree.php';
</script>
</body>
</html>
