<?php
header("Content-Type:text/plain");
header('Content-Disposition: attachment; filename="log.txt"');
require_once("Connections/conexao.php");
$fim="or pagamento.tipoPagto>=2)";
$usr=(int)$_GET['usr'];
$ini=(int)$_GET['comeca'];
$datas='';
$d2='';
if($ini!=0){$datas="pagamento.dataPagto>= $ini AND";$d2="dataInicial>= $ini AND"; }
if($usr!=0)$fim='or pagamento.tipoPagto>=2) and pagamento.idConta='.$usr;
$sql = "SELECT * FROM usuario JOIN pagamento ON usuario.id=pagamento.idConta where (pagamento.tipoPagto<2 ".$fim." ORDER BY idPagto DESC ";
$query = mysql_query($sql) or die(mysql_error());
//Pegando o TOTAL DE REGISTROS da tabel ADM
$total="select count(*) from usuario";
$result = mysql_query($total) or die(mysql_error());
$total = mysql_fetch_array($result);

$vtp=array('','entrada','saída','ganhou aposta','deu lance');
?>
logs Bet Off

<?php  
	echo "\r\n\r\n";	
	while($linha = mysql_fetch_array($query)) {if($linha['dataPagto']>$ini){?>
	<?php echo $linha['id']; ?>	<?php echo $linha['nome'].' '.$linha['sobrenome']; ?>	<?php echo date("d/m/Y",$linha['dataPagto']);?>	<?php echo $linha['email']; ?>	<?php echo money_format("%!0.2n",$linha['valorPagto']*0.01); ?>	<?php echo $linha['id_ap'];?>	<?php echo $vtp[$linha['tipoPagto']]."\r\n";?>
       <?php }} ?>


Apostas criadas

<?php echo "\r\n\r\n
"; 
$sql2 = "SELECT * FROM aposta WHERE $d2 idUsuario <> '16' ORDER BY idAposta DESC ";
$query2 = mysql_query($sql2) or die(mysql_error());
while($linha2 = mysql_fetch_array($query2)) {?>
       <?php echo $linha2['idAposta']; ?>	<?php echo $linha2['tituloAposta']; ?>	<?php echo date("d/m/Y",$linha2['dataInicial']); ?> até <?php echo date("d/m/Y",$linha2['dataFinal']); ?> criada por <?php echo $linha2['idUsuario']."\r\n"; ?> 
  
       <?php } ?>
