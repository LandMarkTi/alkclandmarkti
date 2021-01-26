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

if($linha['sobrenome']!='')$proprietario .=' e '.$linha['sobrenome'];

$cidade_estado  = $linha['cidade']." / ". $linha['estado'];
$data_abertura  =date("d/m/Y",$linha['data']);//= $linha['dia_assinatura']."/".$linha['mes_assinatura']."/".$linha['ano_assinatura'];
$canil = $linha['nome_completo'];

$validade = $linha['dia_assinatura']."/".$linha['mes_assinatura']."/".($linha['ano_assinatura']+1);

echo '<html><head>
<meta charset="utf-8">

</head><body style="width: 25cm;">
<style>@media print{.np{display: none !important;}}
.np {width:23cm;margin-left: 2cm;line-height:}</style>
	<style type="text/css">
@font-face {
    font-family: old_scriptregular;
    src: url(old_script.ttf);
}
					center{
				font-family: "old_scriptregular";
							}
		</style>
 <img src="images/cert_canil4.jpg" class="np"><br><span style="margin-top: -10cm;display: block;margin-left: 7cm;font-size: 0.4cm;">
<center style="font-size: 1.1cm;margin-left: -5cm">Certificamos o Registro do Afixo do Canil:<br>
'.ucwords(strtolower($canil)).'</center><div style="line-height: 0.3cm;margin-left:-1cm">
<br><br> Registro :'.$n_registro.'<br><br>Proprietário(s) : '.ucwords(strtolower($proprietario)).'<br><br>Cidade/estado : '.$cidade_estado.'<br><br>Abertura : '.$data_abertura.'<br></div></span></body></html>';}
?>
