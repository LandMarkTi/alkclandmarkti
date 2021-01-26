<?php
session_start();
require_once("Connections/conexao.php");
if($_SESSION['login']=='')die("<script>location='index.php';</script>");
$idped=(int)$_GET['id_ped'];
$idf=(int)$_GET['id_f'];


$sql1="select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$idped;
$qr1=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr1);

$nloop=explode(';', $linha_ped['ninhada']);
$micro=explode(';', $linha_ped['nº microchip']);

$mic=$micro[$idf-4];

$nome=$nloop[$idf];

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
    	  <div class="arial_branco20" id="internas_titulo">Nova transferência 
            <div style="float:right;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" width="74" height="22" border="0" title="Voltar página anterior" ></a></div>
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            <form action="sucesso_trans.php" method="post">
			<table width="100%" border="0" cellspacing="6" cellpadding="0">
            
  			  <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Novo Proprietário</label></td>
    				<td><input name="prop" type="text" class="forms" id="login" size="65" required="required"/></td>
			  </tr>
            
  			  <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Nome do cão(sem prefixo/sulfixo)</label></td>
    				<td><input name="nome_cao" type="text" value="<?=$nome?>" class="forms" id="cc" size="65" required="required"/></td>
			  </tr>
	  		<tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Microchip</label></td>
    				<td><input name="mic" type="text" value="<?=$mic?>" class="forms" id="ccm" size="65" /></td>
			  </tr>
              
              <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Novo Endereço</label></td>
    				<td><input name="end" type="text" class="forms" id="senha" size="65" /><input type="hidden"  name="id_ped" value="<?php echo $idped;?>"><input type="hidden"  name="id_f" value="<?php echo $idf;?>"></td>
			  </tr>

          <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Novo CEP</label></td>
    				<td><input name="cep" type="text" class="forms"  size="65" /><input type="hidden"  name="id_ped" value="<?php echo $idped;?>"><input type="hidden"  name="id_f" value="<?php echo $idf;?>"></td>
			  </tr>
          <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Novo Tel</label></td>
    				<td><input name="tel" type="text" class="forms"  size="65" /><input type="hidden"  name="id_ped" value="<?php echo $idped;?>"><input type="hidden"  name="id_f" value="<?php echo $idf;?>"></td>
			  </tr>
          <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >CPF</label></td>
    				<td><input name="cpf" type="text" class="forms"  size="65" /><input type="hidden"  name="id_ped" value="<?php echo $idped;?>"><input type="hidden"  name="id_f" value="<?php echo $idf;?>"></td>
			  </tr>
          <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >RG</label></td>
    				<td><input name="rg" type="text" class="forms"  size="65" /><input type="hidden"  name="id_ped" value="<?php echo $idped;?>"><input type="hidden"  name="id_f" value="<?php echo $idf;?>"></td>
			  </tr>
          <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Email</label></td>
    				<td><input name="email" type="text" class="forms"  size="65" /><input type="hidden"  name="id_ped" value="<?php echo $idped;?>"><input type="hidden"  name="id_f" value="<?php echo $idf;?>"></td>
			  </tr>
          <tr>
                <td align="right">&nbsp;</td>
                <td>
                <input type="submit" name="Submit"  class="button" value="Cadastrar" /> 
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
