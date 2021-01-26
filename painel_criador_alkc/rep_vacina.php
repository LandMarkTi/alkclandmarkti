<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$id_ped=(int)$_GET['id_ped'];
$id_f=(int)$_GET['id_f'];


$id_p=substr($id_ped,-2, 2);

$qdados=mysql_query("select * from vacinas2 where id=$id_ped");
$fdados=mysql_fetch_assoc($qdados);
if($_POST){


$id_ped=$_POST['id_ped'];
$apl=mktime ( '00', '00', '00', substr($_POST['aplicacao'],3,2), substr($_POST['aplicacao'],0,2), substr($_POST['aplicacao'],6,4) );
$revac=mktime ( '00', '00', '00', substr($_POST['revacinar'],3,2), substr($_POST['revacinar'],0,2), substr($_POST['revacinar'],6,4) );
$med=addslashes($_POST['responsavel']);
$vac=addslashes($_POST['lote']);
$crmv=(int)$_SESSION['cid'];
//mysql_query("INSERT INTO `vacinas2` (`id_vac`, `id`, `data_aplicacao`, `data_revac`, `Resp_tec`, `tipo_marca_lote`, `id_med`) VALUES (NULL, '$id_ped', '$apl', '$revac', '$med', '$vac', '$crmv');");

echo("<html><meta http-equiv='Content-Type' content='text/html; charset=utf-8'><script>location='listagem_vacina.php';</script></html>");


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
    	  <div class="arial_branco20" id="internas_titulo">Dados Vacina:
          	
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
    				<td><input  value="<?php echo date("d/m/Y",$fdados['data_aplicacao']); ?>" name="aplicacao" class="forms" placeholder="DD/MM/AAAA" style="height:initial" required></td>
		</tr>    
                <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>    


              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Revacinar:</label></td>
    				<td><input  value="<?php echo date("d/m/Y",$fdados['data_revac']); ?>" name="revacinar" class="forms" placeholder="DD/MM/AAAA" style="height:initial" required></td>
		</tr>    
                <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>    


              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Tipo/Marca/Lote:</label></td>
    				<td><input type="text" value="<?php echo $fdados['tipo_marca_lote']; ?>" name="lote" class="forms"  style="height:initial" required></td>
		</tr>    
                <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>    



              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Responsável:</label></td>
    				<td><input type="text" value="<?php echo $fdados['Resp_tec']; ?>" name="responsavel" class="forms" style="height:initial"  required></td>
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
    				<td><input class="forms" type="submit" name="enviar" value="Voltar" style="height: 35px;"></td>
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
