<?php
//session_start();
//if($_SESSION['login']=='')die("<script>location='http://megapedigree.com/painel_criador_alkc/';</script>");

require_once("Connections/conexao.php");
$usr=22340;

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




$q_pre=mysql_query("SELECT * FROM `pedigre_trocados_pre` WHERE `id_ped` = $id_ped AND `id_f` = $id_f order by id_trans_capa desc");

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
<table width=100% cellpadding=0 cellspacing=0 border=0><tr height=14px><td width=143><!--img src="https://health4pet.com.br/static/images/header_logo.png" width=143  alt="health4pet" class="logo"--> </td><td align=right><font size=-1 color=#777></font></td></tr></table>
<div class="bodycontainer" style="margin: 1cm;
width: 190mm;">
<b style="font-size:16pt;">Proposta:</b>
<p style="margin-bottom:0.49cm;line-height:100%" align="center"><b><font color="#000000"><font face="Verdana, serif"><font style="font-size:16pt;margin-left: -20mm;line-height:40px" size="4">INSTRUMENTO PARTICULAR PARA AQUISIÇÃO DE<br>ANIMAIS DE ESTIMAÇÃO</font></font></font></b></p>
<p style="margin-bottom:0.49cm;line-height:200%"><br><br>
</p>
<p style="margin-bottom: -1.15cm;line-height:200%"><font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>VENDEDOR:</b></font></font><font face="Verdana, serif"><font style="font-size:10pt;letter-spacing: 0.5mm;" size="2">
......................<wbr>..............................<wbr>......................................., <br></font></font></p>
<p style="margin-bottom:0.49cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 31mm;
position: relative;" size="2"><?=$linha['nome_completo']?></font></font></p>
<p style="margin-bottom:-1.15cm;line-height:200%"><font face="Verdana, serif" style="font-size:10pt;">com sede á<font style="font-size:10pt;letter-spacing: 0.5mm;" size="2">
..............................<wbr>............................................................., <br></font></font></p>
<p style="margin-bottom:0.49cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 31mm;
position: relative;" size="2"><?=$linha['End_residencial']?></font></font></p>
<p style="margin-bottom:-1.15cm;line-height:200%"><font face="Verdana, serif" style="font-size:10pt;">bairro<font style="font-size:10pt;letter-spacing: 0.5mm;" size="2">......................<wbr>........,cidade.<wbr>................<wbr>........
no Estado...................., <br></font></font></p>
<p style="margin-bottom:0.49cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 10mm;
position: relative;" size="2"> <span style="left: 4mm;
position: relative;
width: 36mm;
display: inline-block;"><?php echo $linha['bairro']; if($linha['bairro']=='') echo '-';?></span> <span style="left: 36mm;position: relative;"><?=$linha['cidade']?></span> <span style="left: 90mm;position: relative;"><?=$linha['estado']?></span></font></font></p>
<p style="margin-bottom:-1.15cm;line-height:200%"><font face="Verdana, serif"><font style="font-size:10pt;letter-spacing: 0.5mm;" size="2">
inscrito na entidade: ALKC sob
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
<font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>COMPRADOR:</b></font></font><font face="Verdana, serif"><font style="font-size:10pt;letter-spacing: 0.5mm;" size="2">....................<wbr>......................<wbr>.................................................</font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">,</font></font></p>
<p style="margin-bottom:0.49cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 30mm;
position: relative;" size="2"><?=$fpre['proprietario']?></font></font></p>

<p style="margin-bottom:-1.15cm;line-height:200%" align="justify"><font face="Verdana, serif"><font style="font-size:9pt" size="2">
</font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>CPF
:</b></font></font><font face="Verdana, serif"><font style="font-size:10pt;letter-spacing: 0.5mm;" size="2">.................................................Tel...............................................,</font></font></p>

<p style="margin-bottom:0.49cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 21mm;
position: relative;" size="2"><?=$fpre['cpf_t']?> <span style="left: 85mm;position: relative;"><?=$fpre['tel_t']?></span></font></font></p>

