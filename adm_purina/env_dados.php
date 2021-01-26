<?php
session_start();
//require_once("Connections/conexao.php");
$login = addslashes($_POST['email']);
$senha = addslashes($_POST['senha']);
if($login=='')die('sem login');
//die('-'.$login.' '.$senha);
//$consulta = "SELECT * from criadores where email='".$login."' and senha='".$senha."' and id_credenciado>=85";
//$resultado = mysql_query($consulta) or die(mysql_error());
//$linha = (int)mysql_num_rows($resultado);
//echo $linha;



if($login!='adm.purina@alkc.com.br' || md5($senha)!='1d9927aa9fe2812f07c9c7510652d86f'){
	echo "1";
} else{
	//$escreve = mysql_fetch_array($resultado);
	$login = 'adm.purina@alkc.com.br';
	$id = 4;
	$_SESSION['lp'] = $login;
	$_SESSION['pi'] = $id;
	//$_COOKIE['mn']='dd';
	echo "0";
}
sleep(2);
?>
