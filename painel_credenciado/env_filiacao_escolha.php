<?php
session_start();
require_once("Connections/conexao.php");

$ec=$_SESSION['email_contato'];

//var_dump($_POST);
$senha=1234;
$idcredenciado=9;
$nomecanil=$_POST['opcoes_nomes'];
unset($_POST['opcoes_nomes']);
$nid=$_POST['nid'];
unset($_POST['nid']);
$str="insert into criadores values('','".$nid."','".$senha;
foreach($_POST as $key=>$value)$str.="','".addslashes($value);
$str.="','".$nomecanil."')";
mysql_query($str)or die($str.mysql_error());

$r=mysql_query('SELECT LAST_INSERT_ID() as fim;')or die('kk');
$val=mysql_fetch_assoc($r);

?>
<body>
<br>
<p>Obrigado pelo cadastro, <a href="http://www.megapedigree.com/painel_credenciado/FORMULARIO_FILIACAO_ADM.php">voltar</a></p><br><br>

</body>
