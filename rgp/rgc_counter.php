<?php

require_once("Connections/conexao.php");

$q=mysql_query("select count(*) as tot from rgc where 1");
$l=mysql_fetch_assoc($q);
?><!DOCTYPE html>
<head>
<meta charset="utf-8"> 
<meta http-equiv="Content-Language" content="pt-br">
<meta name="resource-type" content="document" />
<meta http-equiv="pragma" content="no-cache" />
<meta name="revisit-after" content="1" />
<meta name="robots" content="ALL" />
<meta name="distribution" content="Global" />
<meta name="rating" content="General" />
<meta name="classification" content="Internet">
<meta name="doc-class" content="Completed">
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed">
<b style="font-family: 'Source Sans Pro', sans-serif;font-size: 22px;"><?php echo number_format($l['tot'],0,".",".");?></b>

</body>
</html>
