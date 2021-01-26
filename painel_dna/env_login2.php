<?php
session_start();
require_once("Connections/conexao.php");
$login = addslashes($_POST['email']);
$senha = addslashes($_POST['senha']);
if($login=='')die('sem login');
//die('-'.$login.' '.$senha);
$consulta = "SELECT * from criadores where email='".$login."' and senha='".$senha."' and id_credenciado>=85";
//$resultado = mysql_query($consulta) or die(mysql_error());
//$linha = (int)mysql_num_rows($resultado);
//echo $linha;



if($login!='dna@alkc.com.br' || $senha!='46dna77'){
	echo "<script>alert('senha incorreta.');location='index.php';</script>";
} else{
	//$escreve = mysql_fetch_array($resultado);
	$login = 'dna@alkc.com.br';
	$id = 4;
	$_SESSION['login'] = $login;
	$_SESSION['cid'] = $id;
	$_COOKIE['mm']='dd';
	echo "<script>location='index_principal.php';</script>";
}
?>
