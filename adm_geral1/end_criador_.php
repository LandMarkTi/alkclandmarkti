<?php

session_start();
require_once("Connections/conexao.php");
if($_SESSION['login']=='')die("<script>location='index.php';</script>");


$usr=$_GET['usr'];

$_SESSION['endz']=$_SESSION['endz'].','.$_GET['usr'];

$sql = "SELECT * FROM criadores where id_criador in(0 $_SESSION[endz]) ORDER BY id_criador DESC ";
$query = mysql_query($sql) or die(mysql_error());
while($linha=mysql_fetch_assoc($query)){


echo "
 $linha[nome]<br>
 $linha[End_residencial]<br>
 $linha[bairro]<br>
 $linha[cidade] - $linha[estado]<br>
 $linha[cep]<br><br><br>";
}
?>
