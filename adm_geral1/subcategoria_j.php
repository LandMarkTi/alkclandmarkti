<?php require ("Connections/conexao.php"); ?>
<?php
mysql_select_db($database_conexao, $conexao);
$categoria = $_POST['categ'];

$sql = "SELECT * FROM subcategoria WHERE idCategoria = '$categoria' ORDER BY nomeSubcategoria ASC";
$qr = mysql_query($sql) or die(mysql_error());

if(mysql_num_rows($qr) == 0){
   //echo  '<option value="0">'.Nao_Disponivel.'</option>';
   echo"<option value='0'>Não Encontrado</option>";
   
}else{
	echo" <option>Selecione uma Sub-Categoria</option>";
   while($ln = mysql_fetch_assoc($qr)){
      echo '<option value="'.$ln['idSubcategoria'].'">'.$ln['nomeSubcategoria'].'</option>';
   }
}

?>