<?php
session_start();
require_once("Connections/conexao.php");



if($_POST){
$yf=(int)$_SESSION['cid'];
if($_POST['pi']=='Completo'){ mysql_query("delete from privacidade where id_criador=".$yf);} else {mysql_query("insert into privacidade values('',$yf,'".time()."')");}

}

$qp=mysql_query("select * from privacidade where id_criador=".$_SESSION['cid']);

$fp=mysql_fetch_assoc($qp);

$np=mysql_num_rows($qp);
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
    	  <div class="arial_branco20" id="internas_titulo">Privacidade do canil:<?php  if($np>=1) echo 'Ativada'; else echo 'desativada';?>
          	
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;"><form action="#" method="post"  >
			<table width="100%" border="0" cellspacing="6" cellpadding="0">

              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" ></label></td>
    				<td></td>
		</tr>    
              
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" ></label></td>
    				<td>Para ocultar os dados de endereço no pedigree, utilize o controle abaixo:<br><br><br></td>
		</tr>    
              			
       <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Tipo de endereço:</label></td>
    				<td><select name="pi"><option>Completo</option><option>Simples (estado / cidade)</option></select></td>
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
    				<td><input type="submit" value="Enviar"></td>
		</tr>    

              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" ></label></td>
    				<td></td>
		</tr>    
              
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" ></label></td>
    				<td></td>
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
