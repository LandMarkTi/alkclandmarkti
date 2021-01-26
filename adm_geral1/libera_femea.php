<?php
session_start();
if($_SESSION['login']!='sergio@sobraci.org')die("<script>location='index.php';</script>");
require_once("Connections/conexao.php");




if($_POST){

$busca=substr(trim($_POST['reg']),0,-1);

$criador=(int)$_POST['criador'];

$criador=$criador+21634;
$q_reg=mysql_query("select id_ped,id_criador from pedigree where registro='$busca' and id_criador=$criador ");

$p=mysql_num_rows($q_reg);

if($p>=1){

mysql_query("delete from femeas where id_criador=$criador");

$alert="alert('registro liberado.');";
} else {$alert="alert('registro ou criador inválido.');";}
}


?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Keywords" content="Painel de Controle" /> 
<meta name="Description" content="Painel de Controle"/> 
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="css/style_internas.css" />
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle .::</title>
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Liberar Fêmea
            <div style="float:right;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" width="74" height="22" border="0" title="Voltar página anterior" ></a></div>
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            <form action="libera_femea.php" method="post">
			<table width="100%" border="0" cellspacing="6" cellpadding="0">
            
  			  <tr>
    				<td align="right"><label for="nome" class="arial_cinza2_12" >Criador</label></td>
    				<td><input name="criador" type="number" required></td>
			  </tr>

  			  <tr>
    				<td align="right"><label for="nome" class="arial_cinza2_12" >Registro</label></td>
    				<td><input name="reg" type="text" required></td>
			  </tr>

			
              
              <tr>
                <td align="right">&nbsp;</td>
                <td>
                <input type="submit" name="Submit"  class="button" value="Liberar"  /> 
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

<script>
<?=$alert?>

</script>
<?php include "footer.php";?>
</body>
</html>
