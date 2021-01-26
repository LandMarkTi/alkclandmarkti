<?
//print_r($_POST);
session_start();

require_once("Connections/conexao.php");

$idn=(int)$_SESSION['id'];

if($_SESSION['login']==''||$idn<=0)die("Login expirou");

$ped=(int)$_POST['id_ped'];
$filhote=(int)$_POST['id_filhote'];
$code=addslashes($_POST['code']);


$n=mysql_query("select * from `qrcode` where qrcode ='$code' and nuc <> '$idn'");
$nn=mysql_num_rows($n);

if($nn>=1){echo 'Código em uso ,digite novamente';exit();}

mysql_query("DELETE from `qrcode` where qrcode='$code' ");
mysql_query("INSERT INTO `qrcode` (`id_code`, `id_ped`, `id_filhote`, `qrcode`, `nuc`) VALUES (NULL,$ped,$filhote,'$code','$idn');") or die('erro f5');
echo 'Código Enviado!';
?>