<p style="margin-bottom:-1.15cm;line-height:200%" align="justify"><font face="Verdana, serif" style="font-size:10pt;">Residente:<font style="font-size:10pt;letter-spacing: 0.5mm;" size="2">....................<wbr>....................<wbr>......................, Nº..........................,</font></font></p>

<p style="margin-bottom:0.49cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 21mm;
position: relative;" size="2"><?=$fpre['endereco']?> <span style="left: 95mm;position: relative;"><?=$fpre['numero']?></span></font></font></p>


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


<p style="margin-bottom:0.49cm;line-height:100%"><font face="Verdana, serif"><font style="font-size:9pt" size="2"><i><b>As partes acima identificadas têm, entre si, justo e acertado o presente Contrato para aquisição de animais de estimação, que se regerá pelas cláusulas e pelas condições descritas no presente instrumento.</b></i></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><br>       </font></font></p>

<p style="margin-bottom:0.49cm;line-height:100%"><font face="Verdana, serif"><font style="font-size:12pt" size="2"><b>DO
OBJETO DO CONTRATO</b></font></font></p>
<p style="margin-bottom:-1.15cm;line-height:200%" align="justify">
<font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>
Cláusula 1ª.</b></font></font><font face="Verdana, serif"><font style="font-size:10pt" size="2">
O &nbsp;&nbsp; presente&nbsp;&nbsp; contrato&nbsp;&nbsp; tem &nbsp;&nbsp;como&nbsp;&nbsp; OBJETO ,&nbsp;&nbsp; Um&nbsp;&nbsp; filhote &nbsp;&nbsp;da &nbsp;&nbsp;raça :<br>
...........................................................,cor
.......................................................................,</font></font></p>
<p style="line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 0mm;
position: relative;" size="2"><?=$linha_ped['nomeSubcategoria']?></font></font></p>

<p style="margin-bottom:-1.12cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;top:-10mm;left: 90mm;
position: relative;" size="2"><?=$cor[$id_f-4]?></font></font></p>


<p style="margin-bottom:-1.15cm;line-height:200%" align="justify"><font face="Verdana, serif"><font style="font-size:10pt" size="2"> 
sexo............................, nome...........................<wbr>....................<wbr>.............................................. <br></font></font></p>


<p style="margin-bottom:-1.12cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 15mm;
position: relative;" size="2"><?=$sx[$id_f-4]?></font></font></p>

<p style="margin-bottom:0.49cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 75mm;
position: relative;" size="2"><?=$linha_ped['nome']?></font></font></p>

<p style="margin-bottom:-1.15cm;line-height:200%" align="justify"><font face="Verdana, serif"><font style="font-size:10pt" size="2">Registro
PEDIGREE Nº ........................................., MICROCHIP Nº
..........................<wbr>................, </font></font>
</p>

<p style="margin-bottom:-1.12cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 50mm;
position: relative;" size="2"><?=$linha_ped['registro'].($id_f-4)?></font></font></p>

<p style="margin-bottom:1.49cm;line-height:200%"><font face="Verdana, serif"></font><font face="Verdana, serif"><font style="font-size:10pt;left: 130mm;
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
<font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>
Cláusula 2ª.</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">
O </font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>VENDEDOR</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">
entregará a(o)(s) </font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>COMPRADOR(A)(ES),</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">
no ato de entrega do(s) Pet(s) o(s) respectivo(s) Certificado(s) de Propriedade(s) do(s) Animal(is), emitido(s) pela ALKC, AMERICA LATINA KENNEL CLUBE, juntamente com a(s) respectiva(s) carteira(s) de vacinação(ões) do(s) animal(is). </font></font>
</p>


<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:10pt" size="2"><b>
Parágrafo 1ª.</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><font face="Verdana, serif"><font style="font-size:9pt" size="2">
A transferência de TITULARIDADE/PROPRIEDADE se dará no ato da assinatura deste instrumento, juntamente com a entrega do cadastro de transferência.

 <br></font></font><br>
