<?php
session_start();
//if($_SESSION['login']=='')die("<script>location='http://megapedigree.com/painel_criador_alkc/';</script>");

require_once("Connections/conexao.php");
$usr=(int)$_GET['usr'];

$sql = "SELECT * FROM criadores join aprovados on criadores.id_criador=aprovados.id_criador where criadores.id_criador=$usr ORDER BY criadores.id_criador DESC ";
$query = mysql_query($sql) or die(mysql_error());
$n=mysql_num_rows($query);
$linha = mysql_fetch_array($query);
if($n==0)die('<body ><meta charset="utf-8">não encontrado</body>');

$n_registro = $linha['id_criador'];
$n_registro =$n_registro-21634;
$proprietario = $linha['nome'];

$cpfp=explode(',',$linha['cpf']);

if($linha['sobrenome']!='')$proprietario .=' e '.$linha['sobrenome'];


//$cidade_estado  = $linha['cidade']." / ". $linha['estado'];

$data_abertura  =date("d/m/Y",$linha['data']);//= $linha['dia_assinatura']."/".$linha['mes_assinatura']."/".$linha['ano_assinatura'];
$canil = $linha['nome_completo'];

//comprador

$id_ped=(int)$_GET['id_ped'];

$id_f=(int)$_GET['id_f'];

$q_pre=mysql_query("SELECT * FROM `pedigre_trocados_pre` WHERE `id_ped` = $id_ped AND `id_f` = $id_f ");

$fpre=mysql_fetch_assoc($q_pre);


//pet

$sql1="select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$id_ped;
$qr1=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr1);

$nasc=date("d/m/Y",$linha_ped['nasc']);

$nloop=explode(';', $linha_ped['ninhada']);

$sx=explode(';',$linha_ped['sexo']);
$cor=explode(';', $linha_ped['cor']);
$micro=explode(';', $linha_ped['nº microchip']);


$sql_add="select * from criadores where id_criador=".$linha_ped['id_criador'];
$qr_criador=mysql_query($sql_add);
$fc=mysql_fetch_assoc($qr_criador);

if($fc['uso_canil']=='sulfixo')$sulf=' '.$fc['nome_completo'].' '; else $pref=' '.$fc['nome_completo'].' ';

$linha_ped['nome']=$pref.$nloop[$id_f].$sulf;

