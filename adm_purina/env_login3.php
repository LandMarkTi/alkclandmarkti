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



if($login!='adm.purina@alkc.com.br' || md5($senha)!='41b9e61f1a1e6b5d04894f5933ec41a1'){//7dfb47472c665ccf14bc987968213874
	echo "0";
} else{
	//$escreve = mysql_fetch_array($resultado);
	$login = 'adm.purina@alkc.com.br';
	$id = 4;
	$_SESSION['lp'] = $login;
	$_SESSION['pi'] = $id;
	//$_COOKIE['mn']='dd';
	echo "1";
}
?>
