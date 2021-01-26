<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$idc=(int)$_SESSION['cid'];
if($_POST){


$psa=addslashes(trim($_POST['atual_s']));

$psn=addslashes(trim($_POST['nova_s']));
//

if($psa==''||$psn=='')die('Senha incompativel.');

$testa=ctype_alnum($psn);
if($testa){

$pss=mysql_query("update criadores set senha='".$psn."' where id_criador=".$idc." and senha='".$psa."';") or die('ep');
echo("<html><meta http-equiv='Content-Type' content='text/html; charset=utf-8'><script>alert('senha Alterada.');location='index_principal.php';</script></html>");

} else die("<html><meta http-equiv='Content-Type' content='text/html; charset=utf-8'><script>alert('Somente letras e numeros.');location='troca_psw.php';</script></html>");
die();
}

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
    	  <div class="arial_branco20" id="internas_titulo">Mudar a Senha:
          	
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;"><form action="#" method="post" >
			<table width="100%" border="0" cellspacing="6" cellpadding="0"><input type="hidden" name="cid" value="<?=$_SESSION['id'];?>"><input type="hidden" name="id_f" value="<?=$id_f;?>">
			                <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>                <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>

              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Senha Atual:</label></td>
    				<td><input type="text" name="atual_s" class="forms" placeholder="sua senha de entrada." style="height:initial" required></td>
		</tr>    
                <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>    


              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Nova Senha:</label></td>
    				<td><input type="text" name="nova_s" class="forms" style="height:initial" placeholder="Letras e números.." required></td>
		</tr>    
                <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>    


   
                <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>    
                  <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>                <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td><input class="forms" type="submit" name="enviar" value="Salvar" style="height: 35px;"></td>
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
