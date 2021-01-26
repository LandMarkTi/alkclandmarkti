<?php

session_start();
require_once("Connections/conexao.php");
if($_SESSION['login']=='')die("<script>location='index.php';</script>");


$usr=$_GET['usr'];

$_SESSION['endz']=$_SESSION['endz'].','.$_GET['usr'];

$sql = "SELECT * FROM criadores where id_criador in(0 $_SESSION[endz]) ORDER BY id_criador DESC ";
$query = mysql_query($sql) or die(mysql_error());

echo "

<!DOCTYPE html>
<html>
  <head>
    <title>end</title>
    <meta charset=\"utf-8\">
</head>
<body>
";
while($linha=mysql_fetch_assoc($query)){


echo "
 $linha[nome]<br>
 $linha[end_corresp]<br>
 $linha[bairro_corresp]<br>
 $linha[cidade_corresp] - $linha[estado]<br>
 $linha[cep_corresp]<br><br><br>";
}

echo "</body>";
?>
