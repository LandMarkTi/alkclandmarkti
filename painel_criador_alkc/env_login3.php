<?php
session_start();
require_once("Connections/conexao.php");
$login = addslashes($_POST['email']);
$senha = addslashes($_POST['senha']);
if($login=='')die('sem login');
//die('-'.$login.' '.$senha);
$consulta = "SELECT * from criadores where email='".$login."' and senha='".$senha."' and id_credenciado>=85 ";
$resultado = mysql_query($consulta) or die(mysql_error());
$linha = (int)mysql_num_rows($resultado);
//echo $linha;

if($linha==0){
	echo "<script>alert('senha incorreta.');location='index.php';</script>";
} else{
	
	//aprovado?
	$id = $escreve['id_criador'];
	//$qap=mysql_query("select * from aprovados where id_criador=$id");
	//$cap=(int)mysql_num_rows($qap);
	//if($cap==0)	{echo "<script>alert('Acesso negado.');location='index.php';</script>";die('');}
	$escreve = mysql_fetch_array($resultado);
	$login = $escreve['email'];
	$id = $escreve['id_criador'];
	$_SESSION['login'] = $login;
	$_SESSION['cid'] = $id;
	$_COOKIE['mm']='ok';
	echo "<script>location='index_principal.php';</script>";
}
?>