</p>

<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:10pt" size="2"><b>
Parágrafo 2ª.</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><font face="Verdana, serif"><font style="font-size:9pt" size="2">
No mesmo ato, e como demonstração do interesse em manter seu animal de estimação em boa saúde, o (a)(s) COMPRADOR(A)(ES), celebram CONTRATO DE ASSISTÊNCIA MÉDICA VETERINÁRIA, tendo por CONTRATADA a HEALTH FOR PET ADMINISTRADORA DE PLANOS DE ASSISTÊNCIA MÉDICA VETERINÁRIA.

 <br></font></font><br>
</p>

<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:10pt" size="2"><b>
Parágrafo 3ª.</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><font face="Verdana, serif"><font style="font-size:9pt" size="2">
A Contratação do Plano de saúde tem por objeto garantir acesso ao tratamento e orientação veterinária ao PET, pelo que o(a) Comprador(a) (es), deverá(ão) efetuar o pagamento da primeira mensalidade até o vencimento, para obter o benefício da transferência gratuita do PET. 

 <br></font></font><br>
</p>



<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:10pt" size="2"><b>
Parágrafo 4ª.</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><font face="Verdana, serif"><font style="font-size:9pt" size="2">
Caso não seja efetuado o pagamento da primeira mensalidade, a transferência de titularidade do PET, assim como suas garantias, perderão a validade. 
 <br></font></font><br>
</p>

<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:10pt" size="2"><b>
Parágrafo 5ª.</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><font face="Verdana, serif"><font style="font-size:9pt" size="2">
A transferência GRATUITA do PET, só será efetivada e enviada para o novo titular após a ativação do plano, vistoria veterinária e pagamento da primeira mensalidade do plano. Caso não seja realizado o pagamento da primeira mensalidade do plano, ainda sim poderá ser feita a transferência de propriedade pelo site www.alkc.org.br, porém será cobrada a taxa de transferência, no valor vigente na tabela de taxas no site do ALKC.

 <br></font></font><br>
</p>


<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:10pt" size="2"><b>
Parágrafo 6ª.</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><font face="Verdana, serif"><font style="font-size:9pt" size="2">
O VENDEDOR só entregará o(s) animal(is) ao COMPRADOR(A) (ES), após a ministração da segunda dose da POLIVALENTE, e desde que o PET esteja em condições de saúde compatível à sua retirada.
 <br></font></font><br>
</p>


<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:10pt" size="2"><b>
Cláusula 3ª.</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">
O </font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>COMPRADOR</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">
 também assume a responsabilidade pela vacinação do(s) animal(is) nas datas previstas, assim como pelos custos, bem como por não o levar a lugares públicos ou de possível contágio, durante o período das vacinações, até 30 dias após a última dose, estando ciente, e obrigando-se a obedecer os protocolos pertinentes, de 3 doses de POLIVALENTE e uma dose de ANTIRRABICA, frise-se, antes de levar o filhote em locais públicos.  <br></font></font><br>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:10pt" size="2"><b>
Cláusula 4ª.</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">
Em caso de óbito do cão por motivo exclusivo de doença GENÉTICA no prazo de até 30 dias, o filhote será reposto, ou o valor correspondente, será devolvido. Parágrafo Primeiro: Caso o óbito seja por motivo de doença viral, dentro do prazo de vacinação, conforme exposto na cláusula 3a. acima, a garantia não se aplica vez que está sendo entregue carteira de vacinação com toda rotina de vacinas aplicadas conforme protocolo de sequência de vacinas elaborado pelo médico Veterinário Responsável pelo canil, até a data da retirada do filhote, e com as recomendações de quarentena para o período de vacinação.</font></font></p>


