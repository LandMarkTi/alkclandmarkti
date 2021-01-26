<?php 
session_start();
require_once("Connections/conexao.php");
//var_dump($_POST);
$idu=(int)$_POST['idu'];
$value=$_POST['value'];
if($value){
$qr_si=mysql_query("SELECT * FROM saques where id_saque=".$idu);
$ds=mysql_fetch_assoc($qr_si)or die('fee');
$id_usuario=$ds['id_user'];
$est=$ds['valor_saque'];
$qr=mysql_query("UPDATE saques SET status_retorno='Refunded' WHERE id_saque =".$idu) or die('ee');
$qr_tot=mysql_query("UPDATE usuario SET totalCreditos=totalCreditos-".$est." WHERE id=".$id_usuario);
$qr_pag=mysql_query("insert into pagamento values('',0,2,$id_usuario,$est,".time().")");
}
?>
