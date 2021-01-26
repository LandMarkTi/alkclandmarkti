<?
//print_r($_POST);
session_start();

require_once("Connections/conexao.php");

if($_SESSION['login']=='')die("Login expirou");

$ped=(int)$_POST['id_ped'];
$filhote=(int)$_POST['id_filhote'];
$code=addslashes($_POST['code']);

$n=mysql_query("select * from `megapedigree_banco`.`qrcode` where qrcode ='$code'");
$nn=mysql_num_rows($n);

if($nn>=1){echo 'Código já existe na base';exit();}

mysql_query("INSERT INTO `megapedigree_banco`.`qrcode` (`id_code`, `id_ped`, `id_filhote`, `qrcode`) VALUES (NULL,$ped,$filhote,'$code');") or die(mysql_error());
echo 'Código Enviado!';
?>