if(substr($linha_ped['registro'],0,4)=='RGEO'||substr($linha_ped['registro'],0,4)=='RG/E')$linha_ped['nome']=$nloop[$id_f];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "https://www.w3.org/TR/html4/strict.dtd">
<html lang="pt-BR">
<head><meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<style type="text/css">
body,td,div,p,a,input {font-family: arial, sans-serif;}
</style><meta http-equiv="X-UA-Compatible" content="IE=edge"><title>contrato</title>
<style type="text/css">
body, td {font-size:13px} a:link, a:active {color:#1155CC; text-decoration:none} a:hover {text-decoration:underline; cursor: pointer} a:visited{color:##6611CC} img{border:0px} pre { white-space: pre; white-space: -moz-pre-wrap; white-space: -o-pre-wrap; white-space: pre-wrap; word-wrap: break-word; max-width: 800px; overflow: auto;} .logo { left: 146mm; position: relative; }
@media print {
    footer {page-break-after: always;}
}
</style></head><body style="margin: 0cm;padding:0cm;
width: 210mm;">
<table width=100% cellpadding=0 cellspacing=0 border=0><tr height=14px><td width=143><img src="https://health4pet.com.br/static/images/header_logo.png" width=143  alt="health4pet" class="logo"></td><td align=right><font size=-1 color=#777></font></td></tr></table>
<div class="bodycontainer" style="margin: 1cm;
width: 190mm;">

<p style="margin-bottom:0.49cm;line-height:100%" align="center"><b><font color="#000000"><font face="Verdana, serif"><font style="font-size:16pt;margin-left: -20mm;" size="4">CONTRATO
DE COMPRA E VENDA DE CÃES</font></font></font></b></p>
<p style="margin-bottom:0.49cm;line-height:200%"><br><br>
</p>
<p style="margin-bottom: -1.15cm;line-height:200%"><font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>VENDEDOR:</b></font></font><font face="Verdana, serif"><font style="font-size:10pt;letter-spacing: 0.5mm;" size="2">
......................<wbr>..............................<wbr>........................................., <br></font></font></p>
<p style="margin-bottom:0.49cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 31mm;
position: relative;" size="2"><?=$linha['nome_completo']?></font></font></p>
<p style="margin-bottom:-1.15cm;line-height:200%"><font face="Verdana, serif" style="font-size:10pt;">com sede á<font style="font-size:10pt;letter-spacing: 0.5mm;" size="2">
..............................<wbr>............................................................., <br></font></font></p>
<p style="margin-bottom:0.49cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 31mm;
position: relative;" size="2"><?=$linha['End_residencial']?></font></font></p>
<p style="margin-bottom:-1.15cm;line-height:200%"><font face="Verdana, serif" style="font-size:10pt;">bairro<font style="font-size:10pt;letter-spacing: 0.5mm;" size="2">......................<wbr>........,cidade.<wbr>................<wbr>........
no Estado...................., <br></font></font></p>
<p style="margin-bottom:0.49cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 10mm;
position: relative;" size="2"> <span style="left: 10mm;position: relative;width:40mm"><?php echo $linha['bairro']; if($linha['bairro']=='') echo '-';?></span> <span style="left: 45mm;position: relative;"><?=$linha['cidade']?></span> <span style="left: 90mm;position: relative;"><?=$linha['estado']?></span></font></font></p>
<p style="margin-bottom:-1.15cm;line-height:200%"><font face="Verdana, serif"><font style="font-size:10pt;letter-spacing: 0.5mm;" size="2">inscrito na entidade: ALKC sob
número.........., representado pelo seu proprietário <br></font></font></p>
<p style="margin-bottom:0.49cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 94mm;
position: relative;" size="2"><?=($linha['id_criador']-21634)?></font></font></p>
<p style="margin-bottom:-1.15cm;line-height:200%"><font face="Verdana, serif"><font style="font-size:10pt;letter-spacing: 0.5mm;" size="2">..........................<wbr>...............................
,CPF .........................................</font></font></p>

<p style="margin-bottom:-1.12cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 5mm;
position: relative;" size="2"><?=$proprietario?></font></font></p>

<p style="margin-bottom:0.49cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 120mm;
position: relative;" size="2"><?=$cpfp[0]?></font></font></p>
<!-- juntar com span?-->

<p style="margin-bottom:-1.15cm;line-height:200%" align="justify">
<font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>COMPRADOR:</b></font></font><font face="Verdana, serif"><font style="font-size:10pt;letter-spacing: 0.5mm;" size="2">....................<wbr>......................<wbr>.........................<wbr>..........................</font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2">,</font></font></p>
<p style="margin-bottom:0.49cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 30mm;
position: relative;" size="2"><?=$fpre['proprietario']?></font></font></p>

<p style="margin-bottom:-1.15cm;line-height:200%" align="justify"><font face="Verdana, serif"><font style="font-size:7pt" size="2">
</font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>CPF
:</b></font></font><font face="Verdana, serif"><font style="font-size:10pt;letter-spacing: 0.5mm;" size="2">.................................................Tel...............................................,</font></font></p>

<p style="margin-bottom:0.49cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 21mm;
position: relative;" size="2"><?=$fpre['cpf_t']?> <span style="left: 85mm;position: relative;"><?=$fpre['tel_t']?></span></font></font></p>

<p style="margin-bottom:-1.15cm;line-height:200%" align="justify"><font face="Verdana, serif" style="font-size:10pt;">Residente:<font style="font-size:10pt;letter-spacing: 0.5mm;" size="2">....................<wbr>....................<wbr>......................, Nº..........................,</font></font></p>

<p style="margin-bottom:0.49cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 21mm;
position: relative;" size="2"><?=$fpre['endereco']?> <span style="left: 125mm;position: relative;"><?=$fpre['numero']?></span></font></font></p>


<p style="margin-bottom:-1.15cm;line-height:200%" align="justify"><font face="Verdana, serif" style="font-size:10pt;">casa/apto<font style="font-size:10pt;letter-spacing: 0.5mm;" size="2">
:.........,
<span face="Verdana, serif" style="font-size:10pt;">bairro:</span>............<wbr>..............<wbr>Cidade:.....................................,
</font></font>
</p>

<p style="margin-bottom:0.49cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 21mm;
position: relative;" size="2"><?php echo $fpre['comp']; if($fpre['comp']=='')echo '-';?> <span style="left: 45mm;position: relative;"><?=$fpre['bairro']?></span> <span style="left: 105mm;position: relative;"><?=$fpre['cidade']?></span></font></font></p>


<p style="margin-bottom:-1.15cm;line-height:200%" align="justify"><font face="Verdana, serif"><font style="font-size:10pt;letter-spacing: 0.5mm;"  size="2">Estado:...................email:........................................<wbr>...........................</font></font></p>


<p style="margin-bottom:0.49cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 21mm;
position: relative;" size="2"><?=$fpre['estado']?> <span style="left: 45mm;position: relative;"><?=$fpre['email_t']?></span> </font></font></p>


<p style="margin-bottom:0.49cm;line-height:100%"><font face="Verdana, serif"><font style="font-size:7pt" size="2"><i><b>As
partes acima identificadas têm, entre si, justo e acertado o
presente Contrato de Compra e Venda de Cães, que se regerá pelas
cláusulas seguintes e pelas condições descritas no
presente.</b></i></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2"><br>       </font></font></p>

<p style="margin-bottom:0.49cm;line-height:100%"><font face="Verdana, serif"><font style="font-size:12pt" size="2"><b>DO
OBJETO DO CONTRATO</b></font></font></p>
<p style="margin-bottom:-1.15cm;line-height:200%" align="justify">
<font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>Cláusula
1ª.</b></font></font><font face="Verdana, serif"><font style="font-size:10pt" size="2">
O presente contrato tem como OBJETO, Um filhote da raça
.................<wbr>..................<wbr>..............,</font></font></p>
<p style="margin-bottom:0.49cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 130mm;
position: relative;" size="2"><?=$linha_ped['nomeSubcategoria']?></font></font></p>


<p style="margin-bottom:-1.15cm;line-height:200%" align="justify"><font face="Verdana, serif"><font style="font-size:10pt" size="2"> cor
....................................,
sexo.................., nome...........................<wbr>....................<wbr>..................... <br></font></font></p>

<p style="margin-bottom:-1.12cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 15mm;
position: relative;" size="2"><?=$cor[$id_f-4]?></font></font></p>

<p style="margin-bottom:-1.12cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 70mm;
position: relative;" size="2"><?=$sx[$id_f-4]?></font></font></p>

<p style="margin-bottom:0.49cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 115mm;
position: relative;" size="2"><?=$linha_ped['nome']?></font></font></p>

<p style="margin-bottom:-1.15cm;line-height:200%" align="justify"><font face="Verdana, serif"><font style="font-size:10pt" size="2">Registro
PEDIGREE Nº ........................................., MICROCHIP Nº
..........................<wbr>................, </font></font>
</p>

<p style="margin-bottom:-1.12cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 50mm;
position: relative;" size="2"><?=$linha_ped['registro'].($id_f-4)?></font></font></p>

<p style="margin-bottom:0.49cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 130mm;
position: relative;" size="2"><?=$micro[$id_f-4]?> </font></font></p>

<p style="margin-bottom:-1.15cm;line-height:200%" align="justify"><font face="Verdana, serif"><font style="font-size:10pt" size="2">


nascido
em <?=$nasc?> 
<br><br><br>
</font></font>
</p>

<p style="margin-bottom:0.49cm;line-height:150%"><font face="Verdana, serif"><font style="font-size:10pt" size="2"><b>DAS
OBRIGAÇÕES</b></font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify"><a name="m_-8315628161895073979__GoBack"></a>
<font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>Cláusula
2ª.</b></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2">
O </font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>VENDEDOR</b></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2">
entregará ao </font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>COMPRADOR</b></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2">
o Certificado de Propriedade do Animal emitido pela ALKC, AMERICA
LATINA KENNEL CLUBE, juntamente com a carteira de vacinação do
animal. A transferência de TITULARIDADE/PROPRIEDADE deverá ser
feita imediatamente, o cadastro de transferência já foi emitido
devendo o novo proprietário efetuar o pagamento da taxa para
efetivar a transferência, </font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>caso
não seja feita em 10 dias o contrato e suas garantias perderão a
validade, faça a transferência pelo Site <a href="http://www.alkc.org.br" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=pt-BR&amp;q=http://www.alkc.org.br&amp;source=gmail&amp;ust=1489837053802000&amp;usg=AFQjCNGtI_47yjECjPup3JWGu6rdmNUHng">www.alkc.org.br</a> ou entre
em contato com um kennel clube credenciado indicado na página. </b></font></font>
</p>


<footer></footer>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:10pt" size="2"><b>Cláusula
3ª.</b></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2">
O </font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>COMPRADOR</b></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2">
fica responsável pela vacinação do animal nas datas previstas, bem
como por não o levar a lugares públicos ou de alto contágio, pelo
período de até 30 dias após a última dose. Devem ser obedecidos
os protocolos de 3 doses de V10 e uma dose de raiva antes de levar o
filhote em locais públicos. <br></font></font><br>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:10pt" size="2"><b>Cláusula
4ª.</b></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2">
Em caso de óbito do cão por motivo de doença GENÉTICA no prazo de
30 dias, o filhote será reposto, ou o dinheiro será devolvido. Caso
o óbito seja por motivo de doença viral dentro deste prazo a
garantia não se aplica em virtude de estar sendo entregue carteira
de vacinação com toda rotina de vacinas aplicadas conforme
protocolo de sequencia de vacinas elaborado pelo médico Veterinário
Responsável pelo canil, até a data da retirada do filhote.</font></font></p>

<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western"><br>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western"><font face="Verdana, serif"><font style="font-size:10pt" size="2"><b>P</b></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>arágrafo
Único</b></font></font><font style="font-size:7pt" size="2"> </font>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font style="font-size:7pt" size="2"><br></font><font face="Verdana, serif"><font style="font-size:7pt" size="2">O
comprador tem um prazo de 10 (dez) dias a contar da data da retirada
do animal a leva-lo a um médico veterinário credenciado HEALTH FOR
PET, para avaliar sua saúde e avaliar o cão clinicamente. As
doenças e viroses que possam atacar o animal posteriormente a este
prazo de 10 (dez) dias, período de incubação de alguns vírus, não
são motivos para qualquer protelação ou sustação de pagamentos,
pôr parte do comprador, bem como declara-se ciente de que eventuais
despesas médico-veterinárias, à partir desta data correm
exclusivamente às suas expensas, </font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>caso
não prossiga com o CONVENIO SAÚDE indicado. </b></font></font>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<br>
</p>

<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>A
garantia de saúde só será válida se o plano de saúde/seguro for
perpetuado, com a HEALTH FOR PET, de acordo com as regiões
atendidas, o filhote só será entregue com o contrato de CONVENIO
SAÚDE ATIVADO em nome do comprador que deverá continuar o pagamento
das mensalidades por 12 meses para validar a garantia deste contrato.</b></font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<br>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:7pt" size="2">Na
eventualidade de doenças infectocontagiosas pré-existentes, deverão
ser respeitados o período de incubação de cada doença e só serão
aceitas reclamações quando acompanhadas de laudo oficial expedido
pôr entidade pública. No caso de óbito do animal objeto deste
contrato, o comprador deverá ainda, apresentar necropsia emitida pôr
entidade pública, ocasião em que o vendedor se obriga a repor a
perda, com outro animal da mesma raça, em prazo conveniente à ambas
as partes.</font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<br>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:7pt" size="2">Filhotes
necessitam de ambiente arejado com água á vontade, exposição ao
calor por longos períodos podem levar o animal a óbito. O filhote
deverá ficar em local apropriado com cobertura para ficar
descansando e local seco e fora do solo para dormir, caminha, palet,
colchão. A alimentação do filhote deve ser oferecida 3 x ao dia,
Manhã, tarde e noite, água á vontade, só indicamos rações
SUPER PREMIUM. (siga as recomendações da embalagem para administrar
as quantidades)<br></font></font>
</p>

<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:10pt" size="2"><b>DO
PREÇO</b></font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<br>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western"><font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>Cláusula
5ª.</b></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2">
O </font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>COMPRADOR</b></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2">
pagará ao </font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>VENDEDOR</b></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2">,
pela compra do animal objeto deste contrato, a quantia de R$
.............................
(.............................<wbr>..................), sendo pagos da
seguinte forma:
...............................................................................................<br>

...................................................................................................................................................................................................<br>

...................................................................................................................................................................................................<br>

...................................................................................................................................................................................................<br>

...................................................................................................................................................................................................<br>


</font></font></p>


<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:10pt" size="2"><b>Cláusula
6ª.</b></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2">
O não pagamento do montante restante ou a desistência do mesmo
desobriga o </font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>VENDEDOR</b></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2">
a devolver a reserva, caso houver, pelo fato de não poder ter
comercializado o animal com outro propenso</font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>
COMPRADOR</b></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2">.
</font></font>
</p>
<footer></footer>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>CONDIÇÕES
GERAIS</b></font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
 </p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>C</b></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>láusula
7ª.</b></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2">
O </font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>VENDEDOR</b></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2">
não se responsabilizará por óbito do animal que não seja
decorrente de doença viral ou genética, tendo sido causados por
negligência do </font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>COMPRADOR</b></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2">
e pela não perpetuação do </font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>CONVENIO
SAÚDE</b></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2">
indicado.<br></font></font><br>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>Cláusula
8ª.</b></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2">
O presente contrato passa a valer a partir da assinatura pelas
partes.</font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<br>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western"><font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>DO
FORO</b></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2">.<br>       
</font></font>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western"><font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>Cláusula
9ª.</b></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2">
Para dirimir quaisquer controvérsias oriundas do CONTRATO, as partes
elegem o foro da comarca de<br>
..............................<wbr>..............................<wbr>................;<br><br>             
Por estarem assim justos e contratados, firmam o presente
instrumento, em duas vias de igual teor, juntamente com 2 (duas)
testemunhas.<br>              <br></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">              <br></font></font><font face="Verdana, serif"><font style="font-size:7pt" size="2">      ........................<wbr>..,
............ de ............................ de
20......<br>       <br>      
</font></font>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:7pt" size="2">______________________________<wbr>_____</font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:7pt" size="2">VENDEDOR</font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:7pt" size="2">______________________________<wbr>_____</font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:7pt" size="2">COMPRADOR</font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:7pt" size="2">______________________________<wbr>_____</font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:7pt" size="2">TESTEMUNHA
1</font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:7pt" size="2">______________________________<wbr>_____</font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:7pt" size="2">TESTEMUNHA
2</font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<br>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:10pt" size="2">IMPORTANTE:</font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<br>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>Mantenha
longe do seu filhote objetos pequenos, plantas, acesso a locais
altos, panos ou roupas. Filhotes mordem tudo que podem pois seus
dentes coçam muito até a troca final, ofereça brinquedos para
filhotes comprados em lojas do ramo, evite ossos de couro, ofereça
ossos verdadeiros , petiscos podem causar diarreias. Não leve seu
cachorrinho á rua antes de completar o ciclo de vacinas e evite que
quando chegar em casa tenha contato com seus calçados, estes
cuidados irão ajudar o seu filhote a crescer com saúde. Não siga
orientações de pessoas estranhas em redes sociais ou grupos, em
caso de dúvidas consulte sempre um Médico Veterinário.</b></font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<br>
</p>

<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="center">
<font face="Verdana, serif"><b>ATIVAÇÃO DO PLANO
DE SAÚDE / GARANTIA</b></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<br>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>COM
A ATIVAÇÃO DO PLANO DE SAÚDE O FILHOTE CONTA COM UMA AMPLA REDE DE
MÉDICOS VETERINÁRIOS E UMA CENTRAL DE ATENDIMENTO PARA SANAR
DÚVIDAS DIRETAMENTE COM MÉDICOS VETERINÁRIOS, LEVE O FILHO NO
PRAZO DE 10 DIAS EM UMA CLÍNICA INDICADA PARA A PRIMEIRA CONSULTA
GRÁTIS E PARA A EFETIVAÇÃO DA GARANTIA SAÚDE DESTE CONTRATO.</b></font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>PRIMEIRA
VACINA ANUAL V10 GRÁTIS </b></font></font>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>PET
CLUBE : ampla rede de descontos em vários produtos e serviços</b></font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:7pt" size="2"><b>RG
PET VIRTUAL gratuito liberado no ato da transferência.</b></font></font></p>

</div>
</font></div></table></table></div></div></body>
<script>
window.print();
</script>
</html>
