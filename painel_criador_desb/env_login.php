<?php
session_start();
require_once("Connections/conexao.php");
$login = $_POST['email'];
$senha = $_POST['senha'];
if($login=='')die('1');
//die('-'.$login.' '.$senha);
$consulta = "SELECT * from criadores where email='".$login."' and senha='".$senha."' ";
$resultado = mysql_query($consulta) or die(mysql_error());
$linha = (int)mysql_num_rows($resultado);
//echo $linha;

if($linha==0){
	echo 1;
} else{
	$escreve = mysql_fetch_array($resultado);
	$login = $escreve['email'];
	$id = $escreve['id_criador'];
	$_SESSION['login'] = $login;
	$_SESSION['cid'] = $id;
	$_COOKIE['mm']='ok';
	echo "2";
}
?>
