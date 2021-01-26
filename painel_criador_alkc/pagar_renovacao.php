<?php
session_start();
require_once("Connections/conexao.php");

$idped=(int)$_SESSION['cid'];

$idped=$idped-21634;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="css/style_internas.css" />
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle  .::</title>
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Renovação do canil:
          	
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
			<table width="100%" border="0" cellspacing="6" cellpadding="0">

              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" ></label></td>
    				<td></td>
		</tr>    
              
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" ></label></td>
    				<td><b style="font-size:18px">Faça agora mesmo a renovação da anuidade de seu afixo <br>e continue tendo acesso a todos os benefícios ALKC:</b><br><br><br></td>
		</tr>    

  
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" ></label></td>
    				<td></td>
		</tr>    
              
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" ></label></td>
    				<td></td>
		</tr>    
              

              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" ></label></td>
    				<td>
<form action="https://pagseguro.uol.com.br/v2/checkout/payment.html" id="pagseguro2" name="pagseguro2" method="post">
<input type="hidden" name="receiverEmail" value="alkc.pagseguro@gmail.com" />
<input type="hidden" name="currency" value="BRL" />
<input type="hidden" name="itemId1" value="renova_<?=time();?>" />
<input type="hidden" name="itemDescription1" id="lista" value="Renovar Canil <?=$idped?>" />
<input type="hidden" name="itemQuantity1" value="1" />
<input type="hidden" name="itemAmount1" id="valor_produtos"  value="80.00"/>
<input type="hidden" name="itemWeight1" value="1" />
<input type="hidden" name="itemShippingCost1" value="0.00" />



<input type="submit" value="PAGAR">
</form>
<script>$('#jsddm').remove();</script>
</td>
		</tr>    

              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" ></label></td>
    				<td></td>
		</tr>    
              
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" ></label></td>
    				<td></td>
		</tr>    
               
</table>
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
