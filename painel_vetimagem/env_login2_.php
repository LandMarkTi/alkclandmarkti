<?php
session_start();
require_once("Connections/conexao.php");
$login = $_POST['email'];
$senha = $_POST['senha'];
if($login=='')die('sem login');
//die('-'.$login.' '.$senha);
$consulta = "SELECT * from criadores where email='".$login."' and senha='".$senha."' ";
$resultado = mysql_query($consulta) or die(mysql_error());
$linha = (int)mysql_num_rows($resultado);
//echo $linha;

if($linha==0){
	echo "<script>alert('senha incorreta.');location='index.php';</script>";
} else{
	$escreve = mysql_fetch_array($resultado);
	$login = $escreve['email'];
	$id = $escreve['id_criador'];
	$_SESSION['login'] = $login;
	$_SESSION['id'] = $id;
	$_COOKIE['mm']='ok';
	echo "<script>location='index_principal.php';</script>";
}
?>
