<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");
?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Keywords" content="Painel de Controle " /> 
<meta name="Description" content="Painel de Controle "/> 
<meta name="copyright" content="Petweball" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle .::</title>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>
<?php include "principal.php";?>
<?php include "footer.php";?>
</body>
</html>
