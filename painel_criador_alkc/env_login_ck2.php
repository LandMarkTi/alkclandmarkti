<?php
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);
session_start();
require_once("Connections/conexao.php");
$login = $_POST['name'];
$senha = $_POST['pass'];
if($login=='')die('sem login');
//die('-'.$login.' '.$senha);
$consulta = "SELECT * from criadores where email='".$login."' and senha='".$senha."' and id_credenciado>=85 ";
$resultado = mysql_query($consulta) or die(mysql_error());
$linha = (int)mysql_num_rows($resultado);
//echo $linha;

if($linha==0){
	echo "0";
} else{
	$escreve = mysql_fetch_array($resultado);
	$login = $escreve['email'];
	$id = $escreve['id_criador'];
	$_SESSION['logindvf'] = $login;
	$_SESSION['ciddfbg'] = $id;
	$_COOKIE['awe']='ok';
	echo "1";
}
?>
