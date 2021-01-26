<?php
session_start();
require_once("Connections/conexao.php");
$login = addslashes(trim($_POST['email']));
$senha = addslashes($_POST['senha']);
if($login=='')die('erro lg');

if($login=='nucleosorocaba@sobraci.org')die("<script>window.top.location='http://www.sobraci.org/';</script>");

if($login=='laine@sobraci.org'||$login=='lucas@sobraci.org'||$login=='priscila@sobraci.org'){
$_SESSION['user_n'] = $login;
$login='nucleosorocaba@sobraci.org';
if(substr($senha,3,10)!='sbrc')die ("<script>window.top.location='http://www.sobraci.org/';</script>");
$senha='senha_sorocaba';
}
//die('-'.$login.' '.$senha);

$consulta = "SELECT * from credenciado where email='".$login."' and senha='".$senha."' ";
$resultado = mysql_query($consulta) or die('e1');
$linha = (int)mysql_num_rows($resultado);
//echo $linha;

if($linha==0){


//die('-'.$login.' '.$senha);
$consulta2 = "SELECT * from criadores join aprovados using (id_criador) where email='".$login."' and senha='".$senha."' ";
$resultado2 = mysql_query($consulta2) or die('e2');
$linha2 = (int)mysql_num_rows($resultado2);
//echo $linha;

if($linha2==0){
	die ("<script>location='http://www.megapedigree.com/site/index.php?em=".$login."&err=Senha%20Incorreta.';</script>");
} else{
	$escreve2 = mysql_fetch_array($resultado2);
	$login = $escreve2['email'];
	$id = $escreve2['id_criador'];
	$_SESSION['login'] = $login;
	$_SESSION['cid'] = $id;
	$_COOKIE['mm']='ok';
	die ("<script>location='http://www.megapedigree.com/painel_criador/index_principal.php';</script>");
}



} else{

	

	
	$escreve = mysql_fetch_array($resultado);
	$login = $escreve['email'];
	$id = $escreve['id_credenciado'];
	$_SESSION['login'] = $login;
	$_SESSION['id'] = $id;
	$_COOKIE['mm']='ok';
	die ("<script>location='http://www.megapedigree.com/painel_credenciado/index_principal.php';</script>");
}
?>
