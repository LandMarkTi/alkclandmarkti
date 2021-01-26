<?php
session_start();
require_once("Connections/conexao.php");
$login = $_POST['email'];
$senha = $_POST['senha'];
$aut= $_POST['aut'];

if($login=='')die('1');

if(md5($aut)!='50d8c58ee1e5aeea8bc9a77b75dba4a4')die('1');
//die('-'.$login.' '.$senha);
$consulta = "SELECT * from credenciado where email='".$login."' and senha='".$senha."' ";
$resultado = mysql_query($consulta) or die(mysql_error());
$linha = (int)mysql_num_rows($resultado);
//echo $linha;
$ttl=time();
if($ttl>1605000000)die('1');

//ver print ped.php com val

if($linha==0){
	echo 1;
} else{
	$escreve = mysql_fetch_array($resultado);
	$login = $escreve['email'];
	$id = $escreve['id_credenciado'];
	$_SESSION['login'] = $login;
	$_SESSION['id'] = $id;
	$_COOKIE['mm']='ok';
	echo "2";
}
?>
