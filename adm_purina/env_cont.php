<?php
session_start();

if($_SESSION['lp']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$tipo=(int)$_POST['id_pu'];

mysql_query("update proj_trans set tipo_t='".time()."' where id_tipo=".$tipo);

?>
<html>
<body>
<script>
alert('Dados enviados');document.location='listagem_pedigree_pur.php';
</script>
</body>
</html>