<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western"><font face="Verdana, serif"><font style="font-size:10pt" size="2"><b>P</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>arágrafo
1º</b></font></font><font style="font-size:9pt" size="2"> </font>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font style="font-size:9pt" size="2"><br></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">
O comprador tem um prazo de até 10 (dez) dias a contar da data da retirada do animal a leva-lo a um médico veterinário credenciado HEALTH FOR PET, para avaliar sua saúde e avaliar o(s) cão(es) clinicamente, com vistas a avaliação do estado para fins de contratação junto à HEALTH FOR PET. 
</font></font>
</p>

<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western"><font face="Verdana, serif"><font style="font-size:10pt" size="2"><b>P</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>arágrafo
2º</b></font></font><font style="font-size:9pt" size="2"> </font>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font style="font-size:9pt" size="2"><br></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">
Eventuais doenças e viroses que possam atacar o(s) Pet(s) posteriormente a este prazo de 10 (dez) dias, período de incubação de alguns vírus, não são motivos para qualquer protelação ou sustação de pagamentos, pôr parte do COMPRADOR.

</font></font>
</p>


<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western"><font face="Verdana, serif"><font style="font-size:10pt" size="2"><b>P</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>arágrafo
3º</b></font></font><font style="font-size:9pt" size="2"> </font>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font style="font-size:9pt" size="2"><br></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">
O Comprador declara sua ciência de que não terá cobertura de seu(s) (ua)(s), para males preexistentes e para as vacinas, POLIVALENTE e ANTIRRABICA, perante a HEALTH FOR PET.
</font></font>
</p>


<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western"><font face="Verdana, serif"><font style="font-size:10pt" size="2"><b>P</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>arágrafo
4º</b></font></font><font style="font-size:9pt" size="2"> </font>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font style="font-size:9pt" size="2"><br></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">
<b>O benefício de Assistência à saúde do(s) Pet(s), observará os termos, cláusulas e limites contidos no contrato celebrado com a HEALTH FOR PET, enquanto vigente o contrato, frise-se, com a HEALTH FOR PET, de acordo com as regiões atendidas, ratificando-se que o(s) Pet(s) só será entregue com o contrato de CONVÊNIO SAÚDE ATIVADO, em nome do comprador que deverá continuar o pagamento das mensalidades por pelo menos 12 meses para validar a garantia deste contrato.</b>
</font></font>
</p>

<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western"><font face="Verdana, serif"><font style="font-size:10pt" size="2"><b>P</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>arágrafo
5º</b></font></font><font style="font-size:9pt" size="2"> </font>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font style="font-size:9pt" size="2"><br></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">
Filhotes necessitam de ambiente arejado com água á vontade, exposição ao calor por longos períodos podem levar o animal a óbito. O filhote deverá ficar em local apropriado com cobertura para ficar descansando e local seco e fora do solo para dormir, caminha, palet, colchão. A alimentação do filhote deve ser oferecida 3 x ao dia, Manhã, tarde e noite,  água á vontade, só indicamos rações SUPER PREMIUM. (siga as recomendações da embalagem para administrar as quantidades)
</font></font>
</p>


<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">

</p>


<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:10pt" size="2"><b>DO
PREÇO</b></font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<br>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western"><font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>Cláusula
5ª.</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">
O </font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>COMPRADOR</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">
pagará ao </font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>VENDEDOR</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">,
pela compra do animal objeto deste contrato, a quantia de R$
.............................
(.............................<wbr>..................), sendo pagos da
seguinte forma:<br>


....................................................................................................................................................................<br>

...................................................................................................................................................................<br>

...................................................................................................................................................................<br>

....................................................................................................................................................................<br>


</font></font></p>


<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:10pt" size="2"><b>Cláusula
6ª.</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">
O não pagamento do montante restante ou a desistência do mesmo desobriga o </font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>VENDEDOR</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">
a devolver a reserva, caso houver, pelo fato de não poder ter comercializado o animal com outro propenso </font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>
COMPRADOR</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">.
</font></font>
</p>

<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>CONDIÇÕES
GERAIS</b></font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
 </p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>C</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>láusula
