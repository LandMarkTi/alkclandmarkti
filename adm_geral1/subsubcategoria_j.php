<?php require ("Connections/conexao.php"); ?>
<?php
mysql_select_db($database_conexao, $conexao);
$subcateg = $_POST['subcateg'];

$sql = "SELECT * FROM subsubcategoria WHERE idSubCategoria = '$subcateg' ORDER BY nomeSubSubCategoria ASC";
$qr = mysql_query($sql) or die(mysql_error());

if(mysql_num_rows($qr) == 0){
   //echo  '<option value="0">'.Nao_Disponivel.'</option>';
   echo"<option>Não Encontrado</option>";
   
}else{
	echo" <option>Selecione uma Sub-Sub-Categoria</option>";
   while($ln = mysql_fetch_assoc($qr)){
      echo '<option value="'.$ln['idSubSubCategoria'].'">'.$ln['nomeSubSubCategoria'].'</option>';
   }
}

?>