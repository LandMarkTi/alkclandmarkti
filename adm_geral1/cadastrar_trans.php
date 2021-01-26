<?php
session_start();
require_once("Connections/conexao.php");
if($_SESSION['login']=='sergio@sobraci.org'){} else die("sem login");

$idped=(int)$_GET['id_ped'];
$idf=(int)$_GET['id_f'];

$id_trans_capa=(int)$_GET['id_trans_capa'];



$sql1="select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$idped;
$qr1=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr1);

$nloop=explode(';', $linha_ped['ninhada']);
$micro=explode(';', $linha_ped['nº microchip']);
$sex=explode(';', $linha_ped['sexo']);


$mic=$micro[$idf-4];

$sx=$sex[$idf-4];

$nome=$nloop[$idf];

//dados da capa

$q_dados_pg=mysql_query("SELECT * FROM `pedigre_trocados_capa` WHERE `id_trans_capa` =$id_trans_capa");

$f_pg_dados=mysql_fetch_assoc($q_dados_pg);

//verifica pedido convenio

$q_conv=mysql_query("SELECT * FROM `form_health` WHERE `id_capa` = ".$id_trans_capa." and conf='ok'") or die('opa');

$f_conv=mysql_fetch_assoc($q_conv);

$nc=(int)mysql_num_rows($q_conv);

$iframe='';
if($nc>=1){//manda email parabens e a url proposta
////integra3.php?du='.$b64.'&ped='.$p64.'&val='.$pc.'&n='.$nasc_pet.'&sx='.$sx

$b64=$f_conv['cliente'];

$p64=$f_conv['pet'];

$pc=$f_conv['valor'];

$nasc_pet=$linha_ped['nasc'];


//email login sergio session!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!



$mensagemHTML = '<html>
<body><br><br>
Transferência web
<br>
Obrigado ' . $f_pg_dados['proprietario'] . ', 
<br>
<br>
<br>
<img src="http://www.megapedigree.com/site/images/conf_proposta.jpg" title="confirma">
<br>
</body></html>
';


//http://conveniosaudepet.com.br/integra3.php?du='.$b64.'&ped='.$p64.'&val='.$pc.'&n='.$nasc_pet.'&sx='.$sex
//setar  como enviado RG/KCE/17/151670

$headers = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=utf-8\n";
$headers .= "From: naoresponda@megapedigree.com\n"; // remetente
$headers .= "Return-Path: contato@megapedigree.com\n"; // return-path


$email=$f_pg_dados['email_t'];
$envio = mail($email, "Convenio de saude Pet", "$mensagemHTML", $headers,'-rcontato@megapedigree.com');


$iframe='http://conveniosaudepet.com.br/integra3.php?du='.$b64.'&ped='.$p64.'&val='.$pc.'&n='.$nasc_pet.'&sx='.$sx;

}

?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Keywords" content="Painel de Controle - NEOWARE" /> 
<meta name="Description" content="Painel de Controle - NEOWARE"/> 
<meta name="copyright" content="Neoware Criação e Desenvolvimento de Websites e Sistemas - www.neoware.com.br" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="css/style_internas.css" />
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle - NEOWARE .::</title>
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Concluir transferência - Confirme todos os dados antes de Salvar.
            <div style="float:right;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" width="74" height="22" border="0" title="Voltar página anterior" ></a></div>
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            <form action="sucesso_trans.php" method="post">
			<table width="100%" border="0" cellspacing="6" cellpadding="0">
            
  			  <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Novo Proprietário</label></td>
    				<td><input name="prop" type="text" class="forms" value="<?=$f_pg_dados['proprietario']?>" size="65" required="required"/></td>
			  </tr>
            
  			  <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Nome do cão(sem prefixo/sulfixo)</label></td>
    				<td><input name="nome_cao" type="text" value="<?=$f_pg_dados['nome_cao']?>" class="forms" id="cc" size="65" required="required"/></td>
			  </tr>
	  		<tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Microchip</label></td>
    				<td><input name="mic" type="text" value="<?=$f_pg_dados['mic']?>" class="forms" id="ccm" size="65" /></td>
			  </tr>
              
              <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Novo Endereço</label></td>
    				<td><input name="end" type="text" class="forms" value="<?=$f_pg_dados['endereco']?>" size="65" /></td>
			  </tr>

          <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Novo CEP</label></td>
    				<td><input name="cep" type="text" class="forms" value="<?=$f_pg_dados['cep_t']?>" size="65" /></td>
			  </tr>
          <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Novo Tel</label></td>
    				<td><input name="tel" type="text" class="forms" value="<?=$f_pg_dados['tel_t']?>"  size="65" /></td>
			  </tr>
          <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >CPF</label></td>
    				<td><input name="cpf" type="text" class="forms" value="<?=$f_pg_dados['cpf_t']?>" size="65" /></td>
			  </tr>
          <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Email</label></td>
    				<td><input name="email" type="text" class="forms" value="<?=$f_pg_dados['email_t']?>" size="65" /><input type="hidden"  name="id_ped" value="<?php echo $idped;?>"><input type="hidden"  name="id_f" value="<?php echo $idf;?>"></td>
			  </tr>
          <tr>
                <td align="right">&nbsp;<iframe src="<? echo $iframe;?>" width="1px" height="1px" ></iframe></td>
                <td>
                <input type="submit" name="Submit"  class="button" value="Salvar" /> 
                </td>            
              </tr>
              
			</table>
  			</form>
           </div>
            </div>
         </div>
         
        </div>
    </div>
    
  </div>
</div>
<?php include "footer.php";?>
</body>
</html>