7ª.</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">
O </font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>VENDEDOR</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">
não se responsabilizará por óbito do animal que não seja decorrente de doença viral ou genética, tendo sido causados por negligência do </font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>COMPRADOR</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">
e pela não perpetuação do </font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>CONVENIO
SAÚDE</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">
indicado.<br></font></font>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>Cláusula
8ª.</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">
O presente contrato passa a valer a partir da assinatura pelas
partes.</font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">

</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western"><font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>DO
FORO</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">.<br>       
</font></font>
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western"><font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>Cláusula
9ª.</b></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">
Para dirimir quaisquer controvérsias oriundas do CONTRATO, as partes
elegem o foro da comarca de<br>
..............................<wbr>..............................<wbr>................;<br><br>             
Por estarem assim justos e contratados, firmam o presente
instrumento, em duas vias de igual teor, juntamente com 2 (duas)
testemunhas.<br>              <br></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">              <br></font></font><font face="Verdana, serif"><font style="font-size:9pt" size="2">      ........................<wbr>..,
............ de ............................ de
20......<br>       <br>      
</font></font>
</p>
<!--footer></footer-->
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:9pt" size="2">______________________________<wbr>_____</font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:9pt" size="2">VENDEDOR</font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:9pt" size="2">______________________________<wbr>_____</font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:9pt" size="2">COMPRADOR</font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
</p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:9pt" size="2">______________________________<wbr>_____</font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:9pt" size="2">TESTEMUNHA
1</font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:9pt" size="2">______________________________<wbr>_____</font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:9pt" size="2">TESTEMUNHA
2</font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<br>
</p>
<footer></footer>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:10pt" size="2">OBSERVAÇÕES IMPORTANTES:</font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">

</p>

<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>
1-Mantenha longe do seu filhote objetos pequenos, plantas, acesso a locais altos, panos ou roupas. Filhotes mordem tudo que podem, pois seus dentes coçam muito até a troca final, ofereça brinquedos para filhotes comprados em lojas do ramo, evite ossos de couro, ofereça ossos verdadeiros, petiscos podem causar diarreias. Não leve seu cachorrinho á rua antes de completar o ciclo de vacinas e evite que quando chegar em casa tenha contato com seus calçados, esses cuidados irão ajudar o seu filhote a crescer com saúde. Não siga orientações de pessoas estranhas em redes sociais ou grupos, em caso de dúvidas, consulte sempre um Médico Veterinário.
</b></font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<br>
</p>

<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>
2 - O CANIL, VENDEDOR,  é cadastrado em observância ao TERMO DE COMPROMISSO celebrado entre a ASSOCIAÇÃO a CORRETORA e a HEALTH FOR PET ADMINISTRADORA DE PLANOS DE SAÚDE PARA ANIMAIS DE ESTIMAÇÃO S.A .

</b></font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<br>
</p>

<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<font face="Verdana, serif"><font style="font-size:9pt" size="2"><b>
A T I V A Ç Ã O   D O   P L A N O    D E    S A Ú D E / G A R A N T I A<br>
3 - COM A ATIVAÇÃO DO PLANO DE SAÚDE O FILHOTE CONTA COM UMA AMPLA REDE DE MÉDICOS VETERINÁRIOS E UMA CENTRAL DE ATENDIMENTO PARA SANAR DÚVIDAS DIRETAMENTE COM MÉDICOS VETERINÁRIOS, LEVE O PET NO PRAZO DE 10 DIAS  EM UMA CLÍNICA INDICADA PARA A PRIMEIRA CONSULTA GRÁTIS E PARA A EFETIVAÇÃO DA GARANTIA SAÚDE DESTE CONTRATO.
PET CLUBE: ampla rede de descontos em vários produtos e serviços
RG PET VIRTUAL gratuito liberado no ato da transferência.
PET PHONE 24 horas de auxílio veterinário.
PET HOME visita eletiva na residência.
</b></font></font></p>
<p style="margin-bottom:0cm;line-height:150%" class="m_-8315628161895073979gmail-western" align="justify">
<br>
</p>

</div>
</font></div></table></table></div></div></body>
<script>
window.print();
</script>
</html>
