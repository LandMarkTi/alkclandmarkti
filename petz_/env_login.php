<?php
session_start();
require_once("Connections/conexao2.php");
$login = $_POST['email'];
$senha = $_POST['senha'];
if($login=='')die('1');
//die('-'.$login.' '.$senha);
$consulta = "SELECT * from lojas where `e-mail`='".$login."' and pss='".$senha."' ";
$resultado = mysql_query($consulta) or die('rr');
$linha = (int)mysql_num_rows($resultado);
//echo $linha;

if($linha==0){
	echo 1;
} else{
	$escreve = mysql_fetch_array($resultado);
	$login = $escreve['e-mail'];
	$id = $escreve['id_loja'];
	$_SESSION['login'] = $login;
	$_SESSION['id'] = $id;
	$_COOKIE['mm']='ok';
	echo "2";
}
?>
