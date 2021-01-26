<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$id_ped=(int)$_GET['id_ped'];
$id_f=(int)$_GET['id_f'];


$id_ped=$id_ped.str_pad($id_f, 2, "0", STR_PAD_LEFT);
if($_POST){


$id_ped=$_POST['id_ped'];
$apl=mktime ( '00', '00', '00', substr($_POST['aplicacao'],5,2), substr($_POST['aplicacao'],8,2), substr($_POST['aplicacao'],0,4) );
$revac=mktime ( '00', '00', '00', substr($_POST['revacinar'],5,2), substr($_POST['revacinar'],8,2), substr($_POST['revacinar'],0,4) );

//die(substr($_POST['revacinar'],0,4).substr($_POST['revacinar'],5,2).substr($_POST['revacinar'],8,2));

$med=addslashes($_POST['responsavel']);
$vac=addslashes($_POST['lote']);
$crmv=(int)$_SESSION['cid'];
mysql_query("INSERT INTO `vacinas2` (`id_vac`, `id`, `data_aplicacao`, `data_revac`, `Resp_tec`, `tipo_marca_lote`, `id_med`) VALUES (NULL, '$id_ped', '$apl', '$revac', '$med', '$vac', '$crmv');");

echo("<html><meta http-equiv='Content-Type' content='text/html; charset=utf-8'><script>alert('Vacina enviada com sucesso.');location='index_principal.php';</script></html>");


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
    	  <div class="arial_branco20" id="internas_titulo">Nova Vacina:
          	
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;"><form action="#" method="post" >
			<table width="100%" border="0" cellspacing="6" cellpadding="0"><input type="hidden" name="id_ped" value="<?=$id_ped;?>"><input type="hidden" name="id_f" value="<?=$id_f;?>">
			                <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>                <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>

              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Data de Aplicação:</label></td>
    				<td><input type="date" name="aplicacao" class="forms" placeholder="DD/MM/AAAA" style="height:initial" required></td>
		</tr>    
                <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>    


              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Revacinar:</label></td>
    				<td><input type="date" name="revacinar" class="forms" placeholder="DD/MM/AAAA" style="height:initial" required></td>
		</tr>    
                <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>    


              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Tipo/Marca/Lote:</label></td>
    				<td><input type="text" name="lote" class="forms"  style="height:initial" required></td>
		</tr>    
                <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>    



              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Responsável:</label></td>
    				<td><input type="text" name="responsavel" class="forms" style="height:initial"  required></td>
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
