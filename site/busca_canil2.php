<?php
require_once("Connections/conexao.php");
$usr=(int)$_POST['usr'];
$usr+=21634;
if($usr>21634){
$sql = "SELECT * FROM criadores join aprovados on criadores.id_criador=aprovados.id_criador where criadores.id_criador=$usr ORDER BY criadores.id_criador DESC ";
$query = mysql_query($sql) or die(mysql_error());
$n=mysql_num_rows($query);
$linha = mysql_fetch_array($query);
if($n==0)die('<body ><meta charset="utf-8">não encontrado</body>');

$n_registro = $linha['id_criador'];
$n_registro =$n_registro-21634;
$proprietario = $linha['nome'];
$cidade_estado  = $linha['cidade']." / ". $linha['estado'];
$data_abertura  =date("d/m/Y",$linha['data']);//= $linha['dia_assinatura']."/".$linha['mes_assinatura']."/".$linha['ano_assinatura'];
$canil = $linha['nome_completo'];

$validade = $linha['dia_assinatura']."/".$linha['mes_assinatura']."/".($linha['ano_assinatura']+1);

echo '<body >
<meta charset="utf-8">
<style>@media print{.np{display: none !important;}}
.np {width:90%;}</style>
 <img src="images/cert_canil2.jpg" class="np"><br><span style="margin-top: -400px;display: block;margin-left: 239px;font-size: 14px;">
<i style="font-size: 29px;margin-left: 45px">'.$canil.'</i>
<br><br><br><br> Registro :'.$n_registro.'<br><br>Proprietário(s)'.$proprietario.'<br><br>Local:'.$cidade_estado.'<br><br>Abertura:'.$data_abertura.'<br></span></body>';}
?>
