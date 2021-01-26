<?php
session_start();
require_once("Connections/conexao.php");
$login = addslashes($_POST['email']);

if($login=='sergio@alkc.com.br')$login='sergio@sobraci.org';
$senha = md5($_POST['senha']);
if($login=='')die('1');
//die('-'.$login.' '.$senha);
$consulta = "SELECT * from adm where login='".$login."' and md5='".$senha."' ";
$resultado = mysql_query($consulta) or die(mysql_error());
$linha = (int)mysql_num_rows($resultado);
//echo $linha;

if($linha==0){
	echo 1;
} else{
	$escreve = mysql_fetch_array($resultado);
	$login = $escreve['login'];
	$id = $escreve['id'];
	$_SESSION['login'] = $login;
	$_SESSION['id'] = $id;
	$_COOKIE['mm']='ok';
	echo "2";
}
?>
