<?php

session_start();
require_once("Connections/conexao.php");
if($_SESSION['login']!='sergio@sobraci.org')die("<script>location='index.php';</script>");




echo '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>Etiquetas</title><body>';



$eq=mysql_query("select * from etiquetas2 where data_add >".(time()-21600)) or die('et');
//echo $v;
while($feq=mysql_fetch_assoc($eq)){

echo $feq['texto_end'].'<br><br><br>';


}


echo '</body></html>';


?>
