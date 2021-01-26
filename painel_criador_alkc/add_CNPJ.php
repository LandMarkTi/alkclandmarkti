<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$id_ped=(int)$_GET['id_ped'];
$id_f=(int)$_GET['id_f'];


$id_ped=$id_ped.str_pad($id_f, 2, "0", STR_PAD_LEFT);
if($_POST){


$id_cr=(int)$_SESSION['cid'];

//die(substr($_POST['revacinar'],0,4).substr($_POST['revacinar'],5,2).substr($_POST['revacinar'],8,2));

$med=addslashes($_POST['nome']);
$cn=addslashes(substr($_POST['cnp'],0,18));

$apl=time();
mysql_query("delete from `criador_cn` where id='".$id_cr."' ");
mysql_query("INSERT INTO `criador_cn` (`id_vac`, `id`, `data_aplicacao`, `rz`, `cn`) VALUES (NULL, '$id_cr', '$apl', '$med', '$cn');");

echo("<html><meta http-equiv='Content-Type' content='text/html; charset=utf-8'><script>alert('CNPJ Salvo.');location='index_principal.php';</script></html>");


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
    	  <div class="arial_branco20" id="internas_titulo">Adicionar ou Alterar CNPJ no Pedigree:
          	
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
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Razão Social:</label></td>
    				<td><input type="text" name="nome" class="forms" placeholder="Nome.." style="height:initial" ></td>
		</tr>   
   				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>  
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >CNPJ :</label></td>
    				<td><input type="text" name="cnp" class="forms" placeholder="00.000.000/0001-00" style="height:initial" required></td>
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
