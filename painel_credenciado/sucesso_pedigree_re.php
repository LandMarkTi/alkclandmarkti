<?php
session_start();
require_once("Connections/conexao.php");


$ht="

Novo pedigree pendente de aprovação

Aviso gerado pelo sistema Sobraci

data: ".date("d/m/Y")."

";

$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/plain; charset=utf-8\n";
$headers .= "From: contato@megapedigree.com\n"; // remetente
$headers .= "Return-Path:contato@megapedigree.com\n"; // return-path
//$envio = mail("debora@neoware.com.br", "$assunto", "$mensagemHTML", $headers);
//$envio = mail('thayna@sobraci.org', "Novo registro para aprovar", "$ht", $headers,"-rcontato@megapedigree.com");


?>
<!DOCTYPE html>
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
    	  <div class="arial_branco20" id="internas_titulo">Adicione as fotos:
          	
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;"><form action="fotos_ri.php" method="post" enctype="multipart/form-data" >
			<table width="100%" border="0" cellspacing="6" cellpadding="0">
				<input type="hidden" name="id" value="<?=$_GET['id'];?>">
       <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Foto 1:</label></td>
    				<td><input type="file" name="fot1" required></td>
		</tr>    
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Foto 2:</label></td>
    				<td><input type="file" name="fot2"></td>
		</tr>    
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Foto 3:</label></td>
    				<td><input type="file" name="fot3"></td>
		</tr>    
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Foto 4:</label></td>
    				<td><input type="file" name="fot4"></td>
		</tr>    
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Foto 5:</label></td>
    				<td><input type="file" name="fot5"><br><br><br><input type="submit" ></td>
		</tr>   
</table></form>
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
