<?php require ("Connections/conexao.php"); ?>
<?php
mysql_select_db($database_conexao, $conexao);
$subcateg = $_POST['subcateg'];

$sql = "SELECT * FROM subcategoria WHERE idSubcategoria='$subcateg'";
$qr = mysql_query($sql) or die(mysql_error());
$linha = mysql_fetch_array($qr);

if(mysql_num_rows($qr) == 0){
   //echo  '<option value="0">'.Nao_Disponivel.'</option>';
   die();
   
}else{
	echo $linha['pais_raca'];
   
}

?>
