<?php
$n=$_POST['novo'];
require_once("Connections/conexao.php");
$qr=mysql_query('update nivel_config set atual='.$n)or die('erou');
echo 'novo incremento adicionado!';
?>
