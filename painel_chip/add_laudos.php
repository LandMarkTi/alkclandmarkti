<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");

$id_ped=(int)$_GET['id_ped'];

$id_f=(int)$_GET['id_f'];


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
    	  <div class="arial_branco20" id="internas_titulo">Adicione o Laudo:
          	
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;"><form action="foto_laudo.php" method="post" enctype="multipart/form-data" >
			<table width="100%" border="0" cellspacing="6" cellpadding="0"><input type="hidden" name="id_ped" value="<?=$id_ped;?>"><input type="hidden" name="id_f" value="<?=$id_f;?>">
			
       <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Resultado:</label></td>
    				<td><select name="resultado" id="ou">
						<option value="1">HD - (Normal)</option>
						<option value="2">HD +/- (Quase Normal)</option>
						<option value="3">HD + (Ainda aceita)</option>
						<option value="4">HD ++ (Moderada à média)</option>
						<option value="5">HD+++ (Severa à grave)</option>
						<option value="6">Outro tipo</option>
						</select></td>
		</tr>    
              <tr style="display:none" id="desc">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Descrição:</label></td>
    				<td><input type="text" name="desc" ></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >CRMV Responsável:</label></td>
    				<td><input type="text" name="crmv" required></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Arquivo 1:</label></td>
    				<td><input type="file" name="fot1"></td>
		</tr>    
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Arquivo 2:</label></td>
    				<td><input type="file" name="fot2"></td>
		</tr>    
                <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td><input type="submit" name="enviar" value="Salvar"></td>
		</tr>    
  
 
</table></form>
         </div>
            </div>
         </div>
         
        </div>
    </div>
    <script>$('#ou').change(function(){var p=this.value;if(p==6)$('#desc').show(); else $('#desc').hide();});</script>
  </div>
</div>
<?php include "footer.php";?>
</body>
</html>
